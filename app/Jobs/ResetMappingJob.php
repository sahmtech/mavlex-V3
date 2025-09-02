<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Business;
use App\Models\PurchaseLine;
use App\Models\Transaction;
use App\Models\JobBatch;
use App\Utils\BusinessUtil;
use App\Utils\TransactionUtil;

class ResetMappingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Only try once (avoid max attempts)
    public $tries = 1;

    protected string $batchUuid;
    protected $businessId;

    public function __construct(string $batchUuid, $businessId = 'all')
    {
        $this->batchUuid  = $batchUuid;
        $this->businessId = $businessId;
    }

    public function handle(BusinessUtil $businessUtil, TransactionUtil $transactionUtil)
    {
        Log::info("=== ResetMappingJob START [{$this->batchUuid}] business={$this->businessId} ===");

        // 1) Load batch
        $batch = JobBatch::where('uuid', $this->batchUuid)->firstOrFail();

        // 2) Delete old mappings
        DB::table('transaction_sell_lines_purchase_lines')->delete();
        Log::info("Deleted old mappings");

        // 3) Reset sold quantities
        PurchaseLine::whereNotNull('created_at')
            ->update(['quantity_sold' => 0]);
        Log::info("Reset quantity_sold on all purchase_lines");

        // 4) Compute total sell-lines
        $totalEntries = DB::table('transaction_sell_lines as tsl')
            ->join('transactions as t', 'tsl.transaction_id', '=', 't.id')
            ->when($this->businessId !== 'all',
                fn($q) => $q->where('t.business_id', $this->businessId))
            ->where('t.type', 'sell')
            ->where('t.status', 'final')
            ->count();

        // Seed batch
        $batch->update([
            'total_chunks'     => $totalEntries,
            'completed_chunks' => 0,
            'status'           => 'processing',
        ]);
        Log::info("Seeded batch total_chunks={$totalEntries}");

        // 5) Fetch businesses
        $businesses = $this->businessId === 'all'
            ? Business::all()
            : Business::where('id', $this->businessId)->get();

        // 6) Chunk through transactions exactly like your CLI
        foreach ($businesses as $business) {
            Log::info(">> Business {$business->id}: {$business->name}");

            // POS settings
            $posSettings = empty($business->pos_settings)
                ? $businessUtil->defaultPosSettings()
                : json_decode($business->pos_settings, true);
            $posSettings['allow_overselling'] = 1;

            // chunkById on Transaction to avoid OOM
            Transaction::where('business_id', $business->id)
                ->where('type', 'sell')
                ->where('status', 'final')
                ->orderBy('id')
                ->chunkById(200, function ($txns) use (
                    $business,
                    $posSettings,
                    $transactionUtil,
                    $batch
                ) {
                    $ids = $txns->pluck('id')->implode(', ');
                    Log::info("   Processing transactions: {$ids}");

                    foreach ($txns as $txn) {
                        // load sell_lines
                        $txn->load('sell_lines');

                        $businessData = [
                            'id'                => $business->id,
                            'accounting_method' => $business->accounting_method,
                            'location_id'       => $txn->location_id,
                            'pos_settings'      => $posSettings,
                        ];

                        // First pass: with lot_no_line_id
                        foreach ($txn->sell_lines as $line) {
                            if (!empty($line->lot_no_line_id)) {
                                Log::info("      WITH lot: sell_line_id={$line->id}");
                                $transactionUtil->mapPurchaseSell(
                                    $businessData,
                                    [$line],
                                    'purchase',
                                    false
                                );
                                $batch->increment('completed_chunks');
                            }
                        }

                        // Second pass: without lot_no_line_id
                        foreach ($txn->sell_lines as $line) {
                            if (empty($line->lot_no_line_id)) {
                                Log::info("      WITHOUT lot: sell_line_id={$line->id}");
                                $transactionUtil->mapPurchaseSell(
                                    $businessData,
                                    [$line],
                                    'purchase',
                                    false
                                );
                                $batch->increment('completed_chunks');
                            }
                        }
                    }
                });
        }

        // 7) Mark completed
        $batch->update(['status' => 'completed']);
        Log::info("=== ResetMappingJob COMPLETED [{$this->batchUuid}] ===");
    }
}
