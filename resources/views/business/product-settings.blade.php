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
                <h1>@lang('business.product')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}

           {!! Form::hidden('is_product_setting', 1) !!}
            
           <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('sku_prefix', __('business.sku_prefix') . ':') !!}
                 {!! Form::text('sku_prefix', $business->sku_prefix, ['class' => 'form-control text-uppercase']); !!}
            </div>
        </div>
        
        <div class="col-sm-4">
            {!! Form::label('enable_product_expiry', __( 'product.enable_product_expiry' ) . ':') !!}
            @show_tooltip(__('lang_v1.tooltip_enable_expiry'))

            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox('enable_product_expiry', 1, $business->enable_product_expiry ); !!} 
                </span>

                <select class="form-control" id="expiry_type"
                    name="expiry_type" 
                    @if(!$business->enable_product_expiry) disabled @endif>
                    <option value="add_expiry" @if($business->expiry_type == 'add_expiry') selected @endif>
                        {{__('lang_v1.add_expiry')}}
                    </option>
                  <option value="add_manufacturing" @if($business->expiry_type == 'add_manufacturing') selected @endif>{{__('lang_v1.add_manufacturing_auto_expiry')}}</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4 @if(!$business->enable_product_expiry) hide @endif" id="on_expiry_div">
            <div class="form-group">
                <div class="multi-input">
                    {!! Form::label('on_product_expiry', __('lang_v1.on_product_expiry') . ':') !!}
                    @show_tooltip(__('lang_v1.tooltip_on_product_expiry'))
                    <br>

                    {!! Form::select('on_product_expiry',     ['keep_selling'=>__('lang_v1.keep_selling'), 'stop_selling'=>__('lang_v1.stop_selling') ], $business->on_product_expiry, ['class' => 'form-control pull-left', 'style' => 'width:60%;']); !!}

                    @php
                        $disabled = '';
                        if($business->on_product_expiry == 'keep_selling'){
                            $disabled = 'disabled';
                        }
                    @endphp

                    {!! Form::number('stop_selling_before', $business->stop_selling_before, ['class' => 'form-control pull-left', 'placeholder' => 'stop n days before', 'style' => 'width:40%;', $disabled, 'required', 'id' => 'stop_selling_before']); !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        <label class="switch" for="checkbox">
                            {!! Form::checkbox('enable_brand', 1, $business->enable_brand, 
                    [ 'id' => 'checkbox']); !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_brand' ) }}</p>
                    </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_category">
                        {!! Form::checkbox('enable_category', 1, $business->enable_category, ['id' => 'enable_category']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_category' ) }}</p>
                </div>

            </div>
        </div>

        <div class="col-sm-4 enable_sub_category @if($business->enable_category != 1) hide @endif">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_sub_category">
                        {!! Form::checkbox('enable_sub_category', 1, $business->enable_sub_category, ['id' => 'enable_sub_category']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_sub_category' ) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_price_tax">
                        {!! Form::checkbox('enable_price_tax', 1, $business->enable_price_tax, [ 'id' => 'enable_price_tax']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_price_tax' ) }}</p>
                </div>
            </div>
        </div>

      
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_sub_units">
                        {!! Form::checkbox('enable_sub_units', 1, $business->enable_sub_units, [ 'id' => 'enable_sub_units']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_sub_units' ) }}</p>@show_tooltip(__('lang_v1.sub_units_tooltip'))
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_racks">
                        {!! Form::checkbox('enable_racks', 1, $business->enable_racks, [ 'id' => 'enable_racks']); !!} 
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_racks' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_racks'))
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_preparation_time_in_minutes">
                        {!! Form::checkbox('enable_preparation_time_in_minutes', 1, $business->enable_preparation_time_in_minutes, [ 'id' => 'enable_preparation_time_in_minutes']); !!} 
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_preparation_time_in_minutes' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_preparation_time_in_minutes'))
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_row">
                        {!! Form::checkbox('enable_row', 1, $business->enable_row, [ 'id' => 'enable_row']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_row' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_position">
                        {!! Form::checkbox('enable_position', 1, $business->enable_position, [ 'id' => 'enable_position']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_position' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_product_image">
                        {!! Form::checkbox('enable_product_image', 1, $business->enable_product_image, [ 'id' => 'enable_product_image']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_product_image' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_product_description">
                        {!! Form::checkbox('enable_product_description', 1, $business->enable_product_description, [ 'id' => 'enable_product_description']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_product_description' ) }}</p>
                </div>
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
        
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_unit', __('lang_v1.default_unit') . ':') !!}
                {!! Form::select('default_unit', $units_dropdown, $business->default_unit, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('product_barcode_type', __('product.barcode_type') . ':') !!}
                {!! Form::select('product_barcode_type', $barcodes_dropdown, $business->product_barcode_type, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('product_link_location', __('Product Link Location') . ':') !!}
                {!! Form::select('product_link_location', $business_locations, $business->product_link_location, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
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