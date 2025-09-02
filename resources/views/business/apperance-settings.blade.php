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
                <h1>@lang('business.system')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">

            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
            'files' => true ]) !!}

            <div class="row">
                {{-- <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('theme_color', __('lang_v1.theme_color')); !!}
                {!! Form::select('theme_color', $theme_colors,   $business->theme_color, 
                    ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); !!}
            </div>
        </div> --}}
                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                        $page_entries = [25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000, -1 => __('lang_v1.all')];
                        @endphp
                        {!! Form::label('default_datatable_page_entries', __('lang_v1.default_datatable_page_entries')); !!}
                        {!! Form::select('common_settings[default_datatable_page_entries]', $page_entries, !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25 ,
                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'default_datatable_page_entries']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch">
                                <input type="checkbox" id="enable_tooltip_checkbox" {{ $business->enable_tooltip ? 'checked' : '' }} onchange="updateEnableTooltipValue()">
                                <span class="sliderCheckbox round"></span>
                            </label>
                            <p>{{ __( 'business.show_help_text' ) }}</p>
                        </div>
                        <input type="hidden" name="enable_tooltip" id="enable_tooltip" value="{{ $business->enable_tooltip ? 1 : 0 }}">
                    </div>
                </div>
                <div class="clearfix"></div>
                
               @if($app_settings->enable_theme_change)
                
                @include('app_settings.partials.theme_selector')
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('primary_color', __('lang_v1.primary_color')) !!}
                        {!! Form::color('primary_color', $primary_color, ['class' => 'form-control', 'id' => 'primary_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('secondary_color',  __('lang_v1.secondary_color')) !!}
                        {!! Form::color('secondary_color', $secondary_color, ['class' => 'form-control', 'id' => 'secondary_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('sidebar_text_color', __('settings.sidebar_text_color_label')) !!}
                        {!! Form::color('sidebar_text_color', $sidebar_text_color, ['class' => 'form-control', 'id' => 'sidebar_text_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                         {!! Form::label('body_color', __('settings.body_color_label')) !!}
                        {!! Form::color('body_color', $body_color, ['class' => 'form-control', 'id' => 'body_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                       <br>
                        <button type="button" class="btn btn-primary" id="reset-colors">{{ __( 'lang_v1.reset_to_default' ) }}</button>
                    </div>
                </div>
                <script>
                    document.getElementById('reset-colors').addEventListener('click', function() {
                    document.getElementById('primary_color').value = '#FFB600';
                    document.getElementById('secondary_color').value = '#011530';
                });
                    </script>
                @endif
            </div>
            
            
            <script>
                document.getElementById('reset-colors').addEventListener('click', function() {
                    document.getElementById('primary_color').value = '#FFB600';
                    document.getElementById('secondary_color').value = '#011530';
                });
            </script>
            
            
            <div class="row hide">

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="enable_export">
                                {!! Form::checkbox('common_settings[is_enabled_export]', true, !empty($common_settings['is_enabled_export']) ? true : false ,
                                [ 'id' => 'enable_export']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_export' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('default_credit_limit',__('lang_v1.default_credit_limit') . ':') !!}
                        {!! Form::text('common_settings[default_credit_limit]', $common_settings['default_credit_limit'] ?? '', ['class' => 'form-control input_number',
                        'placeholder' => __('lang_v1.default_credit_limit'), 'id' => 'default_credit_limit']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="enable_product_warranty">
                                {!! Form::checkbox('common_settings[enable_product_warranty]', 1, !empty($common_settings['enable_product_warranty']) ? true : false,
                                [ 'id' => 'enable_product_warranty']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_product_warranty' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="enable_purchase_order">
                                {!! Form::checkbox('common_settings[enable_purchase_order]', 1, !empty($common_settings['enable_purchase_order']) , [ 'id' => 'enable_purchase_order']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_purchase_order' ) }}</p>@show_tooltip(__('lang_v1.purchase_order_help_text'))
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
<script>
function updateEnableTooltipValue() {
    const checkbox = document.getElementById('enable_tooltip_checkbox');
    const hiddenInput = document.getElementById('enable_tooltip');
    hiddenInput.value = checkbox.checked ? 1 : 0;
}
</script>
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

    $('#test_email_btn').click(function() {
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

    $('#test_sms_btn').click(function() {
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