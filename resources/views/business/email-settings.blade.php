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
                <h1>@lang('lang_v1.email_settings')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}
            
           <div class="row">
        @if(!empty($allow_superadmin_email_settings))
        <div class="col-xs-12">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    {!! Form::checkbox('email_settings[use_superadmin_settings]', 1, !empty($email_settings['use_superadmin_settings']) , 
                    [ 'class' => 'input-icheck', 'id' => 'use_superadmin_settings']); !!} {{ __( 'lang_v1.use_superadmin_email_settings' ) }}
                  </label>
                </div>
            </div>
        </div>
        @endif
        <div id="toggle_visibility" @if(!empty($email_settings['use_superadmin_settings'])) class="hide" @endif>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_driver', __('lang_v1.mail_driver') . ':') !!}
                {!! Form::select('email_settings[mail_driver]', $mail_drivers, !empty($email_settings['mail_driver']) ? $email_settings['mail_driver'] : 'smtp', ['class' => 'form-control', 'id' => 'mail_driver']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_host', __('lang_v1.mail_host') . ':') !!}
                {!! Form::text('email_settings[mail_host]', $email_settings['mail_host'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_host'), 'id' => 'mail_host']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_port' , __('lang_v1.mail_port') . ':') !!}
                {!! Form::text('email_settings[mail_port]', $email_settings['mail_port'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_port'), 'id' => 'mail_port']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_username', __('lang_v1.mail_username') . ':') !!}
                {!! Form::text('email_settings[mail_username]', $email_settings['mail_username'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_username'), 'id' => 'mail_username']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_password', __('lang_v1.mail_password') . ':') !!}
                <input type="password" name="email_settings[mail_password]" value="{{$email_settings['mail_password']}}" class="form-control" placeholder="{{__('lang_v1.mail_password')}}", id="mail_password">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_encryption', __('lang_v1.mail_encryption') . ':') !!}
                {!! Form::text('email_settings[mail_encryption]', $email_settings['mail_encryption'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_encryption_place'), 'id' => 'mail_encryption']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_from_address', __('lang_v1.mail_from_address') . ':') !!}
                {!! Form::email('email_settings[mail_from_address]', $email_settings['mail_from_address'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_from_address'), 'id' => 'mail_from_address' ]); !!}
            </div>
        </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('mail_from_name', __('lang_v1.mail_from_name') . ':') !!}
                {!! Form::text('email_settings[mail_from_name]', $email_settings['mail_from_name'], ['class' => 'form-control','placeholder' => __('lang_v1.mail_from_name'), 'id' => 'mail_from_name']); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 test_email_btn @if(!empty($email_settings['use_superadmin_settings'])) hide @endif">
            <button type="button" class="btn btn-success pull-right" id="test_email_btn">@lang('lang_v1.test_email_configuration')</button>
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