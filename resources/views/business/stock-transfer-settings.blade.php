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
                <h1>@lang('lang_v1.stock_transfers')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}

           {!! Form::hidden('is_stock_transfer_setting', 1) !!}
            
           <div class="row">
    
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_unit_price">
                    {!! Form::checkbox('es_unit_price', 1, $business->es_unit_price , 
            [ 'id' => 'es_unit_price']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_unit_price' ) }}</p>@show_tooltip(__('lang_v1.es_unit_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_sub_total">
                    {!! Form::checkbox('es_sub_total', 1, $business->es_sub_total , ['id' => 'es_sub_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_sub_total' ) }}</p>@show_tooltip(__('lang_v1.es_sub_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_net_total_amount">
                    {!! Form::checkbox('es_net_total_amount', 1, $business->es_net_total_amount , [ 'id' => 'es_net_total_amount']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_net_total_amount' ) }}</p>@show_tooltip(__('lang_v1.es_net_total_amount_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_additional_shipping_charges">
                    {!! Form::checkbox('es_additional_shipping_charges', 1, $business->es_additional_shipping_charges , 
                [ 'id' => 'es_additional_shipping_charges']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_additional_shipping_charges' ) }}</p>@show_tooltip(__('lang_v1.es_additional_shipping_charges_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_purchase_total">
                    {!! Form::checkbox('es_purchase_total', 1, $business->es_purchase_total , 
                [ 'id' => 'es_purchase_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_purchase_total' ) }}</p>@show_tooltip(__('lang_v1.es_purchase_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_approved_by">
                    {!! Form::checkbox('es_approved_by', 1, $business->es_approved_by , ['id' => 'es_approved_by']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_approved_by' ) }}</p>@show_tooltip(__('lang_v1.es_approved_by_tooltip'))
            </div>
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