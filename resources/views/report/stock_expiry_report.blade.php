@extends('layouts.app')
@section('title', __('report.stock_expiry_report'))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.stock-product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('report.stock_expiry_report')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                <button type="button" class="filter-modal-btn btn-modal" data-href="{{action('ReportController@filter', 'status=expiry')}}" data-container=".report_filter_modal" >
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </button>
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="max-table" id="stock_expiry_report_table">
                            <thead>
                                <tr>
                                    <th>@lang('business.product')</th>
                                    <th>@lang('product.sku')</th>
                                    <!-- <th>@lang('purchase.ref_no')</th> -->
                                    <th>@lang('business.location')</th>
                                    <th>@lang('report.stock_left')</th>
                                    <th>@lang('lang_v1.lot_number')</th>
                                    <th>@lang('product.exp_date')</th>
                                    <th>@lang('product.mfg_date')</th>
                                   <!--  <th>@lang('messages.edit')</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                                    <td id="footer_total_stock_left"></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade report_filter_modal" tabindex="-1" role="dialog" 
                aria-labelledby="gridSystemModalLabel">
            </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection