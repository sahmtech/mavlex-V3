@extends('layouts.app')
@section('title', __('lang_v1.stock_transfers'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.stock-manager', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.stock_transfers')</h1>
                <p>@lang( 'lang_v1.stock_manager' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                <a class="btn btn-block btn-primary" href="{{action('StockTransferController@create')}}">
                    <i class="fa fa-plus"></i> @lang('messages.add')
                </a>
            </div>
            </div>

            
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                <div class="table-responsive">
                    <table class="table ajax_view max-table" id="stock_transfer_table" style="width: 100%">
                        <thead>
                            <tr>
                            <th>@lang('purchase.ref_no')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('lang_v1.location_from')</th>
                            <th>@lang('lang_v1.location_to')</th>
                            <th>@lang('sale.status')</th>
                            <th>@lang('lang_v1.shipping_charges')</th>
                            <th>@lang('stock_adjustment.total_amount')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        <div class="modal fade stock_transfer_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@include('stock_transfer.partials.update_status_modal')

<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
@stop
@section('javascript')
	<script src="{{ asset('js/stock_transfer.js?v=' . $asset_v) }}"></script>
@endsection
@cannot('view_purchase_price')
    <style>
        .show_price_with_permission {
            display: none !important;
        }
    </style>
@endcannot