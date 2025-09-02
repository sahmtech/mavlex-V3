<?php

namespace Modules\Zatca\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SellCreatedOrModified;
use Modules\Zatca\Listeners\SyncInvoiceListener;

class ZatcaEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the Zatca module.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        SellCreatedOrModified::class => [
            SyncInvoiceListener::class,
        ],
    ];

    /**
     * Register any events for your module.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
