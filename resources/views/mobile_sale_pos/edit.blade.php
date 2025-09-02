@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')

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


<div class="pos-table no-print">
{!! Form::open(['url' => action('SellPosController@update', [$transaction->id]), 'method' => 'post', 'id' => 'edit_pos_sell_form' ]) !!}
{{ method_field('PUT') }}
{!! Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser', 'data-default_payment_accounts' => $transaction->location->default_payment_accounts]); !!}
    {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
    <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">


    <!-- Step 1: Select Customer Details -->
    <div id="step1" class="step active">
        @include('mobile_sale_pos.partials.edit_customer_selection')
    </div>

    <!-- Step 2: Select Products -->
    <div id="step2" class="step">
        @include('mobile_sale_pos.partials.edit_product_selection')
    </div>
    <!-- Step 3: Payment Page and Print -->
    <div id="step3" class="step">
        @include('mobile_sale_pos.partials.payment_page' , ['edit' => true])
    </div>
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
    {!! Form::close() !!}
</div>
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

<!-- Include modals for product selection, etc. -->
@include('sale_pos.partials.mobile_products_modal')

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.mobile_products_modal')

@include('sale_pos.partials.weighing_scale_modal')



@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mobile_pos.css?v=' . $asset_v) }}">
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

<script src="{{ asset('js/calculator.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Navigation logic
        document.getElementById('nextToProducts').addEventListener('click', function() {
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
        });

        document.getElementById('nextToPayment').addEventListener('click', function() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step3').classList.add('active');
        });

        document.getElementById('backToCustomer').addEventListener('click', function() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');
        });

        document.getElementById('backToProducts').addEventListener('click', function() {
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step2').classList.add('active');
        });
    });
</script>

@endsection