@extends('layouts.app')
@section('title', __('contact.view_contact'))

@section('content')

<div class="main-container no-print">

    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.contact', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <div class="setting-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'contact.view_contact' )</h1>
                <p>@lang('contact.contacts')</p>
            </div>

            <div class="filter">
                <div class="form-box">
                    {!! Form::select('contact_id', $contact_dropdown, $contact->id , ['class' => 'form-control select2', 'id' => 'contact_id']); !!}
                </div>

                <div class="form-box">
                    <select name="" class="form-control" id="tab" >
                        <option value="ledger">@lang('lang_v1.ledger')</option>
                        @if(in_array($contact->type, ['both', 'supplier']))
                        <option value="purchases">@lang( 'purchase.purchases')</option>
                        <option value="stock_report">@lang( 'report.stock_report')</option>
                        @endif
                        @if(in_array($contact->type, ['both', 'customer']))
                        <option value="sells">@lang( 'sale.sells')</option>
                        @if(in_array('subscription', $enabled_modules))
                        <option value="subscriptions">@lang( 'lang_v1.subscriptions')</option>
                        @endif
                        @endif
                        @if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp'))
                        <option value="reward_points">{{ session('business.rp_name') ?? __( 'lang_v1.reward_points')}}</option>
                        @endif
                        <option value="payments">@lang('sale.payments')</option>
                        <option value="documents_and_notes">@lang('lang_v1.documents_and_notes')</option>
                        <option value="activities">@lang('lang_v1.activities')</option>
                        <!-- @if(!empty($contact_view_tabs))
                            @foreach($contact_view_tabs as $key => $tabs)
                                @foreach ($tabs as $index => $value)
                                    @if(!empty($value['tab_menu_path']))
                                        @php
                                            $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                        @endphp
                                        @include($value['tab_menu_path'], $tab_data)
                                    @endif
                                @endforeach
                            @endforeach
                        @endif -->
                    </select>
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

        <div class="customer-details-wrapper">

            @include('contact.contact_basic_info')

            @include('contact.contact_more_info')

            @if( $contact->type != 'customer')
            @include('contact.contact_tax_info')
            @endif

            <button class="send-mail" id="send_ledger">@lang('lang_v1.send_to_mail')</button>
        </div>

        @include('contact.contact_payment_info')

        <input type="hidden" id="sell_list_filter_customer_id" value="{{$contact->id}}">
        <input type="hidden" id="purchase_list_filter_supplier_id" value="{{$contact->id}}">

        <div id="tabLedger">
            @include('contact.partials.ledger_tab')
        </div>

        @if(in_array($contact->type, ['both', 'supplier']))
        <div id="tabPurchases" style="display: none;">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_date_range', __('report.date_range') . ':') !!}
                        {!! Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                    </div>
                </div>
                <div class="col-md-12" style="min-height: .01%; overflow-x: auto;">
                    @include('purchase.partials.purchase_table')
                </div>
            </div>
        </div>
        <div id="tabStock_report" style="display: none;">
            @include('contact.partials.stock_report_tab')
        </div>
        @endif
        @if(in_array($contact->type, ['both', 'customer']))


        <div id="tabSells" style="display: none;">
            <div class="card-wrapper" style="margin-bottom:30px;">
                <div class="overview-filter">
                    <div class="title">
                        <h2> @lang( 'sale.sells')</h2>
                    </div>
                    <div class="filter">
                        <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter1">
                            <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                           
                        </a>
                    </div>
                </div>

                <div id="collapseFilter1" class="collapse">
                    @include('sell.partials.sell_list_filters', ['only' => ['sell_list_filter_payment_status', 'sell_list_filter_date_range', 'only_subscriptions']])
                </div>
                <div class="row">
                    <div class="col-md-12" style="min-height: .01%; overflow-x: auto;">
                        @include('sale_pos.partials.sales_table')
                    </div>
                </div>
            </div>
        </div>
        @if(in_array('subscription', $enabled_modules))
        <div id="tabSubscriptions" style="display: none;">
            @include('contact.partials.subscriptions')
        </div>
        @endif
        @endif
        @if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp'))
        <div id="tabReward_points" style="display: none;">
            <div class="row">
                @if($reward_enabled)
                <div class="col-md-3">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-gift"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{session('business.rp_name')}}</span>
                            <span class="info-box-number">{{$contact->total_rp ?? 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="table-responsive" style="min-height: .01%; overflow-x: auto;">
                        <table class="table table-bordered table-striped general-table" id="rp_log_table" width="100%">
                            <thead>
                                <tr>
                                    <th>@lang('messages.date')</th>
                                    <th>@lang('sale.invoice_no')</th>
                                    <th>@lang('lang_v1.earned')</th>
                                    <th>@lang('lang_v1.redeemed')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div id="tabPayments" style="display: none;">

            <div id="contact_payments_div" style="height: 500px;overflow-y: scroll;"></div>
        </div>
        <div id="tabDocuments_and_notes" style="display: none;">
            @include('contact.partials.documents_and_notes_tab')
        </div>
        <div id="tabActivities" style="display: none;">
            <div class="card-wrapper" style="margin-bottom:30px;">

                <div class="overview-filter">
                    <div class="title">
                        <h2> @lang('lang_v1.activities')</h2>
                    </div>
                </div>
                @include('activity_log.activities')
            </div>
        </div>

    </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {

        $('#tab').on('change', function() {
            var target = $(this).find(":selected").val();
            if (target == 'ledger') {
                $('#tabLedger').show();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'purchases') {
                $('#tabLedger').hide();
                $('#tabPurchases').show();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'stock_report') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').show();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'sells') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').show();
                sell_table.ajax.reload();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'subscriptions') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').show();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'reward_points') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').show();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
            } else if (target == 'payments') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').show();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').hide();
                get_contact_payments();
            } else if (target == 'documents_and_notes') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').show();
                initialize_documents_and_notes();
                $('#tabActivities').hide();
            } else if (target == 'activities') {
                $('#tabLedger').hide();
                $('#tabPurchases').hide();
                $('#tabStock_report').hide();
                $('#tabSells').hide();
                $('#tabSubscriptions').hide();
                $('#tabReward_points').hide();
                $('#tabPayments').hide();
                $('#tabDocuments_and_notes').hide();
                $('#tabActivities').show();
            }
        });

        $('#ledger_date_range').daterangepicker(
            dateRangeSettings,
            function(start, end) {
                $('#ledger_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#ledger_date_range').change(function() {
            get_contact_ledger();
        });
        get_contact_ledger();

        rp_log_table = $('#rp_log_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [
                [0, 'desc']
            ],
            ajax: '/sells?customer_id={{ $contact->id }}&rewards_only=true',
            columns: [{
                    data: 'transaction_date',
                    name: 'transactions.transaction_date'
                },
                {
                    data: 'invoice_no',
                    name: 'transactions.invoice_no'
                },
                {
                    data: 'rp_earned',
                    name: 'transactions.rp_earned'
                },
                {
                    data: 'rp_redeemed',
                    name: 'transactions.rp_redeemed'
                },
            ]
        });

        supplier_stock_report_table = $('#supplier_stock_report_table').DataTable({
            processing: true,
            serverSide: true,
            'ajax': {
                url: "{{action('ContactController@getSupplierStockReport', [$contact->id])}}",
                data: function(d) {
                    d.location_id = $('#sr_location_id').val();
                }
            },
            columns: [{
                    data: 'product_name',
                    name: 'p.name'
                },
                {
                    data: 'sub_sku',
                    name: 'v.sub_sku'
                },
                {
                    data: 'purchase_quantity',
                    name: 'purchase_quantity',
                    searchable: false
                },
                {
                    data: 'total_quantity_sold',
                    name: 'total_quantity_sold',
                    searchable: false
                },
                {
                    data: 'total_quantity_returned',
                    name: 'total_quantity_returned',
                    searchable: false
                },
                {
                    data: 'current_stock',
                    name: 'current_stock',
                    searchable: false
                },
                {
                    data: 'stock_price',
                    name: 'stock_price',
                    searchable: false
                }
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#supplier_stock_report_table'));
            },
        });

        $('#sr_location_id').change(function() {
            supplier_stock_report_table.ajax.reload();
        });

        $('#contact_id').change(function() {
            if ($(this).val()) {
                window.location = "{{url('/contacts')}}/" + $(this).val();
            }
        });

        $('a[href="#tabSells"]').on('shown.bs.tab', function(e) {

            sell_table.ajax.reload();
        });
    });


    $("input.transaction_types, input#show_payments").on('ifChanged', function(e) {
        get_contact_ledger();
    });

    $(document).one('shown.bs.tab', 'a[href="#payments_tab"]', function() {
        get_contact_payments();
    })

    $(document).on('click', '#contact_payments_pagination a', function(e) {
        e.preventDefault();
        get_contact_payments($(this).attr('href'));
    })

    function get_contact_payments(url = null) {
        if (!url) {
            url = "{{action('ContactController@getContactPayments', [$contact->id])}}";
        }
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(result) {
                $('#contact_payments_div').fadeOut(400, function() {
                    $('#contact_payments_div')
                        .html(result).fadeIn(400);
                });
            },
        });
    }

    function initialize_documents_and_notes() {
        if ($.fn.DataTable.isDataTable('#documents_and_notes_table')) {
            var documents_and_notes_table = $('#documents_and_notes_table').DataTable();
            documents_and_notes_table.ajax.reload(function() {
                setTimeout(function() {
                    documents_and_notes_table.columns.adjust().draw();
                }, 0);
            });
        }


    }

    function get_contact_ledger() {

        var start_date = '';
        var end_date = '';
        var transaction_types = $('input.transaction_types:checked').map(function(i, e) {
            return e.value
        }).toArray();
        var show_payments = $('input#show_payments').is(':checked');

        if ($('#ledger_date_range').val()) {
            start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        $.ajax({
            url: '/contacts/ledger?contact_id={{$contact->id}}&start_date=' + start_date + '&transaction_types=' + transaction_types + '&show_payments=' + show_payments + '&end_date=' + end_date,
            dataType: 'html',
            success: function(result) {
                $('#contact_ledger_div')
                    .html(result);
                __currency_convert_recursively($('#contact_ledger_div'));

                $('#ledger_table').DataTable({
                    searching: false,
                    ordering: false,
                    paging: false,
                    dom: 't'
                });
            },
        });
    }

    $(document).on('click', '#send_ledger', function() {
        var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

        var url = "{{action('NotificationController@getTemplate', [$contact->id, 'send_ledger'])}}" + '?start_date=' + start_date + '&end_date=' + end_date;

        $.ajax({
            url: url,
            dataType: 'html',
            success: function(result) {
                $('.view_modal')
                    .html(result)
                    .modal('show');
            },
        });
    })

    $(document).on('click', '#print_ledger_pdf', function() {
        var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

        var url = $(this).data('href') + '&start_date=' + start_date + '&end_date=' + end_date;
        window.open(url);
    });
</script>
@include('sale_pos.partials.sale_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@if(in_array($contact->type, ['both', 'supplier']))
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
@endif

<!-- document & note.js -->
@include('documents_and_notes.document_and_note_js')
@if(!empty($contact_view_tabs))
@foreach($contact_view_tabs as $key => $tabs)
@foreach ($tabs as $index => $value)
@if(!empty($value['module_js_path']))
@include($value['module_js_path'])
@endif
@endforeach
@endforeach
@endif

<script type="text/javascript">
    $(document).ready(function() {
        $('#purchase_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function(start, end) {
                $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                purchase_table.ajax.reload();
            }
        );
        $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_list_filter_date_range').val('');
            purchase_table.ajax.reload();
        });
    });
</script>
@include('sale_pos.partials.subscriptions_table_javascript', ['contact_id' => $contact->id])
@endsection