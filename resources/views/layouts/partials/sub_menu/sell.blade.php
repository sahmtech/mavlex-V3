@php
    $enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
    $link_class = $link_class ?? ''; 
@endphp


    {{-- Sell POS --}}
    @canany(['sell.view', 'sell.create', 'direct_sell.access', 'direct_sell.view', 'view_own_sell_only', 'view_commission_agent_sell', 'access_shipping', 'access_own_shipping', 'access_commission_agent_shipping'])
        <a href="{{ action('SellPosController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'pos' && request()->segment(2) == null ? 'active' : '' }}">@lang('sale.pos_sales')</a>
    @endcanany

    {{-- Drafts --}}
    @canany(['draft.view_all', 'draft.view_own'])
        <a href="{{ action('SellController@getDrafts') }}" class="{{ $link_class }} {{ request()->segment(1) == 'sells' && request()->segment(2) == 'drafts' ? 'active' : '' }}">@lang('lang_v1.drafts')</a>
    @endcanany

    {{-- Sell Return --}}
    @canany(['access_sell_return', 'access_own_sell_return'])
        <a href="{{ action('SellReturnController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'sell-return' && request()->segment(2) == null ? 'active' : '' }}">@lang('lang_v1.sell_return')</a>
    @endcanany

    {{-- Shipments --}}
    @canany(['access_shipping', 'access_own_shipping', 'access_commission_agent_shipping'])
        <a href="{{ action('SellController@shipments') }}" class="{{ $link_class }} {{ request()->segment(1) == 'shipments' ? 'active' : '' }}">@lang('lang_v1.shipments')</a>
    @endcanany

    {{-- Discounts --}}
    @can('discount.access')
        <a href="{{ action('DiscountController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'discount' ? 'active' : '' }}">@lang('lang_v1.discounts')</a>
    @endcan

    {{-- Subscriptions --}}
    @can('direct_sell.access')
        <a href="{{ action('SellPosController@listSubscriptions') }}" class="{{ $link_class }} {{ request()->segment(1) == 'subscriptions' ? 'active' : '' }}">@lang('lang_v1.subscriptions')</a>
    @endcan

    {{-- Kitchen Module --}}
    @if(in_array('kitchen', $enabled_modules))
        <a href="{{ action('Restaurant\KitchenController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'kitchen' ? 'active' : '' }}">@lang('restaurant.kitchen')</a>
    @endif

    {{-- Orders Module --}}
    @if(in_array('service_staff', $enabled_modules))
        <a href="{{ action('Restaurant\OrderController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'orders' ? 'active' : '' }}">@lang('restaurant.orders')</a>
    @endif

    {{-- Sales Order --}}
    @php
        $pos_settings = !empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : [];
        $is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
    @endphp

    @if(!empty($pos_settings['enable_sales_order']) && $pos_settings['enable_sales_order'] == '1' && ($is_admin || auth()->user()->hasAnyPermission(['so.view_own', 'so.view_all', 'so.create'])))
        <a href="{{ action([\App\Http\Controllers\SalesOrderController::class, 'index']) }}" class="{{ $link_class }} {{ request()->segment(1) == 'sales-order' ? 'active' : '' }}">
            {{ __('lang_v1.sales_order') }}
        </a>
@endif
