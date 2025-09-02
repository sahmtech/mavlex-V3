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
                <h1>@lang('business.business_settings')</h1>
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
                        {!! Form::label('name',__('business.business_name') . ':*') !!}
                        {!! Form::text('name', $business->name, ['class' => 'form-control', 'required',
                        'placeholder' => __('business.business_name')]); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('start_date', __('business.start_date') . ':') !!}
                        {!! Form::text('start_date', @format_date($business->start_date), ['class' => 'form-control start-date-picker','placeholder' => __('business.start_date'), 'readonly']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('default_profit_percent', __('business.default_profit_percent') . ':*') !!} @show_tooltip(__('tooltip.default_profit_percent'))
                        {!! Form::text('default_profit_percent', @num_format($business->default_profit_percent), ['class' => 'form-control input_number']); !!}
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('currency_id', __('business.currency') . ':') !!}
                        {!! Form::select('currency_id', $currencies, $business->currency_id, ['class' => 'form-control select2','placeholder' => __('business.currency'), 'required']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('currency_symbol_placement', __('lang_v1.currency_symbol_placement') . ':') !!}
                        {!! Form::select('currency_symbol_placement', ['before' => __('lang_v1.before_amount'), 'after' => __('lang_v1.after_amount')], $business->currency_symbol_placement, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('time_zone', __('business.time_zone') . ':') !!}
                        {!! Form::select('time_zone', $timezone_list, $business->time_zone, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>

            
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('fy_start_month', __('business.fy_start_month') . ':') !!} @show_tooltip(__('tooltip.fy_start_month'))
                        {!! Form::select('fy_start_month', $months, $business->fy_start_month, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('accounting_method', __('business.accounting_method') . ':*') !!}
                        @show_tooltip(__('tooltip.accounting_method'))
                        {!! Form::select('accounting_method', $accounting_methods, $business->accounting_method, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('transaction_edit_days', __('business.transaction_edit_days') . ':*') !!}
                        @show_tooltip(__('tooltip.transaction_edit_days'))
                        {!! Form::number('transaction_edit_days', $business->transaction_edit_days, ['class' => 'form-control','placeholder' => __('business.transaction_edit_days'), 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('date_format', __('lang_v1.date_format') . ':*') !!}
                        {!! Form::select('date_format', $date_formats, $business->date_format, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('time_format', __('lang_v1.time_format') . ':*') !!}
                        {!! Form::select('time_format', [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')], $business->time_format, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('currency_precision', __('lang_v1.currency_precision') . ':*') !!} @show_tooltip(__('lang_v1.currency_precision_help'))
                        {!! Form::select('currency_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->currency_precision, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('quantity_precision', __('lang_v1.quantity_precision') . ':*') !!} @show_tooltip(__('lang_v1.quantity_precision_help'))
                        {!! Form::select('quantity_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->quantity_precision, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(!empty($app_settings->enable_custom_sidebar_logo) && $app_settings->enable_custom_sidebar_logo === true)
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('business_logo_light', __('lang_v1.upload_light_logo') . ':') !!}
                            @show_tooltip(__('lang_v1.logo_help_light'))
                            {!! Form::file('business_logo_light', ['accept' => 'image/*']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('business_logo_dark', __('lang_v1.upload_dark_logo') . ':') !!}
                            @show_tooltip(__('lang_v1.logo_help_dark'))
                            {!! Form::file('business_logo_dark', ['accept' => 'image/*']) !!}
                        </div>
                    </div>
                @endif
            </div>
             {{-- code --}}
            <div class="row hide">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_label_1', __('lang_v1.code_1_name') . ':') !!}
                        {!! Form::text('code_label_1', $business->code_label_1, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_1', __('lang_v1.code_1') . ':') !!}
                        {!! Form::text('code_1', $business->code_1, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_label_2', __('lang_v1.code_2_name') . ':') !!}
                        {!! Form::text('code_label_2', $business->code_label_2, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_2', __('lang_v1.code_2') . ':') !!}
                        {!! Form::text('code_2', $business->code_2, ['class' => 'form-control']); !!}
                    </div>
                </div>
            </div>
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
            </div>
            <div class="row hide">
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