<?php

namespace Modules\Zatca\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TaxRate;
use App\Utils\TransactionUtil;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Models\BusinessLocation;
use App\Models\Business;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ZatcaReportController extends Controller
{
    protected $transactionUtil;
    protected $businessUtil;
    protected $moduleUtil;

    public function __construct(BusinessUtil $businessUtil, TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {

        $this->transactionUtil = $transactionUtil;
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function get_zatca_tax_report(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');
        $can_access_zatca_tax_report = auth()->user()->can('zatca.tax_report');

        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'zatca_module')) || ! ($can_access_zatca_tax_report)) {
            abort(403, 'Unauthorized action.');
        }
        $business = Business::where('id', $business_id)->first();
        if (!$request->ajax()) {
            $sentCount = Transaction::where('business_id', $business_id)
                ->where('sent_to_zatca', 1)
                ->count();

            $total_tax_collected = Transaction::where('business_id', $business_id)
                ->where('sent_to_zatca', 1)
                ->sum('tax_amount');

            $item_tax = \DB::table('transaction_sell_lines')
                ->join('transactions', 'transaction_sell_lines.transaction_id', '=', 'transactions.id')
                ->where('transactions.business_id', $business_id)
                ->where('transactions.sent_to_zatca', 1)
                ->sum('transaction_sell_lines.item_tax');

            $total_tax_collected += $item_tax;
        }

        $permitted_locations = auth()->user()->permitted_locations();

        if ($permitted_locations !== 'all') {
            $locations = BusinessLocation::whereIn('id', $permitted_locations)->pluck('name', 'id');
        } else {
            $locations = BusinessLocation::pluck('name', 'id');
        }

        // Handle AJAX request for DataTables
        if ($request->ajax()) {
            if ($request->ajax()) {
                $query = Transaction::with('tax')
                    ->where('transactions.business_id', $business_id)
                    ->where('transactions.sent_to_zatca', 1)
                    ->whereIn('transactions.type', ['sell', 'sell_return'])
                    ->where('transactions.status', 'final')
                    ->leftJoin('contacts as c', 'transactions.contact_id', '=', 'c.id')
                    ->leftJoin('business_locations as bl', 'transactions.location_id', '=', 'bl.id')
                    ->leftJoin('tax_rates as tr', 'transactions.tax_id', '=', 'tr.id')
                    // Join parent transaction for sell returns:
                    ->leftJoin('transactions as T1', 'transactions.return_parent_id', '=', 'T1.id')

                    ->leftJoin(\DB::raw("(SELECT 
                        trsl.transaction_id,
                        SUM(trsl.item_tax) AS total_item_tax,
                        GROUP_CONCAT(DISTINCT trsl.tax_id) AS item_tax_ids,
                        GROUP_CONCAT(DISTINCT tax_rates.name SEPARATOR ' | ') AS item_tax_names,
                        GROUP_CONCAT(DISTINCT tax_rates.amount SEPARATOR ' | ') AS item_tax_rates
                        FROM transaction_sell_lines AS trsl
                        LEFT JOIN tax_rates ON tax_rates.id = trsl.tax_id
                        GROUP BY trsl.transaction_id) AS tsli"), 'transactions.id', '=', 'tsli.transaction_id')
                    ->select(
                        'transactions.id',
                        'transactions.invoice_no',
                        'transactions.tax_id',
                        'tr.name as tax_name',
                        'tr.amount as tax_rate',
                        \DB::raw('(COALESCE(transactions.tax_amount, 0) + COALESCE(tsli.total_item_tax, 0)) AS tax_amount'),
                        'bl.name as location_name',
                        \DB::raw("CASE WHEN c.contact_type = 'business' THEN c.supplier_business_name ELSE c.name END as contact_name"),
                        'transactions.transaction_date',
                        'transactions.type as transaction_type',
                        'T1.id as parent_sale_id',
                        \DB::raw("CASE WHEN c.contact_type = 'business'AND COALESCE(c.tax_number, '') <> '' AND COALESCE(CASE WHEN c.contact_type = 'business' THEN c.supplier_business_name ELSE c.name END, '' ) <> '' AND COALESCE(c.zip_code, '') <> '' AND COALESCE(c.city, '') <> '' AND COALESCE(c.address_line_1, '') <> '' AND COALESCE(c.address_line_2, '') <> '' THEN 'B2B' ELSE 'B2C' END as invoice_type"),
                    );
            }
            if ($request->filled('transaction_type')) {
                $query->where('transactions.type', $request->transaction_type);
            } else {
                $query->whereIn('transactions.type', ['sell', 'sell_return']);
            }
            if ($request->filled('location_id')) {
                $query->where('transactions.location_id', $request->location_id);
            }

            if ($request->filled('status') && in_array((int)$request->status, [0, 1, 2], true)) {
                $query->where('transactions.sent_to_zatca', (int)$request->status);
            }

            if (!empty($request->start_date) && !empty($request->end_date)) {
                $start = Carbon::parse($request->start_date)->startOfDay();
                $end = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('transactions.transaction_date', [$start, $end]);
            }

            $sells_sent = Transaction::where('business_id', $business_id)
                ->where('sent_to_zatca', 1)
                ->whereIn('transactions.type', ['sell', 'sell_return'])
                ->leftJoin(\DB::raw("(SELECT 
                        trsl.transaction_id,
                        SUM(trsl.item_tax) AS total_item_tax
                        FROM transaction_sell_lines AS trsl
                        GROUP BY trsl.transaction_id) AS tsli"), 'transactions.id', '=', 'tsli.transaction_id');

            if ($request->filled('transaction_type')) {
                $sells_sent->where('transactions.type', $request->transaction_type);
            }
            if ($request->filled('location_id')) {
                $sells_sent->where('location_id', $request->location_id);
            }

            if ($request->filled('status') && in_array((int)$request->status, [0, 1, 2], true)) {
                $sells_sent->where('sent_to_zatca', (int)$request->status);
            }

            if (!empty($request->start_date) && !empty($request->end_date)) {
                $start = Carbon::parse($request->start_date)->startOfDay();
                $end = Carbon::parse($request->end_date)->endOfDay();
                $sells_sent->whereBetween('transaction_date', [$start, $end]);
            }

            $sentCount = $sells_sent->count();
            $total_tax_collected_filter = $sells_sent->sum(DB::raw('COALESCE(transactions.tax_amount, 0) + COALESCE(tsli.total_item_tax, 0)'));


            return DataTables::of($query)
                ->editColumn('transaction_date', '{{@format_datetime($transaction_date)}}')
                ->editColumn(
                    'tax_amount',
                    '<span class="tax_amount" data-orig-value="{{$tax_amount}}">@format_currency($tax_amount)</span>'
                )
                ->editColumn('transaction_type', function ($row) {
                    if ($row->transaction_type == 'sell') {
                        return __('lang_v1.sell');
                    } elseif ($row->transaction_type == 'sell_return') {
                        return __('lang_v1.sell_return');
                    } else {
                        return $row->transaction_type;
                    }
                })
                ->with([
                    'sentCount' => $sentCount,
                    'total_tax_collected' => '<span class="display_currency" data-currency_symbol="true">' . number_format($total_tax_collected_filter, 2) . '</span>',
                ])
                ->setRowAttr([
                    'data-href' => function ($row) {
                        if ($row->transaction_type == 'sell_return') {
                            if (auth()->user()->can("sell.view")) {
                                return action('SellReturnController@show', [$row->parent_sale_id]);
                            }
                        } elseif ($row->transaction_type == 'sell') {
                            if (auth()->user()->can("sell.view") || auth()->user()->can("view_own_sell_only")) {
                                return action('SellController@show', [$row->id]);
                            }
                        }
                        return '';
                    }
                ])
                ->rawColumns(['tax_amount', 'transaction_type'])
                ->make(true);
        }

        $taxRates = TaxRate::where('business_id', $business_id)->pluck('name', 'id');
        $business_locations = BusinessLocation::forDropdown($business_id, false);
        return view('zatca::zatca_reports.zatca_tax_report', compact('sentCount', 'locations', 'taxRates', 'business', 'total_tax_collected', 'business_locations'));
    }

    public function get_zatca_sync_report(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');
        $can_access_zatca_sync_report = auth()->user()->can('zatca.sync_report');
        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'zatca_module')) || ! ($can_access_zatca_sync_report)) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = $request->session()->get('user.business_id');
        $business = Business::where('id', $business_id)->first();
       
        if (! $request->ajax()) {
            $base = Transaction::where('business_id', $business_id)
                ->whereIn('type', ['sell', 'sell_return'])
                ->where('status', 'final')    
                ->where('is_suspend', 0)      
                ->where('is_running_order', 0);  
    
            $newCount    = (clone $base)->where('sent_to_zatca', 0)->count();
            $sentCount   = (clone $base)->where('sent_to_zatca', 1)->count();
            $failedCount = (clone $base)->where('sent_to_zatca', 2)->count();
        }

        $sync_statuses = [
            0 => __('lang_v1.not_sent'),
            1 => __('lang_v1.sent'),
            2 => __('lang_v1.failed'),
        ];

        $permitted_locations = auth()->user()->permitted_locations();

        if ($permitted_locations !== 'all') {
            $locations = BusinessLocation::whereIn('id', $permitted_locations)->pluck('name', 'id');
        } else {
            $locations = BusinessLocation::pluck('name', 'id');
        }

        if ($request->ajax()) {
            $query = Transaction::where('transactions.business_id', $business_id)
                ->where('transactions.status', 'final')
                ->where('transactions.is_suspend', 0)
                ->where('transactions.is_running_order', 0)
                ->whereIn('transactions.type', ['sell', 'sell_return'])
                ->where('transactions.status', 'final')
                ->leftJoin('zatca_settings AS zs', function($join){
                    $join->on('transactions.business_id', '=', 'zs.business_id')
                         ->on('transactions.location_id',   '=', 'zs.location_id');
                })
                
                ->leftJoin('business_locations as bl', 'transactions.location_id', '=', 'bl.id')
                ->leftJoin('contacts as c', 'transactions.contact_id', '=', 'c.id')
                ->leftJoin('transactions as T1', 'transactions.return_parent_id', '=', 'T1.id')
                ->select(
                    'transactions.id',
                    'transactions.invoice_no',
                    'bl.name as location_name',
                    \DB::raw("CASE WHEN c.contact_type = 'business' THEN c.supplier_business_name ELSE c.name END as contact_name"),
                    'transactions.sent_to_zatca',
                    'transactions.transaction_date',
                    'transactions.business_id',
                    'transactions.type',
                    'zs.is_connected as is_connected',
                    'transactions.sent_to_zatca',
                    'T1.id as parent_sale_id',
                    \DB::raw("CASE WHEN c.contact_type = 'business'AND COALESCE(c.tax_number, '') <> '' AND COALESCE(CASE WHEN c.contact_type = 'business' THEN c.supplier_business_name ELSE c.name END, '' ) <> '' AND COALESCE(c.zip_code, '') <> '' AND COALESCE(c.city, '') <> '' AND COALESCE(c.address_line_1, '') <> '' AND COALESCE(c.address_line_2, '') <> '' THEN 'B2B' ELSE 'B2C' END as invoice_type"),
                    
                );

            if (request()->has('location_id')) {
                $location_id = request()->get('location_id');
                if (!empty($location_id)) {
                    $query->where('transactions.location_id', $location_id);
                }
            }
            if ($request->filled('status') && in_array((int)$request->status, [0, 1, 2], true)) {
                $query->where('transactions.sent_to_zatca', (int)$request->status);
            }
            if ($request->filled('transaction_type')) {
                $query->where('transactions.type', $request->transaction_type);
            } else {
                $query->whereIn('transactions.type', ['sell', 'sell_return']);
            }
            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $start = Carbon::parse(request()->start_date)->startOfDay();
                $end = Carbon::parse(request()->end_date)->endOfDay();
            
                $query->whereBetween('transactions.transaction_date', [$start, $end]);
            }
            
            $countsQuery = clone $query;
            $countsQuery->select('transactions.sent_to_zatca');
            $counts = $countsQuery->get()->groupBy('sent_to_zatca')->map->count();

            $newCount = $counts->get(0, 0);
            $sentCount = $counts->get(1, 0);
            $failedCount = $counts->get(2, 0);

            return DataTables::of($query)
                ->addColumn('transaction_type', function ($transaction) {
                    if ($transaction->type == 'sell') {
                        return __('lang_v1.sell');
                    } elseif ($transaction->type == 'sell_return') {
                        return __('lang_v1.sell_return');
                    } else {
                        return $transaction->type;
                    }
                })
                ->editColumn('transaction_date', '{{@format_datetime($transaction_date)}}')
                ->addColumn('status_label', function ($transaction) {
                    switch ($transaction->sent_to_zatca) {
                        case 0:
                            return '<span class="label label-warning">' . __('lang_v1.not_sent') . '</span>';
                        case 1:
                            return '<span class="label label-success">' . __('lang_v1.sent') . '</span>';
                        case 2:
                            return '<span class="label label-danger">' . __('lang_v1.failed') . '</span>';
                        default:
                            return '<span class="label label-secondary">' . __('lang_v1.unknown') . '</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $isConnected     = isset($row->is_connected) && $row->is_connected == 1;
                    $isWithin24Hours = $this->is_within_24_hours($row->transaction_date);
                    $status          = $row->sent_to_zatca;
                    $syncUrl         = action([\Modules\Zatca\Http\Controllers\ZatcaController::class, 'SendToZatca'], [$row->id]);
                    $xmlUrl          = action([\Modules\Zatca\Http\Controllers\ZatcaController::class, 'print_xml'], ['id' => $row->id]);
                    $pdfUrl          = action([\Modules\Zatca\Http\Controllers\ZatcaController::class, 'downloadA3Pdf'], [$row->id]);
                
                    if ($isConnected && in_array($status, [0, 2], true)) {
                        if ($isWithin24Hours) {
                            return '<button 
                                        class="btn btn-primary btn-xs send_to_zatca" 
                                        onclick="window.location.href=\''. $syncUrl .'\'">
                                        <i class="fas fa-sync"></i> ' 
                                        . __("zatca::lang.send_to_zatca") .
                                   '</button>';
                        }
                        return '<button 
                                    class="btn btn-default btn-xs disabled" 
                                    data-toggle="tooltip" 
                                    title="'. __("zatca::lang.invoice_older_than_24_hours") .'">
                                    <i class="fas fa-sync"></i> ' 
                                    . __("zatca::lang.send_to_zatca") .
                               '</button>';
                    }
                
                    if ($isConnected && $status === 1) {
                        $html = '<div class="btn-group">
                        <button type="button" class="dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                            <img src="' . asset('img/icons/item.svg') . '" alt="">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">';
                        $html .= '<li>
                                      <a href="'. $xmlUrl .'" download>
                                          <i class="fas fa-file-code"></i> ' 
                                          . __("zatca::lang.print_xml") .
                                  '</a>
                                  </li>';
                        $html .= '<li>
                                      <a href="'. $pdfUrl .'" target="_blank">
                                          <i class="fas fa-file-pdf"></i> ' 
                                          . __("zatca::lang.download_a3_pdf") .
                                  '</a>
                                  </li>';
                        $html .=    '</ul>
                                </div>';
                        return $html;
                    }
                
                    // 3) Not connected (or any other fallback) → disabled “Send to ZATCA”
                    return '<button 
                                class="btn btn-default btn-xs disabled" 
                                data-toggle="tooltip" 
                                title="'. __("zatca::lang.ready_to_connect") .'">
                                <i class="fas fa-sync"></i> ' 
                                . __("zatca::lang.send_to_zatca") .
                           '</button>';
                })
                
                ->setRowAttr([
                    'data-href' => function ($row) {
                        $type = strtolower($row->type);
                        if ($type == 'sell_return' && !empty($row->parent_sale_id)) {
                            if (auth()->user()->can("sell.view")) {
                                return action('SellReturnController@show', [$row->parent_sale_id]);
                            }
                        } elseif ($type == 'sell') {
                            if (auth()->user()->can("sell.view") || auth()->user()->can("view_own_sell_only")) {
                                return action('SellController@show', [$row->id]);
                            }
                        }
                        return '';
                    }
                ])
                
                ->rawColumns(['status_label', 'action'])
                ->with([
                    'newCount' => $newCount,
                    'sentCount' => $sentCount,
                    'failedCount' => $failedCount,
                ])
                ->make(true);
        }
        $business_locations = BusinessLocation::forDropdown($business_id, false);
        $locationSettings = \Modules\Zatca\Entities\ZatcaSetting::whereIn('location_id', $business_locations->keys())
        ->pluck('is_connected','location_id')
        ->toArray();

        return view('zatca::zatca_reports.zatca_sync_report', compact('newCount', 'sentCount', 'failedCount', 'sync_statuses', 'business_locations', 'business', 'locationSettings'));
    }

    public function is_within_24_hours($date)
    {
        $now = Carbon::now()->setTimezone(config('app.timezone'));
        $cutoffTime = $now->copy()->subHours(24);
        $transactionDate = Carbon::parse($date)->setTimezone(config('app.timezone'));
        return $transactionDate->gte($cutoffTime);
    }
}