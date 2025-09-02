<!-- Left side column. contains the logo and sidebar -->
<aside class="no-print">
  <!-- Sidebar top -->
  <div class="top">
    <!-- Business Name -->
    <div class="logo">
      @include('layouts.partials.logo')
    </div>

    <button id="close-btn">
      <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18.4325 6.90405L6.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M6.4325 6.90405L18.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
  </div>

  <!-- Sidebar Links -->
  <div class="sidebar">
    <div class="links">

      <a href="{{ action([\Modules\Crm\Http\Controllers\DashboardController::class, 'index']) }}" class="{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-dashboard' ? 'active' : '' }}">
        <h3>@lang('home.home')</h3>
      </a>

      @if (in_array($contact->type, ['supplier', 'both']))
        <a href="{{ action([\Modules\Crm\Http\Controllers\PurchaseController::class, 'getPurchaseList']) }}" class="{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-purchases' ? 'active' : '' }}">
          <h3>@lang('purchase.list_purchase')</h3>
        </a>
      @endif

      @if (in_array($contact->type, ['customer', 'both']))
        <a href="{{ action([\Modules\Crm\Http\Controllers\SellController::class, 'getSellList']) }}" class="{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-sells' ? 'active' : '' }}">
          <h3>@lang('lang_v1.all_sales')</h3>
        </a>
        @if (!empty($crm_settings['enable_order_request']))
          <a href="{{ action([\Modules\Crm\Http\Controllers\OrderRequestController::class, 'index']) }}" class="{{ request()->segment(1) == 'contact' && request()->segment(2) == 'order-request' ? 'active' : '' }}">
            <h3>@lang('crm::lang.order_request')</h3>
          </a>
        @endif
      @endif

      <a href="{{ action([\Modules\Crm\Http\Controllers\LedgerController::class, 'index']) }}" class="{{ request()->segment(1) == 'contact' && request()->segment(2) == 'contact-ledger' ? 'active' : '' }}">
        <h3>@lang('lang_v1.ledger')</h3>
      </a>

      @if (in_array('booking', $enabled_modules))
        <a href="{{ action([\Modules\Crm\Http\Controllers\ContactBookingController::class, 'index']) }}" class="{{ request()->segment(1) == 'bookings' ? 'active' : '' }}">
          <h3>@lang('restaurant.bookings')</h3>
        </a>
      @endif
    </div>
  </div>
</aside>
