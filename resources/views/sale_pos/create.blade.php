@extends('layouts.app')

@section('title', __('sale.pos_sale'))
@section('css')
<style type="text/css">
   

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 0px !important;
    }

    label {
        margin-bottom: 0 !important;
    }

    @media screen {
        #printSection {
            display: none;
        }
    }

    @media print {

        #printSection,
        #printSection * {
            visibility: visible;
        }

        #printSection {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    @media (max-width: 992px) {
        #hide_suggestion_btn {
            display: none;
        }
    }

</style>

@endsection
@section('content')
<section class="content no-print">
    <input type="hidden" id="amount_rounding_method" value="{{ $pos_settings['amount_rounding_method'] ?? '' }}">
    @if (!empty($pos_settings['allow_overselling']))
    <input type="hidden" id="is_overselling_allowed">
    @endif
    @if (session('business.enable_rp') == 1)
    <input type="hidden" id="reward_point_enabled">
    @endif
    @php
    $is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
    $is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
    @endphp
    <div class="pos-table  no-print">
        <div class="row mb-12">
            <div class="col-md-12">
                <div class="row">
                    <div class="@if(empty($pos_settings['hide_product_suggestion'])) col-md-7 @else col-md-10 col-md-offset-1 @endif no-padding pr-12" id="cart">
                        <div class="box box-solid mb-12 @if(!isMobile()) mb-40 @endif">
                            <div class="box-body pb-0">
                                {!! Form::open(['url' => action('SellPosController@store'), 'method' => 'post', 'id' => 'add_pos_sell_form']) !!}
                                {!! Form::hidden('location_id', $default_location->id ?? null, [
                                'id' => 'location_id',
                                'data-receipt_printer_type' => !empty($default_location->receipt_printer_type)
                                ? $default_location->receipt_printer_type
                                : 'browser',
                                'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
                                ]) !!}
                                <!-- sub_type -->
                                {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                                <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">

                                @include('sale_pos.partials.pos_form')

                                @include('sale_pos.partials.payment_modal')
                                @if (empty($pos_settings['disable_suspend']))
                                @include('sale_pos.partials.suspend_note_modal')
                                @endif
                                @if (!empty($restaurant_settings['enable_kot']))
                                @include('sale_pos.partials.place_order_modal')
                                @endif
                                @if (empty($pos_settings['disable_recurring_invoice']))
                                @include('sale_pos.partials.recurring_invoice_modal')
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                    <button type="button"
                        class="btn btn-default btn-sm"
                        id="hide_suggestion_btn">
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                     @endif
                    <!-- Refresh Cache Button - Only show when instant POS is enabled -->
                    @if(isset($business_details->enable_instant_pos) && $business_details->enable_instant_pos && $app_settings->enable_instant_pos && !isMobile())
                    <button type="button"
                        class="btn btn-default btn-sm"
                        id="refresh_pos_cache_btn"
                        onclick="refreshPOSCache()" 
                        title="@lang('settings.refresh_pos_cache')"
                        style="display: none; position: absolute; top: -22px; right: 25px; transform: translateX(-50%); z-index: 10; background: var(--primary-color); color: #fff;">
                       <i class="fas fa-sync"></i>
                    </button>
                    @endif
                   
                   
                    @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                    <div class="col-md-5 no-padding" id="pos_sidebar">
                        @include('sale_pos.partials.pos_sidebar')
                    </div>
                    @endif
                    @include('sale_pos.partials.pos_form_actions')
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</section>
<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
@if (empty($pos_settings['hide_product_suggestion']) && isMobile())
@include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.mobile_products_modal')

@include('sale_pos.partials.weighing_scale_modal')

@endsection
@section('css')
<!-- include module css -->
@if (!empty($pos_module_data))
@foreach ($pos_module_data as $key => $value)
@if (!empty($value['module_css_path']))
@includeIf($value['module_css_path'])
@endif
@endforeach
@endif
@stop
@section('javascript')
<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/pos_extra.js?v=' . $asset_v) }}"></script>
{{-- POS App Settings --}}
<script>
window.POS_APP_SETTINGS = {};
function getInstantPOSEnabled() {
    // Check all three conditions: app setting, business setting, and localStorage
    const appEnabled = {{ $app_settings->enable_instant_pos ? 'true' : 'false' }};
    const businessEnabled = {{ isset($business_details->enable_instant_pos) && $business_details->enable_instant_pos ? 'true' : 'false' }};
    const localSetting = localStorage.getItem('enable_instant_pos');
    
    // All three must be true to enable instant POS
    if (!appEnabled || !businessEnabled) {
        return false;
    }
    
    // If localStorage is null, default to false (user hasn't opted in)
    if (localSetting === null) {
        return false;
    }
    
    return localSetting === 'true';
}

const instantPOSEnabled = getInstantPOSEnabled();

if (instantPOSEnabled) {
    Object.assign(window.POS_APP_SETTINGS, {
        enable_instant_pos: true,
        enable_instant_search: {{ $app_settings->enable_instant_search ? 'true' : 'false' }},
        pos_cache_refresh_interval: '{{ $app_settings->pos_cache_refresh_interval }}',
        pos_max_cached_products: {{ $app_settings->pos_max_cached_products }},
        messages: @js([
            'loading_products' => __('settings.loading_products'),
            'please_wait_while_products_load' => __('settings.please_wait_while_products_load'),
            'loading_products_placeholder' => __('settings.loading_products_placeholder'),
            'updating_stock' => __('settings.updating_stock'),
            'failed_to_load_cache' => __('settings.failed_to_load_cache')
        ])
    });
}

localStorage.setItem('enable_instant_pos', instantPOSEnabled.toString());
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('instant_pos_btn');
    const icon = document.getElementById('instant_pos_icon');
    if (button && icon) {
        updateButtonState(getInstantPOSEnabled());
    }
});

function updateButtonState(isEnabled) {
    const button = document.getElementById('instant_pos_btn');
    const icon = document.getElementById('instant_pos_icon');
    const path = document.getElementById('instant_pos_path');
    const refreshBtn = document.getElementById('refresh_pos_cache_btn');
    
    if (button && icon && path) {
        if (isEnabled) {
            button.classList.add('active');
            button.style.backgroundColor = 'var(--primary-color)';
            button.style.borderRadius = '4px';
            // Fill the SVG with the active color and white border
            path.setAttribute('fill', '#FFB636');
            path.setAttribute('stroke', '#fff');
            // Change tooltip to "Disable Instant POS"
            button.setAttribute('title', '@lang("settings.disable_instant_pos")');
            button.setAttribute('data-original-title', '@lang("settings.disable_instant_pos")');
            if (refreshBtn) {
                refreshBtn.style.display = 'inline-block';
            }
        } else {
            button.classList.remove('active');
            button.style.backgroundColor = 'transparent';
            button.style.borderRadius = '';
            // Empty fill, just stroke outline
            path.setAttribute('fill', 'none');
            path.setAttribute('stroke', '#666');
            // Change tooltip to "Enable Instant POS"
            button.setAttribute('title', '@lang("settings.enable_instant_pos")');
            button.setAttribute('data-original-title', '@lang("settings.enable_instant_pos")');
            if (refreshBtn) {
                refreshBtn.style.display = 'none';
            }
        }
        
        // If Bootstrap tooltip is initialized, update it
        if (typeof $(button).tooltip === 'function') {
            $(button).tooltip('dispose').tooltip({
                title: button.getAttribute('title'),
                placement: 'bottom'
            });
        }
    }
}

function toggleInstantPOS() {
    const currentState = getInstantPOSEnabled();
    const isEnabled = !currentState;
    localStorage.setItem('enable_instant_pos', isEnabled.toString());
    updateButtonState(isEnabled);
    
    window.POS_APP_SETTINGS = window.POS_APP_SETTINGS || {};
    
    if (isEnabled) {
        Object.assign(window.POS_APP_SETTINGS, {
            enable_instant_pos: true,
            enable_instant_search: {{ $app_settings->enable_instant_search ? 'true' : 'false' }},
            pos_cache_refresh_interval: '{{ $app_settings->pos_cache_refresh_interval }}',
            pos_max_cached_products: {{ $app_settings->pos_max_cached_products }},
            messages: @js([
                'loading_products' => __('settings.loading_products'),
                'please_wait_while_products_load' => __('settings.please_wait_while_products_load'),
                'loading_products_placeholder' => __('settings.loading_products_placeholder'),
                'updating_stock' => __('settings.updating_stock'),
                'failed_to_load_cache' => __('settings.failed_to_load_cache')
            ])
        });
        if (!window.posRealtimeLoaded) {
            const script = document.createElement('script');
            script.src = "{{ asset('js/pos_realtime.js?v=' . $asset_v) }}";
            script.onload = function() {
                window.posRealtimeLoaded = true;
                if (typeof initializePOSRealtime === 'function') {
                    initializePOSRealtime();
                }
            };
            document.head.appendChild(script);
        } else {
            if (typeof initializePOSRealtime === 'function') {
                initializePOSRealtime();
            }
        }
    } else {
        window.POS_APP_SETTINGS.enable_instant_pos = false;
        if (typeof cleanupPOSRealtime === 'function') {
            cleanupPOSRealtime();
        }
    }
    
    toastr.info(isEnabled ? '@lang("settings.instant_pos_enabled")' : '@lang("settings.instant_pos_disabled")');
    
    // Refresh the page to fully apply changes
    // setTimeout(() => {
    //     location.reload();
    // }, 1000);
}
</script>

@if(($business_details->enable_instant_pos ?? false) && $app_settings->enable_instant_pos)
<script>
if (getInstantPOSEnabled()) {
    const script = document.createElement('script');
    script.src = "{{ asset('js/pos_realtime.js?v=' . $asset_v) }}";
    document.head.appendChild(script);
}
</script>
@endif
<script src="{{ asset('js/calculator.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
<script>

window.POS_TRANSLATIONS = @js([
    'pos_edit_product_price_help' => __('lang_v1.pos_edit_product_price_help'),
    'in_stock' => __('lang_v1.in_stock'),
    'item_out_of_stock' => __('lang_v1.item_out_of_stock'),
    'decimal_value_not_allowed' => __('lang_v1.decimal_value_not_allowed'),
    'this_field_is_required' => __('validation.custom-messages.this_field_is_required'),
    'quantity_not_available' => __('validation.custom-messages.quantity_not_available'),
    'quantity_error_msg_in_lot' => __('lang_v1.quantity_error_msg_in_lot'),
    'lot_n_expiry' => __('lang_v1.lot_n_expiry'),
    'exp_date' => __('product.exp_date'),
    'expired' => __('report.expired'),
    'sell_line_description_help' => __('lang_v1.sell_line_description_help'),
    'select_service_staff' => __('restaurant.select_service_staff'),
    'prev_unit_price' => __('lang_v1.prev_unit_price'),
    'prev_discount' => __('lang_v1.prev_discount'),
    'fixed' => __('lang_v1.fixed'),
    'percentage' => __('lang_v1.percentage'),
    'applied_discount_text' => __('lang_v1.applied_discount_text'),
    'please_select' => __('messages.please_select'),
    'quantity_in_second_unit' => __('lang_v1.quantity_in_second_unit'),
    'minimum_selling_price_error_msg' => __('lang_v1.minimum_selling_price_error_msg'),
    'unit_price' => __('sale.unit_price'),
    'discount_type' => __('sale.discount_type'),
    'discount_amount' => __('sale.discount_amount'),
    'tax' => __('sale.tax'),
    'warranty' => __('lang_v1.warranty'),
    'description' => __('lang_v1.description'),
    'close' => __('messages.close'),
    'no_products_found' => __('lang_v1.no_products_found'),
    'out_of_stock' => __('lang_v1.out_of_stock'),
]);
</script>
@include('sale_pos.partials.keyboard_shortcuts')

<!-- Call restaurant module if defined -->
@if (in_array('tables', $enabled_modules) ||
in_array('modifiers', $enabled_modules) ||
in_array('service_staff', $enabled_modules))
<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif
<!-- include module js -->
@if (!empty($pos_module_data))
@foreach ($pos_module_data as $key => $value)
@if (!empty($value['module_js_path']))
@includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
@endif
@endforeach
@endif
@endsection