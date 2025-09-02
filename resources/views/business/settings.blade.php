@extends('layouts.app')
@section('title', __('business.business_settings'))

@section('content')

<div class="main-container no-print">
<div class="horizontal-scroll">
    <div class="storys-container">
    @include('layouts.partials.sub_menu.misc', ['link_class' => 'sub-menu-item'])
</div>
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('business.settings')</h1>
            </div>
        </div>

        <div class="setting-three-grid">
            <div class="setting-option">
                <a href="{{ url('business/business-settings') }}">
                    <h4>@lang('lang_v1.business')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/product-settings') }}">
                    <h4>@lang('lang_v1.product')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/sales-settings') }}">
                    <h4>@lang('lang_v1.sales')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/pos-settings') }}">
                    <h4>@lang('lang_v1.pos')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/purchases-settings') }}">
                    <h4>@lang('lang_v1.purchases')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/stock-transfer-settings') }}">
                    <h4>@lang('lang_v1.stock_transfer')</h4>
                </a>
            </div>

            
            <div class="setting-option">
                <a href="{{ url('business/email-settings') }}">
                    <h4>@lang('lang_v1.email')</h4>
                </a>
            </div>

            @canany('send_notifications')
            <div class="setting-option">
                <a  href="{{action('NotificationTemplateController@index')}}">
                    <h4>@lang('lang_v1.notification_template')</h4>
                </a>
            </div>
            @endcanany

            <div class="setting-option">
                <a href="{{ url('business/contact-settings') }}">
                    <h4>@lang('lang_v1.contact')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/tax-settings') }}">
                    <h4>@lang('lang_v1.tax')</h4>
                </a>
            </div>

            @canany('invoice_settings.access')
            
            <div class="setting-option">
                <a href="{{ action('InvoiceSchemeController@index') }}">
                    <h4>@lang('invoice.invoice_design')</h4>
                </a>
            </div>
            @endcanany

            <div class="setting-option">
                <a href="{{ url('business/custom-label-settings') }}">
                    <h4>@lang('lang_v1.custom_labels')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/apperance-settings') }}">
                    <h4>@lang('lang_v1.appearance')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/sms-settings') }}">
                    <h4>@lang('lang_v1.sms')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/modules-settings') }}">
                    <h4>@lang('lang_v1.modules')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/prefixes-settings') }}">
                    <h4>@lang('lang_v1.prefixes')</h4>
                </a>
            </div>

            <div class="setting-option">
                <a href="{{ url('business/reward-points-settings') }}">
                    <h4>@lang('lang_v1.reward_points')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/dashboard-settings') }}">
                    <h4>@lang('lang_v1.dashboard')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/restaurant-settings') }}">
                    <h4>@lang('lang_v1.restaurant')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('/barcodes') }}">
                    <h4>@lang('barcode.barcodes')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('/printers') }}">
                    <h4>@lang('printer.printers')</h4>
                </a>
            </div>
            <div class="setting-option">
                <a href="{{ url('business/customer-display') }}">
                    <h4>@lang('lang_v1.customer_display')</h4>
                </a>
            </div>
            @if(Module::has('Accounting'))
            <div class="setting-option">
                <a href="{{action([\Modules\Accounting\Http\Controllers\SettingsController::class, 'index'])}}">
                    <h4>@lang('accounting::lang.accounting')</h4>
                </a>
            </div>
            @endif
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