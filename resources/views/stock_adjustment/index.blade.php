@extends('layouts.app')
@section('title', __('stock_adjustment.stock_adjustments'))

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
                <h1>@lang('stock_adjustment.stock_adjustments')</h1>
                <p>@lang( 'lang_v1.stock_manager' )</p>
            </div>

            <div class="filter">
               <div class="new-user">
                    <a class="btn btn-block btn-primary" href="{{action('StockAdjustmentController@create')}}">
                        <i class="fa fa-plus"></i> @lang('messages.add')
                    </a>
                </div>
            </div>
            
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('unit.view')
                    <div class="table-responsive">
                        <table class="table ajax_view max-table" id="stock_adjustment_table" style="width: 100%">
                            <thead>
                                <tr>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('business.location')</th>
                                <th>@lang('stock_adjustment.adjustment_type')</th>
                                <th>@lang('stock_adjustment.total_amount')</th>
                                <th>@lang('stock_adjustment.total_amount_recovered')</th>
                                <th>@lang('stock_adjustment.reason_for_stock_adjustment')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                            </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

        <div class="modal fade stock_adjustment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@stop
@section('javascript')
	<script src="{{ asset('js/stock_adjustment.js?v=' . $asset_v) }}"></script>
@endsection
@cannot('view_purchase_price')
    <style>
        .show_price_with_permission {
            display: none !important;
        }
    </style>
@endcannot