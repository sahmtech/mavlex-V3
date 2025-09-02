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
                <h1>@lang('business.sale')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}
           {!! Form::hidden('is_sales_setting', 1) !!}

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('default_sales_discount', __('business.default_sales_discount') . ':*') !!}
                        {!! Form::text('default_sales_discount', @num_format($business->default_sales_discount), ['class' => 'form-control input_number']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('default_sales_tax', __('business.default_sales_tax') . ':') !!}
                        {!! Form::select('default_sales_tax', $tax_rates, $business->default_sales_tax, ['class' => 'form-control select2','placeholder' => __('business.default_sales_tax'), 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
        <!-- <div class="clearfix"></div> -->

                {{--<div class="col-sm-12 hide">
                    <div class="form-group">
                        {!! Form::label('sell_price_tax', __('business.sell_price_tax') . ':') !!}
                        <div class="input-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sell_price_tax" value="includes" 
                                    class="input-icheck" @if($business->sell_price_tax == 'includes') {{'checked'}} @endif> Includes the Sale Tax
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sell_price_tax" value="excludes" 
                                    class="input-icheck" @if($business->sell_price_tax == 'excludes') {{'checked'}} @endif>Excludes the Sale Tax (Calculate sale tax on Selling Price provided in Add Purchase)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('item_addition_method', __('lang_v1.sales_item_addition_method') . ':') !!}
                        {!! Form::select('item_addition_method', [ 0 => __('lang_v1.add_item_in_new_row'), 1 =>  __('lang_v1.increase_item_qty')], $business->item_addition_method, ['class' => 'form-control select2', 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('amount_rounding_method', __('lang_v1.amount_rounding_method') . ':') !!} @show_tooltip(__('lang_v1.amount_rounding_method_help'))
                        {!! Form::select('pos_settings[amount_rounding_method]', 
                        [ 
                            '1' =>  __('lang_v1.round_to_nearest_whole_number'), 
                            '0.05' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.05]), 
                            '0.1' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.1]),
                            '0.5' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.5])
                        ], 
                        !empty($pos_settings['amount_rounding_method']) ? $pos_settings['amount_rounding_method'] : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.none')]); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                             {!! Form::hidden('pos_settings[enable_msp]', 0) !!}
                            <label class="switch" for="enable_msp">
                               
                                {!! Form::checkbox('pos_settings[enable_msp]', 1,  
                        !empty($pos_settings['enable_msp']) ? true : false , 
                    [ 'id' => 'enable_msp']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.sale_price_is_minimum_sale_price' ) }}</p>@show_tooltip(__('lang_v1.minimum_sale_price_help'))
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            
                                {!! Form::hidden('pos_settings[allow_overselling]', 0) !!}
                            <label class="switch" for="allow_overselling">
                                {!! Form::checkbox('pos_settings[allow_overselling]', 1,  
                                !empty($pos_settings['allow_overselling']) ? true : false , 
                            [ 'id' => 'allow_overselling']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.allow_overselling' ) }}</p>@show_tooltip(__('lang_v1.allow_overselling_help'))
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            
                                {!! Form::hidden('pos_settings[enable_sales_order]', 0) !!}
                            <label class="switch" for="enable_sales_order">
                                {!! Form::checkbox('pos_settings[enable_sales_order]', 1, !empty($pos_settings['enable_sales_order']) , [ 'id' => 'enable_sales_order', 'id' => 'enable_sales_order']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_sales_order' ) }}</p>@show_tooltip(__('lang_v1.sales_order_help_text'))
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            
                                {!! Form::hidden('pos_settings[is_pay_term_required]', 0) !!}
                            <label class="switch" for="is_pay_term_required">
                                {!! Form::checkbox('pos_settings[is_pay_term_required]', 1, !empty($pos_settings['is_pay_term_required']) , ['id' => 'is_pay_term_required']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.is_pay_term_required' ) }}</p>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12"><h4>@lang('lang_v1.commission_agent'):</h4></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('sales_cmsn_agnt', __('lang_v1.sales_commission_agent') . ':') !!}
                        {!! Form::select('sales_cmsn_agnt', $commission_agent_dropdown, $business->sales_cmsn_agnt, ['class' => 'form-control select2', 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('cmmsn_calculation_type', __('lang_v1.cmmsn_calculation_type') . ':') !!}
                        {!! Form::select('pos_settings[cmmsn_calculation_type]', ['invoice_value' => __('lang_v1.invoice_value'), 'payment_received' => __('lang_v1.payment_received')], !empty($pos_settings['cmmsn_calculation_type']) ? $pos_settings['cmmsn_calculation_type'] : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'cmmsn_calculation_type']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            
                                {!! Form::hidden('pos_settings[is_commission_agent_required]', 0) !!}
                            <label class="switch" for="is_commission_agent_required">
                                {!! Form::checkbox('pos_settings[is_commission_agent_required]', 1, !empty($pos_settings['is_commission_agent_required']) , ['id' => 'is_commission_agent_required']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.is_commission_agent_required' ) }}</p>
                        </div>
                    </div>
                </div>
            </div>
                </div>
          
            <div class="row" >
                <div class="col-sm-12 mobile">
                    <button class="btn btn-danger pull-right" type="submit">@lang('business.update_settings')</button>
                </div>
            </div>
        {!! Form::close() !!}
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