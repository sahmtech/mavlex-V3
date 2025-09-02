@extends('layouts.app')
@section('title', __( 'report.profit_loss' ))

@section('content')

<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.profit-loss', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'report.profit_loss' )</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
              <select class="form-control select2" id="profit_loss_location_filter" style="width: 90%">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                </div>
                
                    <a class="filter-modal-btn"  id="profit_loss_date_filter" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
               
            </div>
        </div>
        <!-- End of Filter through table -->

        <div id="pl_data_div">
        </div>

        <div class="overview-filter">
            <div class="form-box">
                <select name="" class="form-control" id="profitBy" style="max-width: 250px;">
                    <option value="profit_by_products">@lang('lang_v1.profit_by_products')</option>
                    <option value="#profit_by_service_staff">@lang('lang_v1.profit_by_service_staff')</a>
                    <option value="profit_by_categories">@lang('lang_v1.profit_by_categories')</option>
                    <option value="profit_by_brands">@lang('lang_v1.profit_by_brands')</option>
                    <option value="profit_by_locations">@lang('lang_v1.profit_by_locations')</option>
                    <option value="profit_by_invoice">@lang('lang_v1.profit_by_invoice')</option>
                    <option value="profit_by_date">@lang('lang_v1.profit_by_date')</option>
                    <option value="profit_by_customer">@lang('lang_v1.profit_by_customer')</option>
                    <option value="profit_by_day">@lang('lang_v1.profit_by_day')</option>
                </select>
            </div>

            <div class="filter">
                
                <!-- Print button -->
                <button onclick="window.print();" class="report-print">
                    <img src="{{ asset('img/icons/printer.svg') }}" alt="">
                </button>
            </div>
        </div>

        <div class="content">
            <div id="profit_by_products">
                @include('report.partials.profit_by_products')
            </div>

            <div id="profit_by_categories" style="display: none;">
                @include('report.partials.profit_by_categories')
            </div>

            <div id="profit_by_brands" style="display: none;">
                @include('report.partials.profit_by_brands')
            </div>

            <div id="profit_by_locations" style="display: none;">
                @include('report.partials.profit_by_locations')
            </div>

            <div id="profit_by_invoice" style="display: none;">
                @include('report.partials.profit_by_invoice')
            </div>

            <div id="profit_by_date" style="display: none;">
                @include('report.partials.profit_by_date')
            </div>

            <div id="profit_by_customer" style="display: none;">
                @include('report.partials.profit_by_customer')
            </div>
            <div id="profit_by_service_staff" style="display: none;">
                @include('report.partials.profit_by_service_staff')
             </div>

            <div id="profit_by_day" style="display: none;">
                
            </div>
        </div>
    </div>

</div>

@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $(document).ready( function() {
        $('#profitBy').on('change', function() {
            var target = $(this).find(":selected").val();
            if ( target == 'profit_by_categories') {
                 $('#profit_by_products').hide();
                 $('#profit_by_categories').show();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                if(typeof profit_by_categories_datatable == 'undefined') {
                    profit_by_categories_datatable = $('#profit_by_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'category', name: 'C.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_categories_table'), 'gross-profit');
                            $('.categories_footer_total').html(__currency_trans_from_en(total_profit));

                            __currency_convert_recursively($('#profit_by_categories_table'));
                        },
                    });
                } else {
                    profit_by_categories_datatable.ajax.reload();
                }
            } else if (target == 'profit_by_brands') {
                $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').show();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                if(typeof profit_by_brands_datatable == 'undefined') {
                    profit_by_brands_datatable = $('#profit_by_brands_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/brand",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'brand', name: 'B.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_brands_table'), 'gross-profit');
                            $('.brands_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_brands_table'));
                        },
                    });
                } else {
                    profit_by_brands_datatable.ajax.reload();
                }
            } else if (target == 'profit_by_locations') {
                $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_locations').show();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                if(typeof profit_by_locations_datatable == 'undefined') {
                    profit_by_locations_datatable = $('#profit_by_locations_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/location",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'location', name: 'L.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_locations_table'), 'gross-profit');
                            $('.locations_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_locations_table'));
                        },
                    });
                } else {
                    profit_by_locations_datatable.ajax.reload();
                }
            } else if (target == 'profit_by_invoice') {
                $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').show();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                if(typeof profit_by_invoice_datatable == 'undefined') {
                    profit_by_invoice_datatable = $('#profit_by_invoice_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/invoice",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'invoice_no', name: 'sale.invoice_no'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_invoice_table'), 'gross-profit');
                            $('.invoice_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_invoice_table'));
                        },
                    });
                } else {
                    profit_by_invoice_datatable.ajax.reload();
                }
            } else if (target == 'profit_by_date') {
                 $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').show();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                if(typeof profit_by_date_datatable == 'undefined') {
                    profit_by_date_datatable = $('#profit_by_date_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/date",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'sale.transaction_date'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_date_table'), 'gross-profit');
                            $('.date_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_date_table'));
                        },
                    });
                } else {
                    profit_by_date_datatable.ajax.reload();
                }
            } else if (target == 'profit_by_customer') {
                $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').show();
                 $('#profit_by_day').hide();
                if(typeof profit_by_customers_table == 'undefined') {
                    profit_by_customers_table = $('#profit_by_customer_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/customer",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'customer', name: 'CU.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_profit = sum_table_col($('#profit_by_customer_table'), 'gross-profit');
                            $('.customer_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_customer_table'));
                        },
                    });
                } else {
                    profit_by_customers_table.ajax.reload();
                }
            }
                else if (target == '#profit_by_service_staff') {
                    $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').show();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                    if (typeof profit_by_service_staffs_table == 'undefined') {
                        
                        profit_by_service_staffs_table = $('#profit_by_service_staff_table').DataTable({
                            processing: true,
                            serverSide: true,
                            fixedHeader:false,
                            "ajax": {
                                "url": "/reports/get-profit/service_staff",
                                "data": function(d) {
                                    d.start_date = $('#profit_loss_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    d.end_date = $('#profit_loss_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');
                                    d.location_id = $('#profit_loss_location_filter').val();
                                }
                            },
                            columns: [{
                                    data: 'staff_name',
                                    name: 'U.first_name'
                                },
                                {
                                    data: 'gross_profit',
                                    "searchable": false
                                },
                            ],
                            footerCallback: function(row, data, start, end, display) {
                                var total_profit = 0;
                                for (var r in data) {
                                    total_profit += $(data[r].gross_profit).data('orig-value') ?
                                        parseFloat($(data[r].gross_profit).data('orig-value')) :
                                        0;
                                }

                                $('#profit_by_service_staff_table .footer_total').html(
                                    __currency_trans_from_en(total_profit));
                            },
                        });
                    } else {
                        profit_by_service_staffs_table.ajax.reload();
                    }
                
            } else if (target == 'profit_by_day') {
                $('#profit_by_products').hide();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').show();
                var start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');

                var end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                var location_id = $('#profit_loss_location_filter').val();

                var url = '/reports/get-profit/day?start_date=' + start_date + '&end_date=' + end_date + '&location_id=' + location_id;
                $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                           $('#profit_by_day').html(result); 
                            profit_by_days_table = $('#profit_by_day_table').DataTable({
                                    "searching": false,
                                    'paging': false,
                                    'ordering': false,
                            });
                            var total_profit = sum_table_col($('#profit_by_day_table'), 'gross-profit');
                           $('.day_footer_total').html(__currency_trans_from_en(total_profit));
                            __currency_convert_recursively($('#profit_by_day_table'));
                        },
                    });
            } else if (target == 'profit_by_products') {
                $('#profit_by_products').show();
                 $('#profit_by_categories').hide();
                 $('#profit_by_brands').hide();
                 $('#profit_by_locations').hide();
                 $('#profit_by_service_staff').hide();
                 $('#profit_by_invoice').hide();
                 $('#profit_by_date').hide();
                 $('#profit_by_customer').hide();
                 $('#profit_by_day').hide();
                profit_by_products_table.ajax.reload();
            }
        });
        profit_by_products_table = $('#profit_by_products_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/reports/get-profit/product",
                    "data": function ( d ) {
                        d.start_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                        d.location_id = $('#profit_loss_location_filter').val();
                    }
                },
                columns: [
                    { data: 'product', name: 'product'  },
                    { data: 'gross_profit', "searchable": false},
                ],
                fnDrawCallback: function(oSettings) {
                    var total_profit = sum_table_col($('#profit_by_products_table'), 'gross-profit');
                    $('.products_footer_total').html(__currency_trans_from_en(total_profit));
                    __currency_convert_recursively($('#profit_by_products_table'));
                },
            });

    });

</script>

@endsection
