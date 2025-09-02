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
            <section class="content">
                @include('layouts.partials.search_settings')
                <div class="clearfix"></div>
                <hr>
                {!! Form::open(['url' => action([\App\Http\Controllers\BusinessController::class,
                'postBusinessSettings']), 'method' => 'post', 'id' => 'bussiness_edit_form','files' => true ]) !!}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 pos-tab-container tabs">
                            <!-- Left side menu -->
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pos-tab-menu">
                                <div class="list-group">
                                    <a href="#"
                                        class="list-group-item  active">@lang('business.business')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('business.tax')
                                        @show_tooltip(__('tooltip.business_tax'))</a>
                                    <a href="#"
                                        class="list-group-item">@lang('business.product')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('contact.contact')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('business.sale')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('sale.pos_sale')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('purchase.purchases')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.payment')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('business.dashboard')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.appearance')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.prefixes')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.email_settings')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.sms_settings')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.reward_point_settings')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.modules')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.custom_labels')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.customer_display')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.restaurant_settings')</a>
                                    <a href="#"
                                        class="list-group-item">@lang('lang_v1.stock_transfer')</a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pos-tab tab-content-wrapper">
                                <!-- tab 1 start -->
                                @include('business.settings_v2.partials.business-settings')

                                <!-- tab 1 end -->
                                <!-- tab 2 start -->
                                @include('business.settings_v2.partials.tax-settings')
                                <!-- tab 2 end -->
                                <!-- tab 3 start -->
                                @include('business.settings_v2.partials.product-settings')

                                @include('business.settings_v2.partials.contact-settings')
                                <!-- tab 3 end -->
                                <!-- tab 4 start -->
                                @include('business.settings_v2.partials.sales-settings')
                                @include('business.settings_v2.partials.pos-settings')
                                <!-- tab 4 end -->
                                <!-- tab 5 start -->
                                @include('business.settings_v2.partials.purchases-settings')

                                @include('business.settings_v2.partials.payment-settings')
                                <!-- tab 5 end -->
                                <!-- tab 6 start -->
                                @include('business.settings_v2.partials.dashboard-settings')
                                <!-- tab 6 end -->
                                <!-- tab 7 start -->
                                @include('business.settings_v2.partials.apperance-settings')
                                <!-- tab 7 end -->
                                <!-- tab 8 start -->
                                @include('business.settings_v2.partials.prefixes-settings')
                                <!-- tab 8 end -->
                                <!-- tab 9 start -->
                                @include('business.settings_v2.partials.email-settings')
                                <!-- tab 9 end -->
                                <!-- tab 10 start -->
                                @include('business.settings_v2.partials.sms-settings')
                                <!-- tab 10 end -->
                                <!-- tab 11 start -->
                                @include('business.settings_v2.partials.reward-points-settings')
                                <!-- tab 11 end -->
                                <!-- tab 12 start -->
                                @include('business.settings_v2.partials.modules-settings')
                                <!-- tab 12 end -->
                                <!-- tab 13 start -->
                                @include('business.settings_v2.partials.custom-label-settings')
                                <!-- tab 12 end -->
                                <!-- tab 13 start -->
                                @include('business.settings_v2.partials.customer-display')
                                <!-- tab 13 end -->
                                <!-- tab 14 start -->
                                @include('business.settings_v2.partials.restaurant-settings')
                                <!-- tab 14 end -->
                                <!-- tab 15 start -->
                                @include('business.settings_v2.partials.stock-transfer-settings')
                                <!-- tab 15 end -->
                            </div>
                           
                            
                        </div>
                        <!--  </pos-tab-container> -->
                    </div>
                </div>
                 <div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary btn-big save-btn" type="submit">
                            <i class="fa fa-save"></i> @lang('settings.update_settings')
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </section>
            <!-- /.content -->
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

    $(document).ready(function(){

    
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
                url: "{{ action([\App\Http\Controllers\BusinessController::class, 'testEmailConfiguration']) }}",
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
                url: "{{ action([\App\Http\Controllers\BusinessController::class, 'testSmsConfiguration']) }}",
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

        $('select.custom_labels_products').change(function(){
            value = $(this).val();
            textarea = $(this).parents('div.custom_label_product_div').find('div.custom_label_product_dropdown');
            if(value == 'dropdown'){
                textarea.removeClass('hide');
            } else{
                textarea.addClass('hide');
            }
        })
 
        var enable_restaurant_module = $('#enable_restaurant_module');
        var toggle_items = $('.toggle-item');

        function update_toggle_items() {
            var is_enabled = enable_restaurant_module.prop('checked');
            toggle_items.each(function() {
                $(this).css('display', is_enabled ? 'block' : 'none');
                // checkbox.prop('checked', is_enabled);
            });
        }

        enable_restaurant_module.change(update_toggle_items);
        update_toggle_items();
   


$(function(){
    $('.remove-toggle').each(function () {
        toggleInputState(this);
    });

    $(document).on('change', '.remove-toggle', function () {
        toggleInputState(this);
    });

    function toggleInputState(checkbox){
        const $cb   = $(checkbox);
        const $file = $('#' + $cb.data('target'));
        $file.prop('disabled', $cb.is(':checked'));
        const $thumb = $cb.closest('.row').find('img.img-thumbnail');
        $thumb.css('opacity', $cb.is(':checked') ? .35 : 1);
    }

    // Ensure unchecked checkboxes are sent as 0
    $('#business_settings_form').on('submit', function() {
        var form = this;
        
        // Handle regular checkboxes
        $('input[type="checkbox"]', form).each(function() {
            var $checkbox = $(this);
            var name = $checkbox.attr('name');
            
            // Skip if checkbox is checked or if hidden field already exists
            if ($checkbox.is(':checked') || $('input[type="hidden"][name="' + name + '"]', form).length > 0) {
                return;
            }
            
            // Add hidden field with 0 value for unchecked checkbox
            $('<input>').attr({
                type: 'hidden',
                name: name,
                value: '0'
            }).prependTo(form);
        });
        
        // Special handling for pos_settings array checkboxes
        var posCheckboxes = [
            'disable_pay_checkout', 'disable_draft', 'disable_express_checkout',
            'hide_product_suggestion', 'hide_recent_trans', 'disable_discount',
            'disable_order_tax', 'is_pos_subtotal_editable', 'disable_suspend',
            'enable_transaction_date', 'inline_service_staff', 'is_service_staff_required',
            'disable_credit_sale_button', 'show_invoice_scheme', 'show_invoice_layout',
            'print_on_suspend', 'show_pricing_on_product_sugesstion', 'show_product_qty',
            'show_price_check', 'enable_weighing_scale', 'disable_currency_exchange'
        ];
        
        posCheckboxes.forEach(function(field) {
            var checkboxName = 'pos_settings[' + field + ']';
            var $checkbox = $('input[name="' + checkboxName + '"]', form);
            
            if ($checkbox.length && !$checkbox.is(':checked') && $('input[type="hidden"][name="' + checkboxName + '"]', form).length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    name: checkboxName,
                    value: '0'
                }).prependTo(form);
            }
        });
    });
});
 });
</script>
@endsection