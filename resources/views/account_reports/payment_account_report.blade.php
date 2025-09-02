@extends('layouts.app')
@section('title', __('account.payment_account_report'))

@section('content')
<div class="main-container no-print">
    
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.report.expense-account', ['link_class' => 'sub-menu-item'])
        </div>
    </div>
           <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">     
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('account.payment_account_report')}}</h1>
                <p>@lang('account.manage_your_account')</p>
            </div>

            <div class="filter">
                <div class="newuser">
                {!! Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'id' => 'account_id']); !!}
                </div>
                <div class="newuser">
                {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'date_filter', 'readonly']); !!}
                </div>
                <div class="newuser">
                <button type="button" onclick="window.print()" class="report-print">
                    <img src="{{ asset('img/icons/printer.svg') }}" alt="">
                </button>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="table-responsive">
                <table class="table max-table" id="payment_account_report">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>@lang('account.payment_ref_no')</th>
                            <th>@lang('account.invoice_ref_no')</th>
                            <th>@lang('lang_v1.payment_type')</th>
                            <th>@lang('account.account')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    
    <script type="text/javascript">
        $(document).ready(function(){
            if($('#date_filter').length == 1){
                $('#date_filter').daterangepicker(
                    dateRangeSettings,
                    function (start, end) {
                        $('#date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                        payment_account_report.ajax.reload();
                    }
                );

                $('#date_filter').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                    payment_account_report.ajax.reload();
                });
            }

            var payment_account_report = $('#payment_account_report').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{{action('AccountReportsController@paymentAccountReport')}}",
                    "data": function ( d ) {
                        d.account_id = $('#account_id').val();
                        var start_date = '';
                        var endDate = '';
                        if($('#date_filter').val()){
                            var start_date = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            var endDate = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start_date;
                        d.end_date = endDate;
                    }
                },
                columnDefs:[{
                    "targets": 5,
                    "orderable": false,
                    "searchable": false
                }],
                columns: [
                    {data: 'paid_on', name: 'paid_on'},
                    {data: 'payment_ref_no', name: 'payment_ref_no'},
                    {data: 'transaction_number', name: 'transaction_number'},
                    {data: 'type', name: 'T.type'},
                    {data: 'account', name: 'account'},
                    {data: 'action', name: 'action'}
                ],
                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#payment_account_report'));
                }
            });
            
            $('select#account_id, #date_filter').change( function(){
                payment_account_report.ajax.reload();
            });
        })

        $(document).on('submit', 'form#link_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                method: $(this).attr("method"),
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success === true){
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        payment_account_report.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    </script>
@endsection