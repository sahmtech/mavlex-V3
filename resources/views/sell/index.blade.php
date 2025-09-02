@extends('layouts.app')
@section('title', __( 'lang_v1.all_sales'))

@section('content')

<div class="main-container no-print">         
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.invoice', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v2.all_invoices')</h1>
            </div>
            <div class="filter">
                <div class="new-user">
                    @can('direct_sell.access')
                        <a class="add-user-modal-btn" href="{{action('SellController@create')}}"> <i class="fa fa-plus"></i> @lang( 'lang_v2.create_invoice' )</a>
                    @endcan
                </div>

                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>

        </div>
        <!-- End of Filter through table -->

        @component('components.filters', ['title' => __('report.filters')])
            @include('sell.partials.sell_list_filters')
            @if(!empty($sources))
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('sell_list_filter_source',  __('lang_v1.sources') . ':') !!}

                        {!! Form::select('sell_list_filter_source', $sources, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
                    </div>
                </div>
            @endif
        @endcomponent

            <div class="content">
                 
                @if(auth()->user()->can('direct_sell.view') ||  auth()->user()->can('view_own_sell_only') ||  auth()->user()->can('view_commission_agent_sell'))
                @php
                    $custom_labels = json_decode(session('business.custom_labels'), true);
                 @endphp
                    <div class="table-responsive">
                        <table class="table max-table" id="sell_table">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>@lang('sale.invoice_no')</th>
                                    <th>@lang('messages.date')</th>
                                    <th>@lang('sale.customer_name')</th>
                                    <th>@lang('sale.total_amount')</th>
                                    <th>@lang('sale.total_paid')</th>
                                    <th>@lang('lang_v1.sell_due')</th>
                                    <th>@lang('sale.payment_status')</th>
                                    {{--Zatca Code--}}
                                    @moduleEnabled('Zatca')
                                    <th>@lang('zatca::lang.sent_to_zatca')</th>
                                    @endmoduleEnabled
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="1"><strong>@lang('sale.total'):</strong></td>
                                    <td colspan="3"></td>
                                    {{--<td class="payment_method_count"></td>--}}
                                    <td class="footer_sale_total"></td>
                                    <td class="footer_total_paid"></td>
                                    <td class="footer_total_remaining"></td>
                                    {{--<td class="service_type_count"></td>--}}
                                    <td class="footer_payment_status_count"></td>
                                    @moduleEnabled('Zatca')
                                    <td colspan="1"></td>
                                    @endmoduleEnabled
                                    {{--<td colspan="1"></td>--}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div id="no-invoice" class="invoice-empty-wrapper" style="display: none;">
                        <img
                            src="{{ asset('img/icons/invoice-illustration.svg') }}"
                            alt=""
                            width="500px"
                            class="invoice-illustration-img" />
                        <h3>@lang('lang_v1.get_paid_faster_invoice_text')</h3>
                        <p>
                        @lang('lang_v1.invoice_help_text')
                        </p>
                        <a href="{{action('SellController@create')}}" class="primary-button">
                            <i class="fa fa-plus"></i>
                            @lang( 'lang_v2.create_invoice' )
                        </a>
                    </div>
                @endif
            </div>

            
    </div>

    <div class="modal fade payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</div>


<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->

@stop

@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });

    var sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: false,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": "/sells",
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.is_direct_sale = 1;
                d.is_invoice =1;

                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
                d.created_by = $('#created_by').val();
                d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                d.service_staffs = $('#service_staffs').val();

                if($('#shipping_status').length) {
                    d.shipping_status = $('#shipping_status').val();
                }

                if($('#sell_list_filter_source').length) {
                    d.source = $('#sell_list_filter_source').val();
                }

                if($('#only_subscriptions').is(':checked')) {
                    d.only_subscriptions = 1;
                }

                d = __datatable_ajax_callback(d);
            }
        },
        scrollY:        false,
        scrollCollapse: false,
        columns: [
            { data: 'action', name: 'action', orderable: false, "searchable": false},
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'conatct_name', name: 'conatct_name'},
            { data: 'final_total', name: 'final_total'},
            { data: 'total_paid', name: 'total_paid', "searchable": false},
            { data: 'total_remaining', name: 'total_remaining'},
            { data: 'payment_status', name: 'payment_status'},
             /* Zatca Code */
             @moduleEnabled('Zatca')
                { data: 'sent_to_zatca', name: 'sent_to_zatca' },
            @endmoduleEnabled
        ],
        "fnDrawCallback": function () {
            if ($(this).find('.dataTables_empty').length == 1) {
                $('th').hide();
                $('#sell_table_info').hide();
                $('#sell_table_paginate').hide();
                $('.margin-bottom-20').hide();
                $('.dataTables_scrollFoot').hide();
                $('.dataTables_empty').hide();
                $('.dataTables_empty').css({ "border-top": "1px solid #111" });
                $('#no-invoice').show();

            } else {
                $('th').show();
                $('#sell_table_info').show();
                $('#sell_table_paginate').show();
                $('.margin-bottom-20').show();
                $('.dataTables_scrollFoot').show();
                $('.dataTables_empty').show();
                $('#no-invoice').hide();

                __currency_convert_recursively($('#sell_table'));
            }
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_sell_return_due = 0;
            for (var r in data){
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_sell_return_due += $(data[r].return_due).find('.sell_return_due').data('orig-value') ? parseFloat($(data[r].return_due).find('.sell_return_due').data('orig-value')) : 0;
            }

            $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
            $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));

            $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
            $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
            $('.payment_method_count').html(__count_status(data, 'payment_methods'));
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
    });

    

    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status, #sell_list_filter_source',  function() {
        sell_table.ajax.reload();
    });

    $('#only_subscriptions').on('ifChanged', function(event){
        sell_table.ajax.reload();
    });

});
</script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection