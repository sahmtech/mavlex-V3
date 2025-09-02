@extends('layouts.app')

@section('title', __('zatca::lang.zatca_tax_report'))



@section('content')
<div class="main-container no-print">

    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        @include('zatca::layouts.nav')
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('zatca::lang.zatca_tax_report')</h1>
                <p>@lang('report.reports')</p>
            </div>

            <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                <img src="{{ asset('img/icons/filter.svg') }}" alt="">
               
            </a>
        </div>

        @component('components.filters', ['title' => __('report.filters')])
        @include('zatca::zatca_reports.partials.tax_report_filters')
        @endcomponent

        <div class="content">
            <div class="crm-data-wrapper">
                <div class="crm-data-item">
                    <h3 id="total_tax_label" style="white-space: nowrap;">@lang('zatca::lang.total_tax_collected')</h3>
                    <div class="data-numbers" id="total_tax_collected">
                        <span class="display_currency" data-currency_symbol="true">{{ $total_tax_collected }}</span>
                    </div>
                </div>
                <div class="crm-data-item">
                    <h3 style="white-space: nowrap;">@lang('zatca::lang.sent_invoices')</h3>
                    <div class="data-numbers" id="sentCount">{{ $sentCount }}</div>
                </div>
            </div>
            <hr>
            <!-- DataTable -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped ajax_view max-table" id="tax_report_table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>@lang('sale.invoice_no')</th>
                            <th>@lang('lang_v1.type')</th>
                            <th>@lang('sale.location')</th>
                            <th>@lang('sale.customer_name')</th>
                            {{-- <th>@lang('zatca::lang.tax_name')</th>
                            <th>@lang('tax_rate.rate')</th> --}}
                            <th>@lang('zatca::lang.tax_amount')</th>
                            {{-- <th>@lang('zatca::lang.item_tax_info')</th> --}}
                            <th>@lang('zatca::lang.invoice_type')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                            <td></td>
                            <td class="footer_tax_total"></td>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        function updateTotalTaxLabel() {
            var transactionType = $('#zatca_tax_report_filter_transaction_type').val();
            var totalTaxLabel = '';

            if (transactionType == 'sell_return') {
                totalTaxLabel = "@lang('zatca::lang.total_tax_refunded')";
            } else {
                totalTaxLabel = "@lang('zatca::lang.total_tax_collected')";
            }
            $('#total_tax_label').text(totalTaxLabel);
        }
        updateTotalTaxLabel();
        $('#zatca_tax_report_filter_transaction_type').on('change', function() {
            updateTotalTaxLabel();
            tax_report_table.ajax.reload();
        });
        //Date range as a button
        $('#zatca_tax_report_filter_date_range').daterangepicker(
            dateRangeSettings,
            function(start, end) {
                $('#zatca_tax_report_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                tax_report_table.ajax.reload();
            }
        );
        $('#zatca_tax_report_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#zatca_tax_report_filter_date_range').val('');
            tax_report_table.ajax.reload();
        });


        $(document).on('change', '#zatca_tax_report_filter_location_id, #zatca_tax_report_filter_customer_id, #zatca_tax_report_filter_payment_status,#zatca_tax_report_filter_transaction_type ,  #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status', function() {
            tax_report_table.ajax.reload();
        });

        // Initialize DataTable
        var tax_report_table = $('#tax_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [
                [0, 'desc']
            ],
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                url: "{{ route('zatca.tax_report') }}",
                data: function(d) {
                    if ($('#zatca_tax_report_filter_date_range').val()) {
                        var start = $('#zatca_tax_report_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#zatca_tax_report_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }

                    if ($('#zatca_tax_report_filter_location_id').length) {
                        d.location_id = $('#zatca_tax_report_filter_location_id').val();
                    }
                    d.customer_id = $('#zatca_tax_report_filter_customer_id').val();

                    if ($('#zatca_tax_report_filter_transaction_type').length) {
                        d.payment_status = $('#zatca_tax_report_filter_payment_status').val();
                    }
                    if ($('#zatca_tax_report_filter_transaction_type').length) {
                        d.transaction_type = $('#zatca_tax_report_filter_transaction_type').val();
                    }
                    if ($('#created_by').length) {
                        d.created_by = $('#created_by').val();
                    }

                    d.status = $('#sync_status').val();

                    d.is_direct_sale = 1;

                    d = __datatable_ajax_callback(d);
                },
                dataSrc: function(json) {
                    // Update total_tax_collected
                    if (json.total_tax_collected !== undefined) {
                        $('#total_tax_collected').html(json.total_tax_collected);
                        __currency_convert_recursively($('#total_tax_collected'));
                    }

                    // Update sentCount
                    if (json.sentCount !== undefined) {
                        $('#sentCount').text(json.sentCount);
                    }

                    return json.data;
                }
            },
            columns: [{
                    data: 'transaction_date',
                    name: 'transactions.transaction_date'
                },
                {
                    data: 'invoice_no',
                    name: 'transactions.invoice_no'
                },
                {
                    data: 'transaction_type',
                    name: 'transaction_type'
                },
                {
                    data: 'location_name',
                    name: 'bl.name'
                },
                {
                    data: 'contact_name',
                    name: 'c.name'
                },
                // {
                //     data: 'tax_name',
                //     name: 'tr.name'
                // },
                // {
                //     data: 'tax_rate',
                //     name: 'tr.amount'
                // },
                {
                    data: 'tax_amount',
                    name: 'tax_amount'
                },
                { data: 'invoice_type', name: 'invoice_type' } 
                // { data: 'item_tax_info', name: 'item_tax_info', orderable: false, searchable: false }
            ],
            "fnDrawCallback": function(oSettings) {
                __currency_convert_recursively($('#sell_table'));
            },
            "footerCallback": function(row, data, start, end, display) {
                var footer_tax_total = 0;

                for (var r in data) {
                    footer_tax_total += $(data[r].tax_amount).data('orig-value') ? parseFloat($(data[r].tax_amount).data('orig-value')) : 0;

                }

                $('.footer_tax_total').html(__currency_trans_from_en(footer_tax_total));
            },
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:eq(6)').attr('class', 'clickable_td');
            }
        });
        $('.sell_filter_modal').on('shown.bs.modal', function() {
            $('.sell_filter_modal')
                .find('.select2')
                .each(function() {
                    var $p = $(this).parent();
                    $(this).select2({
                        dropdownParent: $p
                    });
                });
            $('#zatca_tax_report_filter_date_range').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#zatca_tax_report_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    tax_report_table.ajax.reload();
                }
            );
            $('#zatca_tax_report_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#zatca_tax_report_filter_date_range').val('');
                tax_report_table.ajax.reload();
            });
        });



    });
</script>
@endsection