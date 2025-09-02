@extends('layouts.app')
@section('title', __('lang_v1.lot_report'))

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
                <h1>{{ __('lang_v1.lot_report')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
             
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    @component('components.filters', ['title' => __('report.filters')])
                      {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('category_id', __('category.category') . ':') !!}
                                {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                                {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('brand', __('product.brand') . ':') !!}
                                {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('unit',__('product.unit') . ':') !!}
                                {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        @if(Module::has('Manufacturing'))
                        <div class="col-sm-3">
                            <div class="form-group">
                                <p>{{ __('manufacturing::lang.only_mfg_products') }}</p>
                                <div class="toggle-wrapper d-flex gap-2 mt-4">
                                    <label class="switch" for="only_mfg_products">
                                        {!! Form::checkbox('only_mfg', 1, false, ['id' => 'only_mfg_products']) !!}
                                        <div class="sliderCheckbox round"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        @endif
                        {!! Form::close() !!}
                    @endcomponent
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @component('components.widget', ['class' => 'box-primary'])
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="lot_report">
                            <thead>
                                <tr>
                                    <th>@lang('product.sku')</th>
                                    <th>@lang('business.product')</th>
                                    <th>@lang('lang_v1.lot_number')</th>
                                    <th>@lang('product.exp_date')</th>
                                    <th>@lang('report.current_stock')</th>
                                    <th>@lang('report.total_unit_sold')</th>
                                    <th>@lang('lang_v1.total_unit_adjusted')</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                                    <td id="footer_total_stock"></td>
                                    <td id="footer_total_sold"></td>
                                    <td id="footer_total_adjusted"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection