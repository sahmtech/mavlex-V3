<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\TransactionUtil;
use App\Utils\BusinessUtil;
use App\Models\Transaction;
use App\Models\PurchaseLine;
use App\Models\TransactionSellLinesPurchaseLines;
use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\Variation;
use App\Jobs\ResetMappingJob;
use Illuminate\Support\Str;
use App\Models\JobBatch;


class StockRebuildController extends Controller
{
    protected $transactionUtil;
    protected $businessUtil;

    public function __construct(TransactionUtil $transactionUtil, BusinessUtil $businessUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->businessUtil = $businessUtil;
    }

    /**
     * Index reports/purchase_sell_mismatch
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('purchase_sell_mismatch.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('business.id');
        $locations = DB::table('business_locations')
            ->where('business_id', $business_id)
            ->pluck('name', 'id');

        return view('product.purchase_sell_mismatch')->with(compact('locations', 'business_id'));
    }

    /**
     * Remap stock allocations (purchase-sell lines) for a specific business,
     * location, and optionally a variation.
     *
     * e.g. GET /stock-rebuild/do?business_id=1&location_id=100&variation_id=999
     */
    public function remapStock(Request $request)
    {
        if (!auth()->user()->can('purchase_sell_mismatch.fix')) {
            abort(403, 'Unauthorized action.');
        }

        $notAllowed = $this->businessUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $business_id = $request->get('business_id');
        $location_id = $request->get('location_id');
        $variation_id = $request->get('variation_id', null);

        if (empty($business_id) || empty($location_id) || empty($variation_id)) {
            $output = [
                'success' => false,
                'msg'     => trans("lang_v1.purchase_sell_data_validation")
            ];
            return back()->with('status', $output);
        }

        DB::beginTransaction();
        try {
            // Get all sell_line_ids for the specified business, location & variation
            $sell_lines_query = DB::table('transaction_sell_lines as tsl')
                ->join('transactions as t', 'tsl.transaction_id', '=', 't.id')
                ->where('t.business_id', $business_id)
                ->where('t.location_id', $location_id)
                ->where('t.type', 'sell')
                ->where('t.status', 'final')
                ->where('tsl.variation_id', $variation_id);

            $sell_line_ids = $sell_lines_query->pluck('tsl.id');
            if ($sell_line_ids->isEmpty()) {
                DB::rollBack();
                $output = [
                    'success' => false,
                    'msg'     => trans("lang_v1.purchase_sell_no_transaction_found")
                ];
                return back()->with('status', $output);
            }

            /**
             * 1) Delete only from transaction_sell_lines_purchase_lines_v2
             *    for this product/variation in the given business & location
             */
            DB::table('transaction_sell_lines_purchase_lines_v2')
                ->join('transaction_sell_lines as tsl', 'transaction_sell_lines_purchase_lines_v2.sell_line_id', '=', 'tsl.id')
                ->join('transactions as t', 'tsl.transaction_id', '=', 't.id')
                ->where('t.business_id', $business_id)
                ->where('t.location_id', $location_id)
                ->where('t.type', 'sell')
                ->where('t.status', 'final')
                ->where('tsl.variation_id', $variation_id)
                ->delete();

            /**
             * 2) Delete the old mappings in transaction_sell_lines_purchase_lines
             *    for this set of sell_line_ids.
             */
            DB::table('transaction_sell_lines_purchase_lines')
                ->whereIn('sell_line_id', $sell_line_ids)
                ->delete();

            // 3) Reset quantity_sold = 0 for purchase lines that match the variation & location
            $purchase_line_query = DB::table('purchase_lines as pl')
                ->join('transactions as t', 'pl.transaction_id', '=', 't.id')
                ->where('t.business_id', $business_id)
                ->where('t.location_id', $location_id)
                ->where('pl.variation_id', $variation_id);

            $purchase_line_ids = $purchase_line_query->pluck('pl.id');
            if ($purchase_line_ids->isNotEmpty()) {
                DB::table('purchase_lines')
                    ->whereIn('id', $purchase_line_ids)
                    ->update(['quantity_sold' => 0]);
            }

            // 4) Re-fetch all final "sell" transactions for this business & location
            $all_sells = DB::table('transactions')
                ->where('business_id', $business_id)
                ->where('location_id', $location_id)
                ->where('type', 'sell')
                ->where('status', 'final')
                ->orderBy('transaction_date', 'asc')
                ->orderBy('id', 'asc')
                ->get();

            // 5) For each sale, re-map the relevant sell lines to purchase lines
            foreach ($all_sells as $sale) {
                $sale_lines_query = DB::table('transaction_sell_lines')
                    ->where('transaction_id', $sale->id)
                    ->where('variation_id', $variation_id);

                $sale_lines = $sale_lines_query->get();
                if ($sale_lines->isEmpty()) {
                    continue;
                }

                // Build $map_lines array for mapPurchaseSell
                $map_lines = [];
                foreach ($sale_lines as $sl) {
                    // Net quantity = sold qty - returned qty
                    $net_qty = $sl->quantity - ($sl->quantity_returned ?? 0);
                    if ($net_qty > 0) {
                        $map_lines[] = (object)[
                            'id'           => $sl->id,
                            'product_id'   => $sl->product_id,
                            'variation_id' => $sl->variation_id,
                            'quantity'     => $net_qty
                        ];
                    }
                }

                if (empty($map_lines)) {
                    continue;
                }

                $business = Business::findOrFail($business_id);

                // set allow_overselling = true to skip mismatch errors
                $business_array = [
                    'id'               => $business_id,
                    'accounting_method'=> $business->accounting_method,
                    'location_id'      => $location_id,
                    'pos_settings'     => [
                        'allow_overselling' => true
                    ]
                ];

                // Re-map
                $this->transactionUtil->mapPurchaseSell(
                    $business_array,
                    $map_lines,
                    'purchase',
                    false,
                    null
                );
            }

            DB::commit();

            // Prepare success message
            $location = BusinessLocation::find($location_id);
            $variation = Variation::with('product')->find($variation_id);
            $location_name = $location ? $location->name : $location_id;
            $product_name  = ($variation && $variation->product) ? $variation->product->name : 'N/A';
            $variation_info = $variation ? $variation->name . " (SKU: " . $variation->sub_sku . ")" : $variation_id;

            $output = [
                'success' => true,
                'msg'     => trans('lang_v1.remap_completed', [
                    'location'  => $location_name,
                    'product'   => $product_name,
                    'variation' => $variation_info
                ])
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }

        return back()->with('status', $output);
    }

// 1. Dispatch the entry-based job and show progress
public function resetMapping(Request $request)
{
    $notAllowed = $this->businessUtil->notAllowedInDemo();
    if (!empty($notAllowed)) {
        return $notAllowed;
    }

    $businessId = $request->get('business_id', 'all');

    // Count every sell‐line entry we'll process
    $totalEntries = \App\Models\TransactionSellLine::whereHas('transaction', function($q) use ($businessId) {
        $q->where('type', 'sell')
          ->where('status', 'final');
        if ($businessId !== 'all') {
            $q->where('business_id', $businessId);
        }
    })->count();

    // Create batch with exact entry count
    $batch = JobBatch::create([
        'uuid'          => (string) Str::uuid(),
        'job_name'      => 'ResetMapping',
        'business_id'   => $businessId,
        'chunk_size'    => null,            // no longer used
        'total_chunks'  => $totalEntries,   // exact # of entries
        'completed_chunks' => 0,
        'status'        => 'processing',
    ]);

    // Dispatch the job (it will increment completed_chunks one-by-one)
    ResetMappingJob::dispatch($batch->uuid, $businessId);

    // Show the progress page
    return view('app_settings.mapping_progress', compact('batch'));
}

// 2. If a batch is still processing, show progress; otherwise show the form
public function showResetMappingForm()
{
    $existing = JobBatch::where('job_name', 'ResetMapping')
        ->where('status', 'processing')
        ->latest()
        ->first();

    if ($existing) {
        return view('app_settings.mapping_progress', ['batch' => $existing]);
    }

    $businesses = Business::all();
    return view('app_settings.reset_mapping', compact('businesses'));
}

public function mappingResult($uuid)
{
    // 1) Load the batch
    $batch = JobBatch::where('uuid', $uuid)->firstOrFail();

    // 2) Figure out the business scope label
    if ($batch->business_id === 'all') {
        $scope = trans('settings.all_businesses');
    } else {
        $biz = Business::find($batch->business_id);
        $scope = $biz ? $biz->name : $batch->business_id;
    }

    // 3) Build a single‐row progress array using entry counts directly
    $progress = [[
        'business'      => $scope,
        'current_chunk' => $batch->completed_chunks,
        'total_chunks'  => $batch->total_chunks,
        'status'        => ucfirst($batch->status),
    ]];

    // 4) Pass it to the exact same view you already have
    return view('app_settings.reset_mapping_result', compact('progress'));
}


// 4. (Optional) List all past jobs
public function processedJobs()
{
    $batches = JobBatch::orderBy('created_at', 'desc')->get();
    return view('app_settings.processed_jobs', compact('batches'));
}

public function jobProgress(string $uuid)
{
    $batch = JobBatch::where('uuid', $uuid)->firstOrFail();

    return response()->json([
        'completed_chunks' => $batch->completed_chunks,
        'total_chunks'     => $batch->total_chunks,
        'status'           => $batch->status,
        'created_at'       => $batch->created_at->toIso8601String(),
    ]);
}
}
