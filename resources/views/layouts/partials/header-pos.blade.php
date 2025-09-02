<!-- default value -->
@php
$go_back_url = action('SellPosController@index');
$transaction_sub_type = '';
$view_suspended_sell_url = action('SellController@index').'?suspended=1';
$view_running_orders_url = action('SellController@index').'?running_order=1';
$pos_redirect_url = action('SellPosController@create');
@endphp

@if(!empty($pos_module_data))
@foreach($pos_module_data as $key => $value)
@php
if(!empty($value['go_back_url'])) {
$go_back_url = $value['go_back_url'];
}

if(!empty($value['transaction_sub_type'])) {
$transaction_sub_type = $value['transaction_sub_type'];
$view_suspended_sell_url .= '&transaction_sub_type='.$transaction_sub_type;
$pos_redirect_url .= '?sub_type='.$transaction_sub_type;
}
@endphp
@endforeach
@endif
@php
$user = auth()->user();
$is_checkout = $user->hasRole('Self Checkout#'.$user->business_id);
@endphp
@php
$is_mobile = isMobile();
@endphp

<div class="pos-heading no-print">
  <input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="{{$transaction_sub_type}}">
  @inject('request', 'Illuminate\Http\Request')
  <input type="hidden" id="pos_redirect_url" value="{{$pos_redirect_url}}">
  <div class="left-section">
    <div class="back">
      <a href="{{$go_back_url}}">
        <img src="{{ asset('img/icons/back-icon.svg') }}" alt="">
      </a>
    </div>

    <div class="pos-title">
      <h1>@lang('lang_v1.pos')</h1>
      {{--<span>Select Products for sales</span>--}}
    </div>

    <div class="location">
      @if(!$is_mobile)
      <label for="">@lang('sale.location')</label>
      @endif
      @if(empty($transaction->location_id))
      @if(count($business_locations) > 1)
      {!! Form::select('select_location_id', $business_locations, $default_location->id ?? null , ['class' => 'form-control input-sm',
      'id' => 'select_location_id',
      'required', 'autofocus'], $bl_attributes); !!}
      @else
      {{$default_location->name}}
      @endif
      @endif

      @if(!empty($transaction->location_id)) {{$transaction->location->name}} @endif &nbsp;
      <span class="curr_datetime">{{ @format_datetime('now') }}</span> <i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i>
      </div>
    @include("layouts.partials.mobile.mobile_header_pos")
  </div>
  
  <div class="right-section">
    @if (!empty($pos_settings['inline_service_staff']))
    <button type="button" id="show_service_staff_availability" title="{{ __('lang_v1.service_staff_availability') }}"
      class="btn-modal pull-right"
      data-toggle="tooltip"
      data-container=".view_modal"
      data-placement="bottom"
      data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']) }}">
      <img src="{{ asset('img/icons/users.svg') }}" alt="">

    </button>
    @endif

    @if (!empty($pos_settings['inline_service_staff']) || in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules))
    <button type="button" title="{{ __('lang_v1.service_staff_replacement') }}"
      class="btn-modal m-1 popover-default"
      id="service_staff_replacement"
      data-toggle="popover"
      data-trigger="click"
      data-content='<div class="m-2"><input type="text" class="form-control" placeholder="@lang("sale.invoice_no")" id="send_for_sell_service_staff_invoice_no"></div><div class="text-center"><button type="button" class="btn btn-primary btn-sm" id="send_for_service_staff_replacement">@lang("lang_v1.send")</button></div>'
      data-html="true" data-placement="bottom">
      <img src="{{ asset('img/icons/add-user.svg') }}" title="@lang('lang_v1.service_staff_replacement')" data-toggle="tooltip" data-placement="bottom" alt="">
    </button>
    @endif
    @if(!$is_mobile)
    <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button" class="pull-right popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
      <img src="{{ asset('img/icons/calculator.svg') }}" style="width: 28px; height:28px" alt="">
    </button>
    @endif

    @if(isset($business_details->enable_instant_pos) && $business_details->enable_instant_pos && $app_settings->enable_instant_pos)
    <button type="button" id="instant_pos_btn" title="@lang('settings.enable_instant_pos')" data-toggle="tooltip" data-placement="bottom" class="pull-right" onclick="toggleInstantPOS()" style="border: none; background: transparent; padding: 8px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 64 64" xml:space="preserve" id="instant_pos_icon">
        <path fill="none" stroke="#666" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" d="M40 1 17 37h14l-7 26 26-36H36z" id="instant_pos_path"></path>
      </svg>
    </button>
    @endif

    @if(!isset($pos_settings['hide_recent_trans']) || $pos_settings['hide_recent_trans'] == 0)
    <button class="recent-transaction" type="button" data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions">
      <img title="@lang('lang_v1.recent_transactions')" data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/recent-transactions.svg') }}" alt="">
    </button>
    @endif

    <button type="button" class=" hide-view-product" data-toggle="modal" data-target="#mobile_products_modal" title="View Products" data-toggle="tooltip">
      <img title="Products" data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/view-product.svg') }}" alt="">
    </button>

    <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}" data-toggle="tooltip" data-placement="bottom" class="btn-modal" data-container=".view_modal" data-href="{{$view_suspended_sell_url}}">
      <img src="{{ asset('img/icons/view-suspended.svg') }}" alt="">
    </button>

    @if($restaurant_settings['enable_running_orders'] == 1 || $restaurant_settings['enable_kot'] == 1)
    @if(!$is_mobile)
    <button type="button" id="view_running_orders" title="{{ __('lang_v1.view_running_orders') }}" data-toggle="tooltip" data-placement="bottom" class=" btn-modal" data-container=".view_modal" data-href="{{$view_running_orders_url}}">
      <img src="{{ asset('img/icons/running_order.svg') }}" width="24px" alt="">
    </button>
    @endif
    @endif

    @can('view_cash_register')
    <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class=" btn-modal pull-right" data-container=".register_details_modal" data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
      <img src="{{ asset('img/icons/register.svg') }}" alt="">
    </button>
    @endcan

    @can('close_cash_register')
    <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class=" btn-modal pull-right" data-container=".close_register_modal" data-href="{{ action('CashRegisterController@getCloseRegister')}}">
      <img src="{{ asset('img/icons/close-register.svg') }}" alt="">
    </button>
    @endcan

    @if(!$is_checkout)
    @if(!$is_mobile)
    <button type="button" title="{{ __('lang_v1.sell_return') }}" class=" btn-modal pull-right popover-default" id="return_sale" data-toggle="popover" data-trigger="click" data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang("sale.invoice_no")" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="btn btn-primary" id="send_for_sell_return">@lang("lang_v1.send")</button></div>' data-html="true" data-placement="bottom">
      <img src="{{ asset('img/icons/sell-return.svg') }}" style="width: 27px; " alt="" title="@lang('lang_v1.sell_return')" data-toggle="tooltip" data-placement="bottom">
    </button>
    @endif
    @endif

    @if(!$is_mobile)
    <button type="button" title="{{ __('lang_v1.full_screen') }}" class=" btn-modal pull-right" id="full_screen" data-toggle="tooltip" data-placement="bottom">
      <img src="{{ asset('img/icons/full-screen.svg') }}" style="width: 21px;" alt="">
    </button>
    @endif

    @if (! empty($pos_settings['show_price_check']) && $pos_settings['show_price_check'] == 1)
    @if(!$is_mobile)
    <a href="{{ route('price-check') }}" title="{{ __('lang_v1.price_checker') }}" class="pull-right" target="_blank">
      <img src="{{ asset('img/icons/price-check.svg') }}" style="width: 21px;" alt="">
    </a>
    @endif
    @endif

    @if(! empty($pos_settings['show_customer_display']) &&  $pos_settings['show_customer_display'] == 1)
    @if(!$is_mobile)
    <a href="{{ route('customer-display') }}" title="{{ __('lang_v1.customer_display') }}" class="pull-right" target="_blank">
      <img src="{{ asset('img/icons/dual-screen.svg') }}" style="width: 25px;" alt="">
    </a>
    @endif
    @endif

    @can('expense.add')
    <button type="button" title="{{ __('expense.add_expense') }}" data-toggle="tooltip" data-placement="bottom" class=" btn-modal pull-right" id="add_expense">
      <img src="{{ asset('img/icons/expense.svg') }}" style="width: 34px; " alt="">
    </button>
    @endcan
  </div>

</div>
<div class="modal fade" id="service_staff_modal" tabindex="-1" role="dialog"
  aria-labelledby="gridSystemModalLabel">
</div>