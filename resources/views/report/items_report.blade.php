@extends('layouts.app')
@section('title', __('lang_v1.items_report'))

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
                <h1>{{ __('lang_v1.items_report')}}</h1>
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
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ir_supplier_id', __('purchase.supplier') . ':') !!}
                    {!! Form::select('ir_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ir_purchase_date_filter', __('purchase.purchase_date') . ':') !!}
                    {!! Form::text('ir_purchase_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ir_customer_id', __('contact.customer') . ':') !!}
                    {!! Form::select('ir_customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ir_sale_date_filter', __('lang_v1.sell_date') . ':') !!}
                    {!! Form::text('ir_sale_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ir_location_id', __('purchase.business_location').':') !!}
                    {!! Form::select('ir_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            @if(Module::has('Manufacturing'))
            <div class="col-sm-4">
                <div class="form-group">
                    <p>@lang('manufacturing::lang.only_mfg_products')</p>
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <label class="switch" for="only_mfg_products">
                            {!! Form::checkbox('only_mfg', 1, false, ['id' => 'only_mfg_products', 'style' => 'width: 100%']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>
            
            @endif
            @endcomponent
        
        <div class="content">
            <table class="max-table" 
            id="items_report_table">
                <thead>
                    <tr>
                        <th>@lang('sale.product')</th>
                        <th>@lang('product.sku')</th>
                        <th>@lang('lang_v1.description')</th>
                        <th>@lang('purchase.purchase_date')</th>
                        <th>@lang('lang_v1.purchase')</th>
                        <th>@lang('purchase.supplier')</th>
                        <th>@lang('lang_v1.purchase_price')</th>
                        <th>@lang('lang_v1.sell_date')</th>
                        <th>@lang('business.sale')</th>
                        <th>@lang('contact.customer')</th>
                        <th>@lang('sale.location')</th>
                        <th>@lang('lang_v1.sell_quantity')</th>
                        <th>@lang('lang_v1.selling_price')</th>
                        <th>@lang('sale.subtotal')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                        <td class="footer_total_pp"></td>
                        <td colspan="4"></td>
                        <td class="footer_total_qty"></td>
                        <td class="footer_total_sp"></td>
                        <td class="footer_total_subtotal"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection