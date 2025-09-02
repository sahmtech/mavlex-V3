@extends('layouts.app')
@section('title', __('business.business_settings'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.setting', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.prefixes')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}
            <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_prefix = '';
                    if(!empty($business->ref_no_prefixes['purchase'])){
                        $purchase_prefix = $business->ref_no_prefixes['purchase'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[purchase]', __('lang_v1.purchase') . ':') !!}
                {!! Form::text('ref_no_prefixes[purchase]', $purchase_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_return = '';
                    if(!empty($business->ref_no_prefixes['purchase_return'])){
                        $purchase_return = $business->ref_no_prefixes['purchase_return'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[purchase_return]', __('lang_v1.purchase_return') . ':') !!}
                {!! Form::text('ref_no_prefixes[purchase_return]', $purchase_return, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_requisition_prefix = !empty($business->ref_no_prefixes['purchase_requisition']) ? $business->ref_no_prefixes['purchase_requisition'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[purchase_requisition]', __('lang_v1.purchase_requisition') . ':') !!}
                {!! Form::text('ref_no_prefixes[purchase_requisition]', $purchase_requisition_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_order_prefix = !empty($business->ref_no_prefixes['purchase_order']) ? $business->ref_no_prefixes['purchase_order'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[purchase_order]', __('lang_v1.purchase_order') . ':') !!}
                {!! Form::text('ref_no_prefixes[purchase_order]', $purchase_order_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_transfer_prefix = '';
                    if(!empty($business->ref_no_prefixes['stock_transfer'])){
                        $stock_transfer_prefix = $business->ref_no_prefixes['stock_transfer'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[stock_transfer]', __('lang_v1.stock_transfer') . ':') !!}
                {!! Form::text('ref_no_prefixes[stock_transfer]', $stock_transfer_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_adjustment_prefix = '';
                    if(!empty($business->ref_no_prefixes['stock_adjustment'])){
                        $stock_adjustment_prefix = $business->ref_no_prefixes['stock_adjustment'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[stock_adjustment]', __('stock_adjustment.stock_adjustment') . ':') !!}
                {!! Form::text('ref_no_prefixes[stock_adjustment]', $stock_adjustment_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_return_prefix = '';
                    if(!empty($business->ref_no_prefixes['sell_return'])){
                        $sell_return_prefix = $business->ref_no_prefixes['sell_return'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[sell_return]', __('lang_v1.sell_return') . ':') !!}
                {!! Form::text('ref_no_prefixes[sell_return]', $sell_return_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expenses_prefix = '';
                    if(!empty($business->ref_no_prefixes['expense'])){
                        $expenses_prefix = $business->ref_no_prefixes['expense'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[expense]', __('expense.expenses') . ':') !!}
                {!! Form::text('ref_no_prefixes[expense]', $expenses_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $contacts_prefix = '';
                    if(!empty($business->ref_no_prefixes['contacts'])){
                        $contacts_prefix = $business->ref_no_prefixes['contacts'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[contacts]', __('contact.contacts') . ':') !!}
                {!! Form::text('ref_no_prefixes[contacts]', $contacts_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_payment = '';
                    if(!empty($business->ref_no_prefixes['purchase_payment'])){
                        $purchase_payment = $business->ref_no_prefixes['purchase_payment'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[purchase_payment]', __('lang_v1.purchase_payment') . ':') !!}
                {!! Form::text('ref_no_prefixes[purchase_payment]', $purchase_payment, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_payment = '';
                    if(!empty($business->ref_no_prefixes['sell_payment'])){
                        $sell_payment = $business->ref_no_prefixes['sell_payment'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[sell_payment]', __('lang_v1.sell_payment') . ':') !!}
                {!! Form::text('ref_no_prefixes[sell_payment]', $sell_payment, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expense_payment = '';
                    if(!empty($business->ref_no_prefixes['expense_payment'])){
                        $expense_payment = $business->ref_no_prefixes['expense_payment'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[expense_payment]', __('lang_v1.expense_payment') . ':') !!}
                {!! Form::text('ref_no_prefixes[expense_payment]', $expense_payment, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $business_location_prefix = '';
                    if(!empty($business->ref_no_prefixes['business_location'])){
                        $business_location_prefix = $business->ref_no_prefixes['business_location'];
                    }
                @endphp
                {!! Form::label('ref_no_prefixes[business_location]', __('business.business_location') . ':') !!}
                {!! Form::text('ref_no_prefixes[business_location]', $business_location_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $username_prefix = !empty($business->ref_no_prefixes['username']) ? $business->ref_no_prefixes['username'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[username]', __('business.username') . ':') !!}
                {!! Form::text('ref_no_prefixes[username]', $username_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $subscription_prefix = !empty($business->ref_no_prefixes['subscription']) ? $business->ref_no_prefixes['subscription'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[subscription]', __('lang_v1.subscription_no') . ':') !!}
                {!! Form::text('ref_no_prefixes[subscription]', $subscription_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $draft_prefix = !empty($business->ref_no_prefixes['draft']) ? $business->ref_no_prefixes['draft'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[draft]', __('sale.draft') . ':') !!}
                {!! Form::text('ref_no_prefixes[draft]', $draft_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sales_order_prefix = !empty($business->ref_no_prefixes['sales_order']) ? $business->ref_no_prefixes['sales_order'] : '';
                @endphp
                {!! Form::label('ref_no_prefixes[sales_order]', __('lang_v1.sales_order') . ':') !!}
                {!! Form::text('ref_no_prefixes[sales_order]', $sales_order_prefix, ['class' => 'form-control']); !!}
            </div>
        </div>
    </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-danger pull-right" type="submit">@lang('business.update_settings')</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
        
    </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
    __page_leave_confirmation('#bussiness_edit_form');
    $(document).on('ifToggled', '#use_superadmin_settings', function() {
        if ($('#use_superadmin_settings').is(':checked')) {
            $('#toggle_visibility').addClass('hide');
            $('.test_email_btn').addClass('hide');
        } else {
            $('#toggle_visibility').removeClass('hide');
            $('.test_email_btn').removeClass('hide');
        }
    });

    $('#test_email_btn').click( function() {
        var data = {
            mail_driver: $('#mail_driver').val(),
            mail_host: $('#mail_host').val(),
            mail_port: $('#mail_port').val(),
            mail_username: $('#mail_username').val(),
            mail_password: $('#mail_password').val(),
            mail_encryption: $('#mail_encryption').val(),
            mail_from_address: $('#mail_from_address').val(),
            mail_from_name: $('#mail_from_name').val(),
        };
        $.ajax({
            method: 'post',
            data: data,
            url: "{{ action('BusinessController@testEmailConfiguration') }}",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

    $('#test_sms_btn').click( function() {
        var test_number = $('#test_number').val();
        if (test_number.trim() == '') {
            toastr.error('{{__("lang_v1.test_number_is_required")}}');
            $('#test_number').focus();

            return false;
        }

        var data = {
            url: $('#sms_settings_url').val(),
            send_to_param_name: $('#send_to_param_name').val(),
            msg_param_name: $('#msg_param_name').val(),
            request_method: $('#request_method').val(),
            param_1: $('#sms_settings_param_key1').val(),
            param_2: $('#sms_settings_param_key2').val(),
            param_3: $('#sms_settings_param_key3').val(),
            param_4: $('#sms_settings_param_key4').val(),
            param_5: $('#sms_settings_param_key5').val(),
            param_6: $('#sms_settings_param_key6').val(),
            param_7: $('#sms_settings_param_key7').val(),
            param_8: $('#sms_settings_param_key8').val(),
            param_9: $('#sms_settings_param_key9').val(),
            param_10: $('#sms_settings_param_key10').val(),

            param_val_1: $('#sms_settings_param_val1').val(),
            param_val_2: $('#sms_settings_param_val2').val(),
            param_val_3: $('#sms_settings_param_val3').val(),
            param_val_4: $('#sms_settings_param_val4').val(),
            param_val_5: $('#sms_settings_param_val5').val(),
            param_val_6: $('#sms_settings_param_val6').val(),
            param_val_7: $('#sms_settings_param_val7').val(),
            param_val_8: $('#sms_settings_param_val8').val(),
            param_val_9: $('#sms_settings_param_val9').val(),
            param_val_10: $('#sms_settings_param_val10').val(),
            test_number: test_number
        };

        $.ajax({
            method: 'post',
            data: data,
            url: "{{ action('BusinessController@testSmsConfiguration') }}",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });
</script>
@endsection