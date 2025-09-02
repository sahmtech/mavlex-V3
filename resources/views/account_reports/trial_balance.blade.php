@extends('layouts.app')
@section('title', __( 'account.trial_balance' ))

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
                <h1>@lang( 'account.trial_balance')</h1>
                <p>@lang('account.manage_your_account')</p>
            </div>

            <div class="filter">
                <div class="newuser">
                {!! Form::select('trial_bal_location_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'trial_bal_location_id']); !!}
                </div>
                <div class="newuser">
                <input type="text" id="end_date" value="{{@format_date('now')}}" class="form-control" readonly>
                </div>
                <div class="newuser">
                <button type="button" onclick="window.print()" class="report-print">
                    <img src="{{ asset('img/icons/printer.svg') }}" alt="">
                </button>
                </div>
            </div>
        </div>

        <div class="content">
            <section class="content">
    
    <div class="box box-solid">
        <div class="box-header print_section">
            <h3 class="box-title">{{session()->get('business.name')}} - @lang( 'account.trial_balance') - <span id="hidden_date">{{@format_date('now')}}</span></h3>
        </div>
        <div class="box-body" style="min-height: .01%; overflow-x: auto;">
            <table class="table table-border-center-col no-border table-pl-12" id="trial_balance_table">
                <thead>
                    <tr>
                        <th>@lang('account.trial_balance')</th>
                        <th>@lang('account.debit')</th>
                        <th>@lang('account.credit')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>@lang('account.supplier_due'):</th>
                        <td>&nbsp;</td>
                        <td>
                            <input type="hidden" id="hidden_supplier_due" class="debit">
                            <span class="remote-data" id="supplier_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('account.customer_due'):</th>
                        <td>
                            <input type="hidden" id="hidden_customer_due" class="credit">
                            <span class="remote-data" id="customer_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>@lang('account.account_balances'):</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
                <tbody id="account_balances_details">
                </tbody>
                {{--
                <tbody>
                    <tr>
                        <th>@lang('account.capital_accounts'):</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
                <tbody id="capital_account_balances_details"></tbody>
                --}}
                <tfoot>
                    <tr>
                        <th>@lang('sale.total')</th>
                        <td>
                            <span class="remote-data" id="total_credit">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                        <td>
                            <span class="remote-data" id="total_debit">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
    </div>

</section>
        </div>
    </div>
</div>

@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready( function(){
        //Date picker
        $('#end_date').datepicker({
            autoclose: true,
            format: datepicker_date_format
        });
        update_trial_balance();

        $('#end_date').change( function() {
            update_trial_balance();
            $('#hidden_date').text($(this).val());
        });
        $('#trial_bal_location_id').change( function() {
            update_trial_balance();
        });
    });

    function update_trial_balance(){
        var loader = '<i class="fas fa-sync fa-spin fa-fw"></i>';
        $('span.remote-data').each( function() {
            $(this).html(loader);
        });

        $('table#trial_balance_table tbody#capital_account_balances_details').html('<tr><td colspan="3"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');
        $('table#trial_balance_table tbody#account_balances_details').html('<tr><td colspan="3"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');

        var end_date = $('input#end_date').val();
        var location_id = $('#trial_bal_location_id').val()
        $.ajax({
            url: "{{action('AccountReportsController@trialBalance')}}?end_date=" + end_date + '&location_id=' + location_id,
            dataType: "json",
            success: function(result){
                $('span#supplier_due').text(__currency_trans_from_en(result.supplier_due, true));
                __write_number($('input#hidden_supplier_due'), result.supplier_due);

                $('span#customer_due').text(__currency_trans_from_en(result.customer_due, true));
                __write_number($('input#hidden_customer_due'), result.customer_due);

                var account_balances = result.account_balances;
                $('table#trial_balance_table tbody#account_balances_details').html('');
                for (var key in account_balances) {
                    var accnt_bal = __currency_trans_from_en(result.account_balances[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.account_balances[key], true);
                    var account_tr = '<tr><td class="pl-20-td">' + key + ':</td><td><input type="hidden" class="credit" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td><td>&nbsp;</td></tr>';
                    $('table#trial_balance_table tbody#account_balances_details').append(account_tr);
                }

                var capital_account_details = result.capital_account_details;
                $('table#trial_balance_table tbody#capital_account_balances_details').html('');
                for (var key in capital_account_details) {
                    var accnt_bal = __currency_trans_from_en(result.capital_account_details[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.capital_account_details[key], true);
                    var account_tr = '<tr><td class="pl-20-td">' + key + ':</td><td><input type="hidden" class="credit" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td><td>&nbsp;</td></tr>';
                    $('table#trial_balance_table tbody#capital_account_balances_details').append(account_tr);
                }

                var total_debit = 0;
                var total_credit = 0;
                $('input.debit').each( function(){
                    total_debit += __read_number($(this));
                });
                $('input.credit').each( function(){
                    total_credit += __read_number($(this));
                });

                $('span#total_debit').text(__currency_trans_from_en(total_debit, true));
                $('span#total_credit').text(__currency_trans_from_en(total_credit, true));
            }
        });
    }
</script>

@endsection