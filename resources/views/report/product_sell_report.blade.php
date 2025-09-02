@extends('layouts.app')
@section('title', __('lang_v1.product_sell_report'))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.sale-purchase', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('lang_v1.product_sell_report')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                <div class="form-box">
                    <select name="" class="form-control" id="detailBy">
                        <option value="psr_grouped_tab">@lang('lang_v1.grouped')</option>
                        <option value="psr_detailed_tab">@lang('lang_v1.detailed')</option>
                        <option value="psr_detailed_with_purchase_tab">@lang('lang_v1.detailed_with_purchase')</option>
                        <option value="psr_by_cat_tab">@lang('lang_v1.by_category')</option>
                        <option value="psr_by_brand_tab">@lang('lang_v1.by_brand')</option>
                    </select>
                </div>
                </div>
                 <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->

        @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_sell_report_form' ]) !!}
                <div class="col-md-3">
                    <div class="form-group">
                    {!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
                    <input type="hidden" value="" id="variation_id">
                            {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('customer_id', __('contact.customer') . ':') !!}
                        {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('psr_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':') !!}
                        {!! Form::select('psr_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_customer_group_id']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('category_id', __('product.category') . ':') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_filter_category_id', 'placeholder' => __('lang_v1.all'), 'style' => 'width:100%']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('brand_id', __('product.brand') . ':') !!}
                        {!! Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('product_sr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_sr_date_filter', 'readonly']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('product_sr_start_time', __('lang_v1.time_range') . ':') !!}
                    @php
                        $startDay = Carbon\Carbon::now()->startOfDay();
                        $endDay   = $startDay->copy()->endOfDay();
                    @endphp
                    <div class="form-group">
                        {!! Form::text('start_time', @format_time($startDay), ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control width-50 f-left', 'id' => 'product_sr_start_time']); !!}
                        {!! Form::text('end_time', @format_time($endDay), ['class' => 'form-control width-50 f-left', 'id' => 'product_sr_end_time']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent

        <div class="content" style="margin-top: 5px;">
            <div id="psr_detailed_tab" style="display: none;">

                <table class="max-table display nowrap" style="width: 100%;" 
                    id="product_sell_report_table">
                        <thead>
                            <tr>
                                <th>@lang('sale.product')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('sale.customer_name')</th>
                                <th>@lang('lang_v1.contact_id')</th>
                                <th>@lang('sale.invoice_no')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('sale.qty')</th>
                                <th>@lang('sale.unit_price')</th>
                                <th>@lang('sale.discount')</th>
                                <th>@lang('sale.tax')</th>
                                <th>@lang('sale.price_inc_tax')</th>
                                <th>@lang('sale.total')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray footer-total text-center">
                                <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                                <td class="footer_total_sold"></td>
                                <td></td>
                                <td></td>
                                <td class="footer_tax"></td>
                                <td></td>
                                <td class="footer_subtotal"></td>
                            </tr>
                        </tfoot>
                    </table>
            </div>

            <div id="psr_detailed_with_purchase_tab" style="display: none;">
                 @if(session('business.enable_lot_number'))
                    <input type="hidden" id="lot_enabled">
                @endif
                <table class="max-table display nowrap" 
                id="product_sell_report_with_purchase_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>@lang('sale.product')</th>
                            <th>@lang('product.sku')</th>
                            <th>@lang('sale.customer_name')</th>
                            <th>@lang('sale.invoice_no')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('lang_v1.purchase_ref_no')</th>
                            <th>@lang('lang_v1.lot_number')</th>
                            <th>@lang('lang_v1.supplier_name')</th>
                            <th>@lang('sale.qty')</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="psr_grouped_tab">
                <table class="max-table display nowrap" id="product_sell_grouped_report_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>@lang('sale.product')</th>
                            <th>@lang('product.sku')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('report.current_stock')</th>
                            <th>@lang('report.total_unit_sold')</th>
                            <th>@lang('sale.total')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                            <td class="footer_total_grouped_sold"></td>
                            <td class="footer_grouped_subtotal"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div id="psr_by_cat_tab" style="display: none;">
                @include('report.partials.product_sell_report_by_category')
            </div>
  
            <div id="psr_by_brand_tab" style="display: none;">
                @include('report.partials.product_sell_report_by_brand')
            </div>
        </div>

        
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(
        '#product_sell_report_form #location_id, #product_sell_report_form #customer_id, #psr_filter_brand_id, #psr_filter_category_id, #psr_customer_group_id'
    ).change(function() {
        $('.nav-tabs li.active').find('a[data-toggle="tab"]').trigger('shown.bs.tab');
    });
        $(document).ready( function() {
         $('#product_sr_start_time, #product_sr_end_time').datetimepicker({
            format: moment_time_format,
            ignoreReadonly: true
            }).on('dp.change', function () {

            if (typeof product_sell_report_by_category_datatable !== 'undefined') {
                product_sell_report_by_category_datatable.ajax.reload();
            }
            if (typeof product_sell_report_by_brand_datatable !== 'undefined') {
                product_sell_report_by_brand_datatable.ajax.reload();
            }

            });
            $('#detailBy').on('change', function() {
                var target = $(this).find(":selected").val();
                if ( target == 'psr_grouped_tab') {
                    $('#psr_detailed_tab').hide();
                 $('#psr_detailed_with_purchase_tab').hide();
                 $('#psr_grouped_tab').show();
                 $('#psr_by_cat_tab').hide();
                 $('#psr_by_brand_tab').hide();
                 
            } else if (target == 'psr_detailed_tab') {
               $('#psr_detailed_tab').show();
                 $('#psr_detailed_with_purchase_tab').hide();
                 $('#psr_grouped_tab').hide();
                 $('#psr_by_cat_tab').hide();
                 $('#psr_by_brand_tab').hide();
                 
                 product_sell_report.ajax.reload();
            } else if (target == 'psr_detailed_with_purchase_tab') {
               $('#psr_detailed_tab').hide();
                 $('#psr_detailed_with_purchase_tab').show();
                 $('#psr_grouped_tab').hide();
                 $('#psr_by_cat_tab').hide();
                 $('#psr_by_brand_tab').hide();
                 if(typeof product_sell_report_with_purchase_table == 'undefined') {
                        
                        } else {
                            product_sell_report_with_purchase_table.ajax.reload();
                        }
            } else if (target == 'psr_by_cat_tab') {
                $('#psr_detailed_tab').hide();
                 $('#psr_detailed_with_purchase_tab').hide();
                 $('#psr_grouped_tab').hide();
                 $('#psr_by_cat_tab').show();
                 $('#psr_by_brand_tab').hide();
                if(typeof product_sell_report_by_category_datatable == 'undefined') {
                        product_sell_report_by_category_datatable = $('table#product_sell_report_by_category').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: {
                                    url: '/reports/product-sell-grouped-by',
                                    data: function(d) {
                                        var start = '';
                                        var end = '';
                                        var start_time = $('#product_sr_start_time').val();
                                        var end_time = $('#product_sr_end_time').val();
                                        if ($('#product_sr_date_filter').val()) {
                                            start = $('input#product_sr_date_filter')
                                                .data('daterangepicker')
                                                .startDate.format('YYYY-MM-DD');
                                            end = $('input#product_sr_date_filter')
                                                .data('daterangepicker')
                                                .endDate.format('YYYY-MM-DD');

                                            start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                            end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                        }
                                        d.start_date = start;
                                        d.end_date = end;
                                        d.group_by = 'category';
                                        d.category_id = $('select#psr_filter_category_id').val();
                                        d.brand_id = $('select#psr_filter_brand_id').val();
                                        d.customer_id = $('select#customer_id').val();
                                        d.location_id = $('select#location_id').val();
                                        d.customer_group_id = $('#psr_customer_group_id').val();
                                    },
                                },
                                columns: [
                                    { data: 'category_name', name: 'cat.name' },
                                    { data: 'current_stock', name: 'current_stock', searchable: false, orderable: false },
                                    { data: 'total_qty_sold', name: 'total_qty_sold', searchable: false },
                                    { data: 'subtotal', name: 'subtotal', searchable: false },
                                ],
                                fnDrawCallback: function(oSettings) {
                                    $('.footer_psr_by_cat_total_sell').text(
                                        __currency_trans_from_en(sum_table_col($('#product_sell_report_by_category'), 'row_subtotal'))
                                    );
                                    $('.footer_psr_by_cat_total_sold').html(
                                        __sum_stock($('#product_sell_report_by_category'), 'sell_qty')
                                    );

                                    $('.footer_psr_by_cat_total_stock').html(
                                        __sum_stock($('#product_sell_report_by_category'), 'current_stock')
                                    );
                                    __currency_convert_recursively($('#product_sell_report_by_category'));
                                },
                            });
                            $('#product_sr_date_filter, #product_sr_end_time, #product_sr_start_time, #psr_customer_group_id, #psr_filter_category_id, #psr_filter_brand_id, #product_sell_report_form #variation_id, #product_sell_report_form #location_id, #product_sell_report_form #customer_id'
                                ).change(function() {
                                product_sell_report_by_category_datatable.ajax.reload();
                                });
             } else {
                 product_sell_report_by_category_datatable.ajax.reload();
                        }
            } else if (target == 'psr_by_brand_tab') {
                $('#psr_detailed_tab').hide();
                 $('#psr_detailed_with_purchase_tab').hide();
                 $('#psr_grouped_tab').hide();
                 $('#psr_by_cat_tab').hide();
                 $('#psr_by_brand_tab').show();
                if(typeof product_sell_report_by_brand_datatable == 'undefined') {
                        product_sell_report_by_brand_datatable = $('table#product_sell_report_by_brand').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: {
                                    url: '/reports/product-sell-grouped-by',
                                    data: function(d) {
                                        var start = '';
                                        var end = '';
                                        var start_time = $('#product_sr_start_time').val();
                                        var end_time = $('#product_sr_end_time').val();
                                        if ($('#product_sr_date_filter').val()) {
                                            start = $('input#product_sr_date_filter')
                                                .data('daterangepicker')
                                                .startDate.format('YYYY-MM-DD');
                                            end = $('input#product_sr_date_filter')
                                                .data('daterangepicker')
                                                .endDate.format('YYYY-MM-DD');

                                            start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                            end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                        }
                                        d.start_date = start;
                                        d.end_date = end;
                                        d.group_by = 'brand';
                                        d.category_id = $('select#psr_filter_category_id').val();
                                        d.brand_id = $('select#psr_filter_brand_id').val();
                                        d.customer_id = $('select#customer_id').val();
                                        d.location_id = $('select#location_id').val();
                                        d.customer_group_id = $('#psr_customer_group_id').val();
                                    },
                                },
                                columns: [
                                    { data: 'brand_name', name: 'b.name' },
                                    { data: 'current_stock', name: 'current_stock', searchable: false, orderable: false },
                                    { data: 'total_qty_sold', name: 'total_qty_sold', searchable: false },
                                    { data: 'subtotal', name: 'subtotal', searchable: false },
                                ],
                                fnDrawCallback: function(oSettings) {
                                    $('.footer_psr_by_brand_total_sell').text(
                                        __currency_trans_from_en(sum_table_col($('#product_sell_report_by_brand'), 'row_subtotal'))
                                    );
                                    $('.footer_psr_by_brand_total_sold').html(
                                        __sum_stock($('#product_sell_report_by_brand'), 'sell_qty')
                                    );

                                    $('.footer_psr_by_cat_total_stock').html(
                                        __sum_stock($('#product_sell_report_by_brand'), 'current_stock')
                                    );
                                    __currency_convert_recursively($('#product_sell_report_by_brand'));
                                },
                            });
                            $('#product_sr_date_filter, #product_sr_end_time, #product_sr_start_time, #psr_customer_group_id, #psr_filter_category_id, #psr_filter_brand_id, #product_sell_report_form #variation_id, #product_sell_report_form #location_id, #product_sell_report_form #customer_id'
                            ).change(function() {
                                product_sell_report_by_brand_datatable.ajax.reload();
                            });
                        } else {
                            product_sell_report_by_brand_datatable.ajax.reload();
                        }
            }
            });
            
            });
    </script>
@endsection