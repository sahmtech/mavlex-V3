@extends('layouts.app')
@section('title', __( 'lang_v2.payments'))

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
                <h1>@lang('lang_v2.payments')</h1>
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
                    {!! Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':') !!}
            
                    {!! Form::select('sell_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':') !!}
                    {!! Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('sell_list_filter_date_range', __('report.date_range') . ':') !!}
                    {!! Form::text('sell_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                </div>
            </div>
            
        @endcomponent

            <div class="content">
                    <div class="table-responsive">
                        <table class="table ajax_view max-table" id="payment_table">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>@lang('sale.invoice_no')</th>
                                    <th>@lang('messages.date')</th>
                                    <th>@lang('sale.customer_name')</th>
                                    <th>@lang('sale.total_paid')</th>
                                    <th>@lang('lang_v1.payment_method')</th>
                                    <th>@lang('sale.payment_status')</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                                    <td class="footer_total_paid"></td>
                                    <td colspan="1"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                
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
            payment_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        payment_table.ajax.reload();
    });

    var payment_table = $('#payment_table').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: false,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": "/sells/payments",
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                

                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                

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
            { data: 'total_paid', name: 'total_paid', "searchable": false},
            { data: 'payment_methods', name: 'payment_methods'},
            { data: 'payment_status', name: 'payment_status'},
        ],
        "fnDrawCallback": function () {
            __currency_convert_recursively($('#payment_table'));
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var footer_total_paid = 0;
            for (var r in data){
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
            }

            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));

        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
    });

    

    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id',  function() {
        payment_table.ajax.reload();
    });


});
</script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection