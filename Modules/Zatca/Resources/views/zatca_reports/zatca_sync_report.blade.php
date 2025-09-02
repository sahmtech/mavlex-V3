@extends('layouts.app')

@section('title', __('zatca::lang.zatca') . ' ' . __('zatca::lang.invoice_report'))


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
                <h1>@lang('zatca::lang.zatca')</h1>

                @if($business->settings?->is_connected == 1)
                <p>@lang('zatca::lang.invoice_report') | @lang('zatca::lang.status') <span class="text-success">@lang('zatca::lang.connected')</span></p>
            @else
                <p>@lang('zatca::lang.invoice_report') | @lang('zatca::lang.status') <span class="text-warning">@lang('zatca::lang.ready_to_connect')</span></p>
            @endif
            
            </div>


            <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                <img src="{{ asset('img/icons/filter.svg') }}" alt="">
               
            </a>

        </div>

        @component('components.filters', ['title' => __('report.filters')])
        @include('zatca::zatca_reports.partials.sync_report_filters')
        @endcomponent
        <div class="content">

            <div class="crm-data-wrapper">
                <div class="crm-data-item">
                    <h3>@lang('lang_v1.not_sent')</h3>
                    <div class="data-numbers" id="newCount">{{ $newCount }}</div>
                </div>

                <div class="crm-data-item">
                    <h3>@lang('lang_v1.sent')</h3>
                    <div class="data-numbers" id="sentCount">{{ $sentCount }}</div>
                </div>
                <div class="crm-data-item">
                    <h3>@lang('lang_v1.failed')</h3>
                    <div class="data-numbers" id="failedCount">{{ $failedCount }}</div>
                </div>
                
                <div class="crm-data-item">
                    <h3>@lang('zatca::lang.sync_all')</h3>
                    <div id="syncAllNone" class="data-numbers" style="display:none;"> <span class="text-warning">@lang('zatca::lang.select_location_first')</span></div>
                    <div id="syncAllConnected" style="display:none;">
                    <button id="syncAllBtn" class="btn btn-primary">
                        <i class="fas fa-sync"></i> @lang('zatca::lang.sync_all')
                    </button>
                    </div>
                    <div id="syncAllNotConnected" style="display:none;">
                      <div class="data-numbers">
                        <span class="text-warning">@lang('zatca::lang.ready_to_connect')</span>
                      </div>
                    </div>
                  </div>
                  
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped ajax_view max-table" id="zatca_sell_table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>@lang('messages.action')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('sale.invoice_no')</th>
                            <th>@lang('lang_v1.type')</th>
                            <th>@lang('sale.location')</th>
                            <th>@lang('sale.customer_name')</th>
                            <th>@lang('zatca::lang.invoice_type')</th>
                            <th>@lang('zatca::lang.status')</th>
                            
                        </tr>
                    </thead>
                    {{--<tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                <!-- <td class="payment_method_count"></td> -->
                <td></td>
                <td class="footer_payment_status_count"></td>
                <td class="footer_sale_total"></td>
                <td class="footer_total_paid"></td>
                <td class="footer_total_remaining"></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>--}}
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="syncAllModal" tabindex="-1" role="dialog" aria-labelledby="syncAllModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('zatca::lang.confirm_sync') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @lang('zatca::lang.sync_all_confirmation_modal')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel') </button>
                <button type="button" class="btn btn-primary" id="confirmSyncAll">@lang('zatca::lang.sync_now') </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        $('#zatca_sell_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function(start, end) {
                $('#zatca_sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                zatca_sell_table.ajax.reload();
            }
        );

        $('#zatca_sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#zatca_sell_list_filter_date_range').val('');
            zatca_sell_table.ajax.reload();
        });

        $(document).on('change', '#zatca_sell_list_filter_location_id, #zatca_sell_list_filter_customer_id, #zatca_sell_list_filter_transaction_type, #zatca_sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status', function() {
            zatca_sell_table.ajax.reload();
        });

        var zatca_sell_table = $('#zatca_sell_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [
                [1, 'desc']
            ],
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                url: "{{ route('zatca.sync_report') }}",
                data: function(d) {
                    if ($('#zatca_sell_list_filter_date_range').val()) {
                        var start = $('#zatca_sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#zatca_sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }

                    if ($('#zatca_sell_list_filter_location_id').length) {
                        d.location_id = $('#zatca_sell_list_filter_location_id').val();
                    }
                    d.customer_id = $('#zatca_sell_list_filter_customer_id').val();

                    if ($('#zatca_sell_list_filter_payment_status').length) {
                        d.payment_status = $('#zatca_sell_list_filter_payment_status').val();
                    }
                    if ($('#zatca_sell_list_filter_transaction_type').length) {
                        d.transaction_type = $('#zatca_sell_list_filter_transaction_type').val();
                    }
                    if ($('#created_by').length) {
                        d.created_by = $('#created_by').val();
                    }

                    d.status = $('#sync_status').val();

                    d.is_direct_sale = 1;

                    d = __datatable_ajax_callback(d);
                },
                dataSrc: function(json) {
                    $('#newCount').text(json.newCount);
                    $('#sentCount').text(json.sentCount);
                    $('#failedCount').text(json.failedCount);
                    return json.data;
                }

            },

            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
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
                { data: 'invoice_type', name: 'invoice_type' },
                {
                    data: 'status_label',
                    name: 'transactions.sent_to_zatca',
                    orderable: false,
                    searchable: false
                },

            ],

            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#zatca_sell_table'));
            },
            footerCallback: function(row, data, start, end, display) {},
             createdRow: function(row, data, dataIndex) {
                $(row).find('td:eq(7)').attr('class', 'clickable_td');
            }
        });

        $('#sync_status').on('change', function() {
            zatca_sell_table.ajax.reload();
        });

        $('#only_subscriptions').on('ifChanged', function(event) {
            zatca_sell_table.ajax.reload();
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
        });
// map of location_id → is_connected
const locationConnected = @json($locationSettings);

function updateSyncUI() {
  const loc = $('#zatca_sell_list_filter_location_id').val();
  $('#syncAllNone, #syncAllConnected, #syncAllNotConnected').hide();
  if (!loc) {
    $('#syncAllNone').show();
  } else if (locationConnected[loc] == 1) {
    $('#syncAllConnected').show();
  } else {
    $('#syncAllNotConnected').show();
  }
}

updateSyncUI();
$('#zatca_sell_list_filter_location_id').on('change', function(){
  zatca_sell_table.ajax.reload();
  updateSyncUI();
});

        $('#syncAllBtn').on('click', function(e) {
            e.preventDefault();
            $('#syncAllModal').modal('show');
        });
        $('#confirmSyncAll').click(function() {
            const loc = $('#zatca_sell_list_filter_location_id').val();
  if (!loc) {
    alert('Please select a location first');
    return;
  }

            $('#syncAllModal .modal-body').html('<p>{{ __('zatca::lang.sync_started') }}</p>');
            $('#syncAllModal .modal-title').text('{{ __('zatca::lang.syncing_invoices') }}');
            $('#syncAllModal').modal('show');

            $.ajax({
                url: "{{ route('zatca.report.syncAll') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    location_id: loc
                },
                success: function(response) {
                    if (response.syncLogs && response.syncLogs.length > 0) {
                        let logHtml = `
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('receipt.invoice_number') }}</th>
                        <th>{{ __('zatca::lang.status') }}</th>
                        <th>{{ __('zatca::lang.message') }}</th>
                    </tr>
                </thead>
                <tbody>
        `;
                        response.syncLogs.forEach(function(log) {
                            let statusClass = '';
                            if (log.status === 'Success') {
                                statusClass = 'table-success';
                            } else if (log.status === 'Error') {
                                statusClass = 'table-danger';
                            } else if (log.status === 'Exception') {
                                statusClass = 'table-warning';
                            }

                            logHtml += `
                <tr class="${statusClass}">
                    <td>${log.invoice_no}</td>
                    <td>${log.status}</td>
                    <td>${log.message}</td>
                </tr>
            `;
                        });
                        logHtml += `
                </tbody>
            </table>
        `;
        $('#syncAllModal .modal-body').html(logHtml);
        $('#syncAllModal .modal-title').text('{{ __('zatca::lang.sync_completed') }}');
    } else {
        $('#syncAllModal .modal-body').html(`<p>${response.message}</p>`);
        $('#syncAllModal .modal-title').text('{{ __('zatca::lang.sync_completed') }}');
    }
                }

            });
        });
    });
</script>
@endsection