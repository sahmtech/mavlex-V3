@extends('layouts.app')
@section('title', __('report.stock_report'))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.stock-product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
               <h1>{{ __('report.stock_report')}}</h1>
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
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('category_id', __('category.category') . ':') !!}
                        {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                        {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('brand', __('product.brand') . ':') !!}
                        {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('unit',__('product.unit') . ':') !!}
                        {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                @if($show_manufacturing_data)
                <div class="col-sm-4">
                    <div class="form-group">
                        <p>@lang('manufacturing::lang.only_mfg_products')</p>
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
        <div class="content">
            @can('view_product_stock_value')
            <div class="sales-report-stats">
                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>@lang('report.closing_stock') <span class="sub"> (@lang('lang_v1.by_purchase_price'))</span></h3>
                        <h1 id="closing_stock_by_pp"></h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>@lang('report.closing_stock') <span class="sub">(@lang('lang_v1.by_sale_price'))</span></h3>
                        <h1 id="closing_stock_by_sp"></h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>@lang('lang_v1.potential_profit')</h3>
                        <h1 id="potential_profit"> </h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>@lang('lang_v1.profit_margin')</h3>
                        <h1 id="profit_margin"></h1>
                    </div>
                </div>

            </div>
            @endcan

            @include('report.partials.stock_report_table')
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection