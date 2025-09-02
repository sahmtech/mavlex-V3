<?php

namespace Modules\Zatca\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\Business;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Modules\Zatca\Classes\Services\AutoSyncService;

class SyncZatcaInvoices extends Command
{
    protected $signature = 'zatca:sync-invoices';
    protected $description = 'Sync all invoices with sent_to_zatca = 0 or 2 to ZATCA if business is connected';
    protected $autoSyncService;

    /**
     * Inject AutoSyncService.
     *
     * @param AutoSyncService  $autoSyncService
     * @return void
     */
    public function __construct(AutoSyncService $autoSyncService)
    {
        parent::__construct();
        $this->autoSyncService = $autoSyncService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $this->info("Starting ZATCA Invoices Sync at {$now}");
        $businesses = Business::whereHas('settings', function ($query) {
            $query->where('is_connected', 1)
                ->where('enable_auto_sync', true)
                ->where('sync_frequency', 'instant');})
            ->get();

        foreach ($businesses as $business) {
            $frequency = $business->settings->sync_frequency;

            if (!$frequency) {
                $this->warn("Business ID {$business->id} has auto sync enabled but no frequency set.");
                continue;
            }

            if ($this->shouldSync($frequency, $now)) {
                $this->info("Syncing Business ID: {$business->id} with frequency: {$frequency}");
                $cutoffTime = Carbon::now()->subHours(24);
                $transactions = Transaction::where('business_id', $business->id)
                ->whereIn('sent_to_zatca', [0, 2])
                ->whereIn('type', ['sell', 'sell_return'])
                ->where('status', 'final')
                ->where('is_suspend', 0)
                ->where('is_running_order', 0)
                ->where('transaction_date', '>=', $cutoffTime)
                ->get();
                
                if ($transactions->isEmpty()) {
                    $this->info("No invoices to sync for Business ID: {$business->id}");
                    continue;
                }

                $this->info("Found " . count($transactions) . " invoices to sync for Business ID: {$business->id}");

                foreach ($transactions as $transaction) {
                    $response = $this->autoSyncService->sendInvoice($transaction->id);

                    if ($response['success']) {
                        $this->info("Invoice No: {$transaction->invoice_no} synced successfully.");
                    } else {
                        $this->error("Invoice No: {$transaction->invoice_no} failed to sync. Reason: {$response['msg']}");
                    }
                }
            }
        }

        $this->info('ZATCA Invoices sync completed.');
        return 0;
    }

    /**
     * Determine if the business should sync based on frequency and current time.
     *
     * @param string $frequency
     * @param \Carbon\Carbon $now
     * @return bool
     */
   protected function shouldSync($frequency, $now)
{
    switch ($frequency) {
        case 'every_fifteen_minutes':
            return in_array($now->minute % 15, [0, 1]);
        case 'every_thirty_minutes':
            return in_array($now->minute % 30, [0, 1]);
        case 'hourly':
            return $now->minute === 0;
        case (str_starts_with($frequency, 'hourly_at:')):
            $minute = intval(substr($frequency, strlen('hourly_at:')));
            return $now->minute === $minute;
        case 'daily':
            return $now->hour === 0 && $now->minute === 0;
        default:
            return false;
    }
}

    
}
