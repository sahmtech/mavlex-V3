<?php

namespace Modules\Zatca\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Zatca\Classes\Services\AutoSyncService;
use Illuminate\Support\Facades\Log;
use Modules\Zatca\Helpers\CurrentTransaction;

class SyncInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactionId;

    /**
     * Create a new job instance.
     *
     * @param int $transactionId
     * @return void
     */
    public function __construct(int $transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Execute the job.
     *
     * @param AutoSyncService $autoSyncService
     * @return void
     */
    public function handle(AutoSyncService $autoSyncService)
    {
        
        $transaction = Transaction::with([
            'business.settings',
            'location.zatcaSetting'    
        ])->find($this->transactionId);
        if (
            ! in_array($transaction->type, ['sell', 'sell_return'], true)
            || $transaction->status   !== 'final'
            || $transaction->is_suspend == 1
            || $transaction->is_running_order == 1
        ) {
            return;
        }
        if (! $transaction) {
            Log::error("SyncInvoiceJob: Transaction {$this->transactionId} not found.");
            return $this->fail();
        }
        $location = $transaction->location;
    
        if (! $location) {
            return;
        }
    
    
        $zs     = $location->zatcaSetting;
        $info   = is_array($location->zatca_info) ? $location->zatca_info : [];

        if ( ! $zs || $zs->is_connected != 1 || empty($info['enable_auto_sync']) || ($info['sync_frequency'] ?? '') !== 'instant') {
            return;
        }
    
        CurrentTransaction::setTransactionId($this->transactionId);
    
        try {
            $response = $autoSyncService->sendInvoice($this->transactionId);
    
            if ($response['success']) {
                $transaction->update(['sent_to_zatca' => 1]);
            } else {
                Log::error(
                    "Invoice {$this->transactionId} failed to sync. "
                    ."Reason: {$response['msg']}"
                );
                $this->fail();
            }
        } catch (\Exception $e) {
            Log::error(
              "Error syncing Invoice {$this->transactionId}: ".$e->getMessage()
            );
            $this->fail();
        } finally {
            CurrentTransaction::clear();
        }
    }
    

    /**
     * Handle a job failure.
     *
     * @param \Throwable|null $exception
     * @return void
     */
    public function failed(\Throwable $exception = null)
    {
        if ($exception) {
            Log::error("SyncInvoiceJob failed for Invoice ID: {$this->transactionId}. Exception: {$exception->getMessage()}");
        } else {
            Log::error("SyncInvoiceJob failed for Invoice ID: {$this->transactionId} with no exception provided.");
        }
    }
}
