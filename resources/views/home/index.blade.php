@extends('layouts.app')
@section('title', __('home.home'))@section('content')
@php
    $dashboard_settings = !empty(session()->get('business.dashboard_settings')) ? json_decode(session()->get('business.dashboard_settings'), true) : [];
    $sales_due_disabled = ($dashboard_settings['disable_sales_due'] ?? 0) == 1;
    $purchase_due_disabled = ($dashboard_settings['disable_purchase_due'] ?? 0) == 1;
    $stock_alert_disabled = ($dashboard_settings['disable_stock_alert'] ?? 0) == 1;
    $stock_expiry_disabled = ($dashboard_settings['disable_stock_expiry'] ?? 0) == 1;
    $sales_order_disabled = ($dashboard_settings['disable_sales_order'] ?? 0) == 1;
    $purchase_order_disabled = ($dashboard_settings['disable_purchase_order'] ?? 0) == 1;
    $pending_shipments_disabled = ($dashboard_settings['disable_pending_shipments'] ?? 0) == 1;
    $payment_recover_disabled = ($dashboard_settings['disable_payment_recover'] ?? 0) == 1;
    $performance_disabled = ($dashboard_settings['disable_performance'] ?? 0) == 1;
    $fy_sales_chart_disabled = ($dashboard_settings['disable_fy_sales_chart'] ?? 0) == 1;
    $purchase_requisition_disabled = ($dashboard_settings['disable_purchase_requisition'] ?? 0) == 1;
    //Widgets
    $sell_return_widget_disabled = ($dashboard_settings['disable_sell_return_widget'] ?? 0) == 1;
    $purchase_return_widget_disabled = ($dashboard_settings['disable_purchase_return_widget'] ?? 0) == 1;
    $expense_widget_disabled = ($dashboard_settings['disable_expense_widget'] ?? 0) == 1;
    $total_purchase_widget_disabled = ($dashboard_settings['disable_total_purchase_widget'] ?? 0) == 1;
    $purchase_due_widget_disabled = ($dashboard_settings['disable_purchase_due_widget'] ?? 0) == 1;
@endphp
<!-- Main content -->
<div class="main-container no-print">
    <div class="overview-filter">
        <div class="title">
            <h1>{{ Session::get('business.name') }}</h1>
            <p>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}</p>
        </div>
        @if (auth()->user()->can('dashboard.data'))
            @if ($is_admin)
                <div class="filter">
                    <div class="form-box">
                        @if (count($all_locations) > 1)
                            {!! Form::select('dashboard_location', $all_locations, null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('lang_v1.select_location'),
                                'id' => 'dashboard_location',
                                'style' => 'width: 270px;',
                            ]) !!}
                        @endif
                    </div> <button id="dashboard_date_filter" style="background-color: #ffffff;">
                        <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                        <span>@lang('lang_v1.filter')</span>
                    </button>
                </div>
            @endif
        @endif
    </div>
    @if (auth()->user()->can('dashboard.data'))
        @if ($is_admin)
            <div class="quick-data @if ($sell_return_widget_disabled)no-sell-return @endif">
                <!-- Sales -->
                <div class="item">
                    <div class="head">
                        <img src="{{ asset('img/icons/sales.svg') }}" alt="">
                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                    </div>
                    <div class="item-body">
                        <div class="data-name">
                            <h5>{{ __('home.total_sell') }}</h5>
                            <h3>
                                <span class="info-box-number total_sell"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div> 
                <!-- Sell Return -->
                @if ($sell_return_widget_disabled == false)
                <div class="item">
                    <div class="head">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="97.904 232.924 40 40" width="40px" height="40px">
                        <rect width="40" height="40" rx="20" x="97.904" y="232.924" style="fill: #FFDADB;" transform="matrix(1, 0, 0, 1, 0, 7.105427357601002e-15)"/>
                        <path d="M 126.404 248.204 L 117.904 252.924 M 117.904 252.924 L 109.404 248.204 M 117.904 252.924 L 117.904 262.424 M 126.904 256.984 L 126.904 248.864 C 126.904 248.524 126.904 248.354 126.854 248.194 C 126.804 248.064 126.734 247.944 126.634 247.834 C 126.534 247.714 126.384 247.634 126.084 247.464 L 118.684 243.354 C 118.394 243.194 118.254 243.124 118.104 243.084 C 117.974 243.064 117.834 243.064 117.704 243.084 C 117.554 243.124 117.414 243.194 117.124 243.354 L 109.724 247.464 C 109.424 247.634 109.274 247.714 109.164 247.834 C 109.074 247.944 109.004 248.064 108.954 248.194 C 108.904 248.354 108.904 248.524 108.904 248.864 L 108.904 256.984 C 108.904 257.324 108.904 257.494 108.954 257.654 C 109.004 257.784 109.074 257.904 109.164 258.014 C 109.274 258.134 109.424 258.214 109.724 258.384 L 117.124 262.494 C 117.414 262.654 117.554 262.724 117.704 262.764 C 117.834 262.784 117.974 262.784 118.104 262.764 C 118.254 262.724 118.394 262.654 118.684 262.494 L 126.084 258.384 C 126.384 258.214 126.534 258.134 126.634 258.014 C 126.734 257.904 126.804 257.784 126.854 257.654 C 126.904 257.494 126.904 257.324 126.904 256.984 Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="fill: none;" transform="matrix(1, 0, 0, 1, 0, 7.105427357601002e-15)"/>
                        <path d="M 122.404 250.424 L 113.404 245.424" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" transform="matrix(1, 0, 0, 1, 0, 7.105427357601002e-15)"/>
                        <path d="M 107.904 260.924 C 114.57 267.591 121.237 267.591 127.904 260.924" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" transform="matrix(1, 0, 0, 1, 0, 7.105427357601002e-15)"/>
                        <polygon points="126.328 260.192 129.056 261.925 130.06 258.083" fill="black" transform="matrix(1, 0, 0, 1, 0, 7.105427357601002e-15)"/>
                        </svg>
                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                    </div>
                    <div class="item-body">
                        <div class="data-name">
                            <h5>{{ __('lang_v1.total_sell_return') }}</h5>
                            <h3>
                                <span class="info-box-number total_sell_return"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div> 
                @endif
                <!-- Invoice Due -->
                <div class="item">
                    <div class="head">
                        <img src="{{ asset('img/icons/Pending-payment.svg') }}" alt="">
                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                    </div>
                    <div class="item-body">
                        <div class="data-name">
                            <h5>{{ __('home.invoice_due') }}</h5>
                            <h3>
                                <span class="info-box-number invoice_due"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div> 
                <!--Total Payments -->
                <div class="item">
                    <div class="head">
                        <img src="{{ asset('img/icons/Expenses-icon.svg') }}" alt="">
                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                    </div>
                    <div class="item-body">
                        <div class="data-name">
                            <h5>{{ __('home.total_payments') }}</h5>
                            <h3>
                                <span class="info-box-number total_payments"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i>0.00</span>
                            </h3>
                        </div>
                    </div>
                </div> 
                <!-- Net Sales -->
                <div class="item">
                    <div class="head">
                        <img src="{{ asset('img/icons/Purchase.svg') }}" alt="">
                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                    </div>
                    <div class="item-body">
                        <div class="data-name">
                            <h5>{{ __('home.net_sales') }}</h5>
                            <h3><span class="info-box-number net_sales"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i>0.00</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end is_admin check -->
             {{-- @if (!empty($widgets['after_sale_purchase_totals']))
                @foreach ($widgets['after_sale_purchase_totals'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif --}} 
            
            @if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                @if (!empty($all_locations))
                    @if ($performance_disabled == false)
                    
                        <!-- sales chart start -->
                        <div class="main-title">
                            <h2>{{ __('lang_v1.performance') }}</h2>
                        </div>
                        <div class="graph-card-wrapper @if ($sell_return_widget_disabled)no-sell-return @endif @if ($expense_widget_disabled && $total_purchase_widget_disabled && $purchase_due_widget_disabled && $purchase_return_widget_disabled) no-extra @endif @if ($fy_sales_chart_disabled) no_fy_sales @endif ">
                            <div class="chart" >
                                @component('components.widget', ['class' => 'box-primary ', 'title' => __('home.sells_last_30_days')])
                                    {!! $sells_chart_1->container() !!}
                                @endcomponent
                                @if ($fy_sales_chart_disabled == false)
                                @component('components.widget', ['class' => 'box-primary', 'title' => __('home.sells_current_fy')])
                                {!! $sells_chart_2->container() !!}
                                 @endcomponent
                                 @endif
                            </div>
                            @if (!$expense_widget_disabled || !$total_purchase_widget_disabled || !$purchase_due_widget_disabled || !$purchase_return_widget_disabled)
                            <div class="extra-data">
                                @if ($expense_widget_disabled == false)
                                <!-- Expense -->
                                <div class="item">
                                    <div class="head">
                                        <img src="{{ asset('img/icons/money-in.svg') }}" alt="">
                                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                                    </div>
                                    <div class="item-body">
                                        <div class="data-name">
                                            <h5>{{ __('lang_v1.expense') }}</h5>
                                            <h3 class="total_expense">0.00</h3>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- purchase -->
                                @if ($total_purchase_widget_disabled == false)
                                <div class="item">
                                    <div class="head">
                                        <img src="{{ asset('img/icons/Purchase.svg') }}" alt="">
                                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                                    </div>
                                    <div class="item-body">
                                        <div class="data-name">
                                            <h5>{{ __('home.total_purchase') }}</h5>
                                            <h3 class="total_purchase">0.00</h3>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- purchase due -->
                                @if ($purchase_due_widget_disabled == false)
                                <div class="item">
                                    <div class="head"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="97.904 232.924 40 40" width="40px" height="40px">
                                          <rect width="40" height="40" rx="20" x="97.904" y="232.924" style="fill: rgb(255, 182, 80);"/>
                                          <text style=" font-size: 10px; white-space: pre;" transform="matrix(2.1220979690551762, 0, 0, 1.5986599922180176, -186.40648415639504, -144.4246714450399)" x="145" y="255.321">!</text>
                                          <path d="M 127.394 248.458 L 118.894 253.181 M 118.894 253.181 L 110.394 248.458 M 118.894 253.181 L 118.894 262.681 M 120.894 262.07 L 119.671 262.749 C 119.387 262.907 119.246 262.985 119.095 263.016 C 118.963 263.044 118.825 263.044 118.693 263.016 C 118.542 262.985 118.401 262.907 118.117 262.749 L 110.717 258.638 C 110.417 258.471 110.268 258.388 110.159 258.27 C 110.062 258.165 109.989 258.041 109.944 257.906 C 109.894 257.753 109.894 257.582 109.894 257.239 L 109.894 249.122 C 109.894 248.779 109.894 248.608 109.944 248.455 C 109.989 248.32 110.062 248.196 110.159 248.091 C 110.268 247.973 110.417 247.89 110.717 247.723 L 118.117 243.612 C 118.401 243.455 118.542 243.376 118.693 243.345 C 118.825 243.318 118.963 243.318 119.095 243.345 C 119.246 243.376 119.387 243.455 119.671 243.612 L 127.071 247.723 C 127.371 247.89 127.52 247.973 127.629 248.091 C 127.726 248.196 127.799 248.32 127.844 248.455 C 127.894 248.608 127.894 248.779 127.894 249.122 L 127.894 253.681 M 114.394 245.681 L 123.394 250.681" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="fill: none;"/>
                                        </svg>
                                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                                    </div>
                                    <div class="item-body">
                                        <div class="data-name">
                                            <h5>{{ __('home.purchase_due') }}</h5>
                                            <h3 class="purchase_due">0.00</h3>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- purchase return -->
                                @if ($purchase_return_widget_disabled == false)
                                <div class="item">
                                    <div class="head">   
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="4.282 278.01 40 40" width="40px" height="40px">
                                          <mask id="path-2-inside-1_370_14145" fill="white">
                                            <path d="M 31.465 289.352 C 31.73 289.033 32.204 288.987 32.506 289.271 C 34.102 290.773 35.259 292.686 35.847 294.807 C 36.501 297.169 36.416 299.675 35.604 301.987 C 34.791 304.3 33.29 306.308 31.302 307.742 C 29.314 309.176 26.935 309.967 24.484 310.008 C 22.033 310.049 19.629 309.339 17.594 307.973 C 15.559 306.607 13.991 304.65 13.101 302.366 C 12.211 300.082 12.042 297.581 12.616 295.198 C 13.132 293.059 14.225 291.107 15.769 289.553 C 16.061 289.259 16.537 289.289 16.812 289.598 C 17.087 289.908 17.056 290.38 16.767 290.677 C 15.451 292.026 14.518 293.708 14.074 295.549 C 13.572 297.634 13.72 299.823 14.498 301.822 C 15.277 303.82 16.649 305.532 18.43 306.728 C 20.21 307.923 22.314 308.544 24.459 308.508 C 26.603 308.472 28.685 307.78 30.425 306.526 C 32.164 305.271 33.478 303.514 34.189 301.49 C 34.9 299.467 34.974 297.274 34.401 295.207 C 33.896 293.382 32.907 291.732 31.546 290.428 C 31.247 290.141 31.201 289.67 31.465 289.352 Z"/>
                                          </mask>
                                          <rect width="40" height="40" rx="20" fill="#CADEFC" x="4.282" y="278.01" transform="matrix(1, 0, 0, 1, 0, 2.842170943040401e-14)"/>
                                          <path d="M 31.465 289.352 C 31.73 289.033 32.205 288.987 32.506 289.271 C 34.102 290.773 35.26 292.686 35.847 294.807 C 36.501 297.169 36.416 299.675 35.604 301.988 C 34.791 304.3 33.29 306.309 31.302 307.742 C 29.314 309.176 26.935 309.967 24.484 310.008 C 22.033 310.05 19.629 309.339 17.594 307.973 C 15.559 306.607 13.991 304.65 13.101 302.367 C 12.211 300.083 12.042 297.581 12.616 295.198 C 13.132 293.059 14.225 291.107 15.769 289.553 C 16.061 289.259 16.537 289.289 16.812 289.599 C 17.087 289.908 17.056 290.38 16.767 290.677 C 15.451 292.026 14.518 293.708 14.075 295.55 C 13.572 297.635 13.72 299.824 14.499 301.822 C 15.277 303.82 16.649 305.532 18.43 306.728 C 20.21 307.923 22.315 308.545 24.459 308.509 C 26.603 308.473 28.685 307.781 30.425 306.526 C 32.164 305.271 33.478 303.514 34.189 301.491 C 34.9 299.467 34.974 297.274 34.401 295.207 C 33.896 293.382 32.907 291.732 31.546 290.428 C 31.247 290.142 31.201 289.671 31.465 289.352 Z" stroke="#111827" stroke-width="3" mask="url(#path-2-inside-1_370_14145)" transform="matrix(1, 0, 0, 1, 0, 2.842170943040401e-14)"/>
                                          <path d="M 34.558 288.949 L 30.008 286.9 L 30.374 291.867" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="" transform="matrix(1, 0, 0, 1, 0, 2.842170943040401e-14)"/>
                                          <path d="M 29.568 295.666 L 24.118 298.695 M 24.118 298.695 L 18.668 295.666 M 24.118 298.695 L 24.118 304.786 M 25.401 304.394 L 24.617 304.829 C 24.434 304.931 24.344 304.981 24.247 305.001 C 24.163 305.019 24.074 305.019 23.989 305.001 C 23.893 304.981 23.802 304.931 23.62 304.829 L 18.876 302.194 C 18.683 302.086 18.588 302.033 18.518 301.958 C 18.456 301.89 18.409 301.811 18.38 301.724 C 18.348 301.626 18.348 301.516 18.348 301.297 L 18.348 296.092 C 18.348 295.872 18.348 295.763 18.38 295.665 C 18.409 295.578 18.456 295.498 18.518 295.431 C 18.588 295.356 18.683 295.302 18.876 295.195 L 23.62 292.559 C 23.802 292.459 23.893 292.408 23.989 292.388 C 24.074 292.371 24.163 292.371 24.247 292.388 C 24.344 292.408 24.434 292.459 24.617 292.559 L 29.361 295.195 C 29.554 295.302 29.649 295.356 29.719 295.431 C 29.781 295.498 29.828 295.578 29.857 295.665 C 29.889 295.763 29.889 295.872 29.889 296.092 L 29.889 299.015 M 21.233 293.886 L 27.004 297.092 M 28.607 304.465 L 28.607 300.618 M 26.683 302.542 L 30.53 302.542" stroke="#111827" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="fill: none;" transform="matrix(1, 0, 0, 1, 0, 2.842170943040401e-14)"/>
                                        </svg>
                                        <span class="dashboard_date_filter_value">{{ __('lang_v1.today') }}</span>
                                    </div>
                                    <div class="item-body">
                                        <div class="data-name">
                                            <h5>{{ __('lang_v1.total_purchase_return') }}</h5>
                                            <h3 class="total_purchase_return">0.00</h3>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endif
                    @endif
                @endif
            @endif
            
            <div class="short-list-wrapper">
                @if ($sales_due_disabled == false)
                    <!-- Shortlist item -->
                    <!-- Sales Payment Due -->
                    @if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                        <div class="short-list-item">
                            <div class="heading">
                                <h3> {{ __('lang_v1.sales_payment_dues') }}
                                    @show_tooltip(__('lang_v1.tooltip_sales_payment_dues'))</h3>
                                <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="col-md-4 ">
                                    @if (count($all_locations) > 1)
                                        {!! Form::select('sales_payment_dues_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'sales_payment_dues_location',
                                        ]) !!}
                                    @endif
                                </div>
                                <table class="max-table" id="sales_payment_dues_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('contact.customer')</th>
                                            <th>@lang('sale.payment_status')</th>
                                            <th>@lang('sale.invoice_no')</th>
                                            <th>@lang('home.due_amount')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif <!-- Shortlist item -->
                <!-- Purchase Payment Due -->
                @if ($purchase_due_disabled == false)
                    @can('purchase.view')
                        <div class="short-list-item">
                            <div class="heading">
                                <h3> {{ __('lang_v1.purchase_payment_dues') }} @show_tooltip(__('tooltip.payment_dues'))
                                </h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="col-md-4">
                                    @if (count($all_locations) > 1)
                                        {!! Form::select('purchase_payment_dues_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'purchase_payment_dues_location',
                                        ]) !!}
                                    @endif
                                </div>
                                <table class="max-table" id="purchase_payment_dues_table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>@lang('purchase.supplier')</th>
                                            <th>@lang('purchase.ref_no')</th>
                                            <th>@lang('home.due_amount')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endcan
                @endif <!-- Shortlist item -->
                <!-- Stock Alert -->
                @if ($stock_alert_disabled == false)
                    @can('stock_report.view')
                        <div class="short-list-item">
                            <div class="heading">
                                <h3>{{ __('home.product_stock_alert') }}</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <table class="max-table" id="stock_alert_table" style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('sale.product')</th>
                                            <th>@lang('business.location')</th>
                                            <th>@lang('report.current_stock')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endcan
                @endif <!-- Shortlist item -->
                <!-- Stock ExpiryAlert -->
                @if ($stock_expiry_disabled == false)
                    @if (session('business.enable_product_expiry') == 1)
                        <div class="short-list-item">
                            <div class="heading">
                                <h3>{{ __('home.stock_expiry_alert') }}</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="search-export"> </div>
                               <input type="hidden" id="stock_expiry_alert_days" value="{{ \Carbon\Carbon::now()->addDays((int) session('business.stock_expiry_alert_days', 30))->format('Y-m-d') }}">
                                <table class="max-table" id="stock_expiry_alert_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('business.product')</th>
                                            <th>@lang('business.location')</th>
                                            <th>@lang('report.stock_left')</th>
                                            <th>@lang('product.expires_in')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif <!-- Shortlist item -->
                <!-- Sales Order -->
                @if ($sales_order_disabled == false)
                    @if (auth()->user()->can('so.view_all') || auth()->user()->can('so.view_own'))
                        <div class="short-list-item">
                            <div class="heading">
                                <h3>{{ __('lang_v1.sales_order') }}</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="search-export"> </div>
                                
                                    @if (count($all_locations) > 1)
                                    <div class="col-md-4">
                                        {!! Form::select('so_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'so_location',
                                        ]) !!}
                                          </div>
                                    @endif
                              
                                <table class="max-table" id="sales_order_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('restaurant.order_no')</th>
                                            <th>@lang('sale.customer_name')</th>
                                            <th>@lang('sale.status')</th>
                                            <th>@lang('lang_v1.shipping_status')</th>
                                            <th>@lang('lang_v1.quantity_remaining')</th>
                                            <th>@lang('lang_v1.added_by')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif <!-- Shortlist item -->
                <!-- Purchase Requisition -->
                @if ($purchase_requisition_disabled == false)
                @if (!empty($common_settings['enable_purchase_requisition']) &&(auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own')))
                    <div class="short-list-item">
                        <div class="heading">
                            <h3>@lang('lang_v1.purchase_requisition')</h3> <button>
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="content">
                            <div class="col-md-4">
                                @if (count($all_locations) > 1)
                                    {!! Form::select('pr_location', $all_locations, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => __('lang_v1.select_location'),
                                        'id' => 'pr_location',
                                    ]) !!}
                                @endif
                            </div>
                            <table class="max-table" id="purchase_requisition_table"
                                style="margin-top: 2rem; width: 100% ;">
                                <thead>
                                    <tr>
                                        <th>@lang('messages.action')</th>
                                        <th>@lang('messages.date')</th>
                                        <th>@lang('purchase.ref_no')</th>
                                        <th>@lang('purchase.location')</th>
                                        <th>@lang('sale.status')</th>
                                        <th>@lang('lang_v1.required_by_date')</th>
                                        <th>@lang('lang_v1.added_by')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif 
                @endif
                
                <!-- Shortlist item -->
                <!-- Purchase Order -->
                @if ($purchase_order_disabled == false)
                    @if (!empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')))
                        <div class="short-list-item">
                            <div class="heading">
                                <h3>@lang('lang_v1.purchase_order')</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="col-md-4">
                                    @if (count($all_locations) > 1)
                                        {!! Form::select('po_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'po_location',
                                        ]) !!}
                                    @endif
                                </div>
                                <table class="max-table" id="purchase_order_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('purchase.ref_no')</th>
                                            <th>@lang('purchase.location')</th>
                                            <th>@lang('purchase.supplier')</th>
                                            <th>@lang('sale.status')</th>
                                            <th>@lang('lang_v1.quantity_remaining')</th>
                                            <th>@lang('lang_v1.added_by')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif <!-- Shortlist item -->
                <!-- Pending Shipments -->
                @if ($pending_shipments_disabled == false)
                    @if (auth()->user()->can('access_pending_shipments_only') ||auth()->user()->can('access_shipping') || auth()->user()->can('access_own_shipping'))
                        <div class="short-list-item">
                            <div class="heading">
                                <h3>@lang('lang_v1.pending_shipments')</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <div class="col-md-4">
                                    @if (count($all_locations) > 1)
                                        {!! Form::select('pending_shipments_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'pending_shipments_location',
                                        ]) !!}
                                    @endif
                                </div>
                                <table class="max-table" id="shipments_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('sale.invoice_no')</th>
                                            <th>@lang('sale.customer_name')</th>
                                            <th>@lang('lang_v1.contact_no')</th>
                                            <th>@lang('sale.location')</th>
                                            <th>@lang('lang_v1.shipping_status')</th>
                                            @if (!empty($custom_labels['shipping']['custom_field_1']))
                                                <th>{{ $custom_labels['shipping']['custom_field_1'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_2']))
                                                <th>{{ $custom_labels['shipping']['custom_field_2'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_3']))
                                                <th>{{ $custom_labels['shipping']['custom_field_3'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_4']))
                                                <th>{{ $custom_labels['shipping']['custom_field_4'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_5']))
                                                <th>{{ $custom_labels['shipping']['custom_field_5'] }}</th>
                                            @endif
                                            <th>@lang('sale.payment_status')</th>
                                            <th>@lang('restaurant.service_staff')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
                <!-- Shortlist item -->
                <!-- Payment Recovered Today -->
                @if ($payment_recover_disabled == false)
                    @if (auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true)
                        <div class="short-list-item">
                            <div class="heading">
                                <h3> @lang('lang_v1.payment_recovered_today')</h3> <button>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5 15.5L12.5 9.5L6.5 15.5" stroke="black" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="content">
                                <table class="max-table" id="cash_flow_table"
                                    style="margin-top: 2rem; width: 100% ;">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('account.account')</th>
                                            <th>@lang('lang_v1.description')</th>
                                            <th>@lang('lang_v1.payment_method')</th>
                                            <th>@lang('lang_v1.payment_details')</th>
                                            <th>@lang('account.credit')</th>
                                            <th>@lang('lang_v1.account_balance') @show_tooltip(__('lang_v1.account_balance_tooltip'))
                                            </th>
                                            <th>@lang('lang_v1.total_balance') @show_tooltip(__('lang_v1.total_balance_tooltip'))
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="bg-gray font-17 footer-total text-center">
                                            <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                            <td class="footer_total_credit"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            @if (!empty($widgets['after_sales_last_30_days']))
                @foreach ($widgets['after_sales_last_30_days'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif
        <!-- sales chart end -->
        @if (!empty($widgets['after_sales_current_fy']))
            @foreach ($widgets['after_sales_current_fy'] as $widget)
                {!! $widget !!}
            @endforeach
        @endif
        <!-- products less than alert quntity --> <!-- Sales payment due removed here -->
        <!-- Product stock alert removed here -->
        @if (!empty($widgets['after_dashboard_reports']))
            @foreach ($widgets['after_dashboard_reports'] as $widget)
                {!! $widget !!}
            @endforeach
        @endif
    @endif <!-- can('dashboard.data') end -->
</div>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
@include('home.email_verification_modal') @include('home.review_modal')
@stop
@section('javascript')
<script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@includeIf('sales_order.common_js')
@includeIf('purchase_order.common_js')
@if (!empty($all_locations))
    {!! $sells_chart_1->script() !!}
    {!! $sells_chart_2->script() !!}
@endif
<script type="text/javascript">
    if ("{{ session()->get('review_alert') }}") {
        $('#review_modal').modal('toggle');
    }

    function hasOneDayPassed() {
        var date = new Date().toLocaleDateString();
        if (localStorage.yourapp_date == date)
            return false;
        localStorage.yourapp_date = date;
        return true;
    }

    function runOncePerDay() {
        if (!hasOneDayPassed()) return false;
        $('#message_modal').modal('toggle');
    }
    $(document).ready(function() {
        sales_order_table = $('#sales_order_table').DataTable({
            processing: true,
        serverSide: true,
        searching: false,
        scrollY:        "75vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: false,
        dom: 'Btirp',
            "ajax": {
                "url": '{{ action('SellController@index') }}?sale_type=sales_order',
                "data": function(d) {
                    d.for_dashboard_sales_order = true;
                    if ($('#so_location').length > 0) {
                        d.location_id = $('#so_location').val();
                    }
                }
            },
           
            columns: [{
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no'
                },
                {
                    data: 'conatct_name',
                    name: 'conatct_name'
                }, {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'shipping_status',
                    name: 'shipping_status'
                },
                {
                    data: 'so_qty_remaining',
                    name: 'so_qty_remaining',
                    "searchable": false
                },
                {
                    data: 'added_by',
                    name: 'u.first_name'
                },
                ],
        fnDrawCallback: function(oSettings) {
            __show_date_diff_for_human($('#sales_order_table'));
            __currency_convert_recursively($('#sales_order_table'));
        },
    }); 
    //Payment Recovered:
        @if (auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true) // Cash Flow Table
            cash_flow_table = $('#cash_flow_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{{ action([\App\Http\Controllers\AccountController::class, 'cashFlow']) }}",
                    "data": function(d) {
                        d.type = 'credit';
                        d.only_payment_recovered = true;
                    }
                },
                "ordering": false,
                "searching": false,
                dom: 'Btirp',
                columns: [{
                        data: 'operation_date',
                        name: 'operation_date'
                    },
                    {
                        data: 'account_name',
                        name: 'account_name'
                    },
                    {
                        data: 'sub_type',
                        name: 'sub_type'
                    },
                    {
                        data: 'method',
                        name: 'TP.method'
                    },
                    {
                        data: 'payment_details',
                        name: 'payment_details',
                        searchable: false
                    },
                    {
                        data: 'credit',
                        name: 'amount'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'total_balance',
                        name: 'total_balance'
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    __currency_convert_recursively($('#cash_flow_table'));
                },
                "footerCallback": function(row, data, start, end, display) {
                    var footer_total_credit = 0;
                    for (var r in data) {
                        footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(
                            data[r].credit).data('orig-value')) : 0;
                    }
                    $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                }
            });
        @endif
        $('#so_location').change(function() {
            sales_order_table.ajax.reload();
        });
        @if (!empty($common_settings['enable_purchase_order']))
            //Purchase table
            purchase_order_table = $('#purchase_order_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [
                    [1, 'desc']
                ],
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: '{{ action('PurchaseOrderController@index') }}',
                    data: function(d) {
                        d.from_dashboard = true;
                        if ($('#po_location').length > 0) {
                            d.location_id = $('#po_location').val();
                        }
                    },
                },
                dom: 'Btirp',
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },
                    {
                        data: 'location_name',
                        name: 'BS.name'
                    }, {
                        data: 'name',
                        name: 'contacts.name'
                    }, {
                        data: 'status',
                        name: 'transactions.status'
                    },
                    {
                        data: 'po_qty_remaining',
                        name: 'po_qty_remaining',
                        "searchable": false
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    }
                ]
            }); 
            $('#po_location').change(function() {
                purchase_order_table.ajax.reload();
            });
        @endif
        sell_table = $('#shipments_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [
                [1, 'desc']
            ],
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            "ajax": {
                "url": '{{ action('SellController@index') }}',
                "data": function(d) {
                    d.only_pending_shipments = true;
                    if ($('#pending_shipments_location').length > 0) {
                        d.location_id = $('#pending_shipments_location').val();
                    }
                }
            },
            dom: 'Btirp',
            columns: [{
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no'
                },
                {
                    data: 'conatct_name',
                    name: 'conatct_name'
                },
                {
                    data: 'mobile',
                    name: 'contacts.mobile'
                },
                {
                    data: 'business_location',
                    name: 'bl.name'
                },
                {
                    data: 'shipping_status',
                    name: 'shipping_status'
                },
                @if (!empty($custom_labels['shipping']['custom_field_1']))
                    {
                        data: 'shipping_custom_field_1',
                        name: 'shipping_custom_field_1'
                    },
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_2']))
                    {
                        data: 'shipping_custom_field_2',
                        name: 'shipping_custom_field_2'
                    },
                @endif
                @if (!empty($custom_labels['shipping']['custom_field_3']))
                    {
                        data: 'shipping_custom_field_3',
                        name: 'shipping_custom_field_3'
                    },
                @endif
                @if (!empty($custom_labels['shipping']['custom_field_4']))
                    {
                        data: 'shipping_custom_field_4',
                        name: 'shipping_custom_field_4'
                    },
                @endif
                @if (!empty($custom_labels['shipping']['custom_field_5']))
                    {
                        data: 'shipping_custom_field_5',
                        name: 'shipping_custom_field_5'
                    },
                @endif {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'waiter',
                    name: 'ss.first_name',
                    @if (empty($is_service_staff_enabled))
                        visible: false
                    @endif
                }
            ],
            "fnDrawCallback": function(oSettings) {
                __currency_convert_recursively($('#sell_table'));
            },
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:eq(4)').attr('class', 'clickable_td');
            }
        });
        $('#pending_shipments_location').change(function() {
            sell_table.ajax.reload();
        });
        // $('button#fund-wallet').click(function() {
        //     $('div#fund_wallet_modal').modal('show');
        // });
    });
    // $(document).ready(function() {
    //     $('.reload_payment_modal').click(function() {
    //         location.reload()
    //     });        //     $.ajax({
    //         method: 'GET',
    //         url: '/user/is-email-verified',
    //         dataType: 'json',
    //         success: function(result) {
    //             console.log(result);
    //             if (result.success == true) {
    //                 console.log('True');
    //             } else {
    //                 $('div#email_verification_modal').modal('show');
    //             }        //         },
    //     });        //     $('button#resend-email').click(function() {
    //         $('div#email_verified_modal').modal('hide');
    //         $('div#email_verification_modal').modal('show');
    //     });
    // });
 $(document).ready(function(){
  function repositionExtraData(){
    if ($(window).width() <= 768) {
      if (!$('.quick-data').find('.extra-data').length) {
        $('.graph-card-wrapper .extra-data').appendTo('.quick-data');
      }
    } else {
      if ($('.quick-data').find('.extra-data').length) {
        $('.quick-data .extra-data').appendTo('.graph-card-wrapper');
      }
    }
  }
  repositionExtraData();
  $(window).resize(repositionExtraData);
});
</script>

@endsection
