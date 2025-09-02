<div class="mobile-pos-header">
<div class="btn-group" >
    <button type="button" class="dropdown-toggle btn-xs"
        data-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('img/icons/menu-flex.svg?v=' . $asset_v) }}" alt="">
    </button>

    <ul class="dropdown-menu dropdown-menu-right" role="menu" >

        @if (!empty($pos_settings['inline_service_staff']))
        <li>
            <a href="#" id="show_service_staff_availability" title="{{ __('lang_v1.service_staff_availability') }}"
                
                data-container=".view_modal"
                data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']) }}">

                @lang('lang_v1.service_staff_availability')
            </a>
        </li>
        @endif

        @if (!empty($pos_settings['inline_service_staff']) || in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules))
        <li>
            <a href="#" title="{{ __('lang_v1.service_staff_replacement') }}"
                class="btn-modal m-1 popover-default"
                id="service_staff_replacement"
                data-toggle="popover"
                data-trigger="click"
                data-content='<div class="m-2"><input type="text" class="form-control" placeholder="@lang("sale.invoice_no")" id="send_for_sell_service_staff_invoice_no"></div><div class="text-center"><button type="button" class="btn btn-primary btn-sm" id="send_for_service_staff_replacement">@lang("lang_v1.send")</button></div>'
                data-html="true" data-placement="bottom">

                @lang('lang_v1.service_staff_replacement')
            </a>
        </li>
        @endif


        @if (!isset($pos_settings['hide_recent_trans']) || $pos_settings['hide_recent_trans'] == 0)
        <li>
            <a href="#" class="recent-transaction" data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions">
                @lang('lang_v1.recent_transactions')
            </a>
        </li>
        @endif

        <li>
            <a href="#" class="hide-view-product" data-toggle="modal" data-target="#mobile_products_modal" title="View Products" data-toggle="tooltip">

                @lang('lang_v1.view_products')
            </a>
        </li>

        <li>
            <a href="#" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal" data-container=".view_modal" data-href="{{$view_suspended_sell_url}}">

                @lang('lang_v1.view_suspended_sales')
            </a>
        </li>

        @if ($restaurant_settings['enable_kot'] == 1 || $restaurant_settings['enable_running_orders'] == 1)
        <li>
            <a href="#" id="view_running_orders" title="{{ __('lang_v1.view_running_orders') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal" data-container=".view_modal" data-href="{{$view_running_orders_url}}">
            @lang('lang_v1.view_running_orders')
            </a>
            
        </li>
        @endif

        @can('view_cash_register')
        <li>
            <a href="#" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal " data-container=".register_details_modal" data-href="{{ action('CashRegisterController@getRegisterDetails') }}">

                @lang('cash_register.register_details')
            </a>
        </li>
        @endcan

        @can('close_cash_register')
        <li>
            <a href="#" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal " data-container=".close_register_modal" data-href="{{ action('CashRegisterController@getCloseRegister') }}">

                @lang('cash_register.close_register')
            </a>
        </li>
        @endcan

        @if (!$is_checkout)
        <li>
            <a href="#" title="{{ __('lang_v1.sell_return') }}" class="btn-modal popover-default" id="return_sale"
                data-toggle="popover" data-trigger="click"
                data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang("sale.invoice_no")" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="btn btn-primary" id="send_for_sell_return">@lang("lang_v1.send")</button></div>'
                data-html="true" data-placement="bottom">

                @lang('lang_v1.sell_return')
            </a>
        </li>
        @endif
        @if (! empty($pos_settings['show_price_check']) && $pos_settings['show_price_check'] == 1)
        <li>
            <a href="{{ route('price-check') }}" title="{{ __('lang_v1.price_checker') }}" target="_blank">

                @lang('lang_v1.price_checker')
            </a>
        </li>
        @endif

        @if(! empty($pos_settings['show_customer_display']) &&  $pos_settings['show_customer_display'] == 1)
        <li>
            <a href="{{ route('customer-display') }}" title="{{ __('lang_v1.customer_display') }}" target="_blank">

                @lang('lang_v1.customer_display')
            </a>
        </li>
        @endif

        @can('expense.add')
        <li>
            <a href="#" title="{{ __('expense.add_expense') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal" id="add_expense">

                @lang('expense.add_expense')
            </a>
        </li>
        @endcan

    </ul>
</div>
</div>

<div class="modal fade" id="service_staff_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
