

<div class="storys-container">
  <a class="navbar-brand" href="{{action([\Modules\Crm\Http\Controllers\DashboardController::class, 'index'])}}"class=" sub-menu-item {{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-dashboard' ? 'active' : '' }}"><i class="fas fa fa-broadcast-tower"></i> {{__('crm::lang.crm')}}</a>

  @if (in_array($contact->type, ['supplier', 'both']))
        <a href="{{ action([\Modules\Crm\Http\Controllers\PurchaseController::class, 'getPurchaseList']) }}" class=" sub-menu-item {{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-purchases' ? 'active' : '' }}">
          @lang('purchase.list_purchase')
        </a>
      @endif


      @if (in_array($contact->type, ['customer', 'both']))
        <a href="{{ action([\Modules\Crm\Http\Controllers\SellController::class, 'getSellList']) }}" class=" sub-menu-item{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-sells' ? 'active' : '' }}">
          @lang('lang_v1.all_sales')
        </a>
        @if (!empty($crm_settings['enable_order_request']))
          <a href="{{ action([\Modules\Crm\Http\Controllers\OrderRequestController::class, 'index']) }}" class=" sub-menu-item{{ request()->segment(1) == 'contact' && request()->segment(2) == 'order-request' ? 'active' : '' }}">
            @lang('crm::lang.order_request')
          </a>
        @endif
      @endif
      

      <a href="{{ action([\Modules\Crm\Http\Controllers\LedgerController::class, 'index']) }}" class=" sub-menu-item{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-ledger' ? 'active' : '' }}">
        @lang('lang_v1.ledger')
      </a>

      @if (in_array('booking', $enabled_modules))
        <a href="{{ action([\Modules\Crm\Http\Controllers\ContactBookingController::class, 'index']) }}" class=" sub-menu-item{{ request()->segment(2) == 'bookings' ? 'active' : '' }}">
          @lang('restaurant.bookings')
        </a>
      @endif
</div>
