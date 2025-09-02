<?php

namespace Modules\Zatca\Listeners;

use App\Events\SellCreatedOrModified;
use Modules\Zatca\Jobs\SyncInvoiceJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncInvoiceListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  SellCreatedOrModified  $event
     * @return void
     */
    public function handle(SellCreatedOrModified $event)
    {
        SyncInvoiceJob::dispatch($event->transaction->id);
    }
}
