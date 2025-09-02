@extends('layouts.app')
@section('title', __('lang_v1.cash_flow'))

@section('content')
<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.account', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.cash_flow')</h1>
                <p>@lang('account.manage_your_account')</p>
            </div>

            <div class="filter">
                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>

        @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('account_id', __('account.account') . ':') !!}
                    {!! Form::select('account_id', $accounts, '', ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder' => __('messages.all')]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('cash_flow_location_id',  __('purchase.business_location') . ':') !!}
                    {!! Form::select('cash_flow_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width: 100%']); !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('transaction_date_range', __('report.date_range') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        {!! Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('transaction_type', __('account.transaction_type') . ':') !!}
                    {!! Form::select('transaction_type', ['' => __('messages.all'),'debit' => __('account.debit'), 'credit' => __('account.credit')], '', ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
                </div>
            </div>
        @endcomponent

        <div class="content">
            @can('account.access')
                <div class="table-responsive">
                <table class="table max-table" id="cash_flow_table">
                    <thead>
                        <tr>
                            <th>@lang( 'messages.date' )</th>
                            <th>@lang( 'account.account' )</th>
                            <th>@lang( 'lang_v1.description' )</th>
                            <th>@lang('account.debit')</th>
                            <th>@lang('account.credit')</th>
                            <th>@lang( 'lang_v1.account_balance' ) @show_tooltip(__('lang_v1.account_balance_tooltip'))</th>
                            <th>@lang( 'lang_v1.total_balance' ) @show_tooltip(__('lang_v1.total_balance_tooltip'))</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                            <td class="footer_total_debit"></td>
                            <td class="footer_total_credit"></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            @endcan
            
            <div class="modal fade account_filter_modal" tabindex="-1" role="dialog" 
                aria-labelledby="gridSystemModalLabel">
            </div>

            <div class="modal fade account_model" tabindex="-1" role="dialog" 
                aria-labelledby="gridSystemModalLabel">
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        // dateRangeSettings.autoUpdateInput = false
        $('#transaction_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                cash_flow_table.ajax.reload();
            }
        );
        
        // Cash Flow Table
        var cash_flow_table = $('#cash_flow_table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "{{action("AccountController@cashFlow")}}",
                    "data": function ( d ) {
                        d.start_date = $('input#transaction_date_range')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                        d.end_date = $('input#transaction_date_range')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                        d.account_id = $('#account_id').val();
                        d.type = $('#transaction_type').val();
                        d.location_id = $('#cash_flow_location_id').val();

                    }
                },
            "ordering": false,
            "searching": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'account_name', name: 'account_name'},
                {data: 'sub_type', name: 'sub_type'},
                {data: 'debit', name: 'amount'},
                {data: 'credit', name: 'amount'},
                {data: 'balance', name: 'balance'},
                {data: 'total_balance', name: 'total_balance'},
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#cash_flow_table'));
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var footer_total_debit = 0;
                var footer_total_credit = 0;

                for (var r in data){
                    footer_total_debit += $(data[r].debit).data('orig-value') ? parseFloat($(data[r].debit).data('orig-value')) : 0;
                    footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                }

                $('.footer_total_debit').html(__currency_trans_from_en(footer_total_debit));
                $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
            }
        });


        $('#transaction_type, #account_id, #cash_flow_location_id').change( function(){
            cash_flow_table.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('').change();
            cash_flow_table.ajax.reload();
        });

        

    });
</script>
@endsection