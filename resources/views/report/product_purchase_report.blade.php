@extends('layouts.app')
@section('title', __('lang_v1.product_purchase_report'))

@section('content')
<div class="main-container no-print">        
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.purchase', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                 <h1>{{ __('lang_v1.product_purchase_report')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
               <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->
         @component('components.filters', ['title' => __('report.filters')])
          {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_purchase_report_form' ]) !!}
            <div class="col-md-3">
                <div class="form-group">
                {!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
                    <input type="hidden" value="" id="variation_id">
                        {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('supplier_id', __('purchase.supplier') . ':') !!}
                    {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('location_id', __('purchase.business_location').':') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('product_pr_date_filter', __('report.date_range') . ':') !!}
                    {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_pr_date_filter', 'readonly']); !!}
                </div>
            </div>
            {!! Form::close() !!}
            @endcomponent
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="max-table" 
                        id="product_purchase_report_table">
                            <thead>
                                <tr>
                                    <th>@lang('sale.product')</th>
                                    <th>@lang('product.sku')</th>
                                    <th>@lang('purchase.supplier')</th>
                                    <th>@lang('purchase.ref_no')</th>
                                    <th>@lang('messages.date')</th>
                                    <th>@lang('sale.qty')</th>
                                    <th>@lang('lang_v1.total_unit_adjusted')</th>
                                    <th>@lang('lang_v1.unit_perchase_price')</th>
                                    <th>@lang('sale.subtotal')</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                    <td class="footer_total_purchase"></td>
                                    <td class="footer_total_adjusted"></td>
                                    <td></td>
                                    <td><span class="footer_subtotal"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection