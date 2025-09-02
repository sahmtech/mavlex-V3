@extends('layouts.app')
@section('title', __('lang_v1.notification_templates'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.notification', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <div class="setting-card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.notification_templates')</h1>
                <p>@lang('lang_v1.auto_message_settings')</p>
            </div>

            
        </div>
        {!! Form::open(['url' => action('NotificationTemplateController@store'), 'method' => 'post' ]) !!}
        {!! Form::hidden('auto_settings', true) !!}
        @foreach($customer_notifications as $key => $value)

           
                <h3 style="color: #111827; font-size: 20px; font-weight: 600; margin-top: 12px;">{{ ucfirst(str_replace('_', ' ', $key)) }}</h3>

                    <div class="setting-three-grid" style="border-bottom: 1px solid #D2D5DA; padding-bottom: 24px; margin-top: 0;">

                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="{{ $key . 'auto_send' }}">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send]', 1, $value['auto_send'], ['id' => $key . 'auto_send']); !!} 
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>@lang('lang_v1.autosend_email')</p>
                        </div>

                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="{{ $key . 'auto_send_sms' }}">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send_sms]', 1, $value['auto_send_sms'], ['id' => $key . 'auto_send_sms']); !!} 
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>@lang('lang_v1.autosend_sms')</p>
                        </div>

                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="{{ $key . 'auto_send_wa_notif' }}">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send_wa_notif]', 1, $value['auto_send_wa_notif'], ['id' => $key . 'auto_send_wa_notif']); !!} 
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>@lang('lang_v1.auto_send_wa_notif')</p>
                        </div>
                        
                    </div>

                    @if($key == 'payment_reminder')
                        <div class="notification-template-tags">
                            <span>@lang('lang_v1.payment_reminder_help')</span>
                        </div>
                    @elseif($key == 'new_sale')
                         <div class="notification-template-tags">
                            <span>@lang('lang_v1.new_sale_notification_help')</span>
                        </div>
                    @endif
            
        @endforeach

        <div class="footer">
            <div class="footer-btn">
                <button type="submit" class="primary-btn">@lang('messages.save')</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
    $('textarea.ckeditor').each( function(){
        var editor_id = $(this).attr('id');
        tinymce.init({
            selector: 'textarea#'+editor_id,
        });
    });
</script>
@endsection