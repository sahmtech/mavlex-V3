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
                <h1>@lang('lang_v1.notification_template')</h1>
                <p>@lang('lang_v1.supplier_notifications')</p>
            </div>

            <div class="form-group">
                <select name="" id="page">
                     @foreach($supplier_notifications as $key => $value)
                        <option value="cn_{{$key}}" @if($loop->index == 0) selected="selected" @endif>{{$value['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {!! Form::open(['url' => action('NotificationTemplateController@store'), 'method' => 'post' ]) !!}

        @foreach($supplier_notifications as $key => $value)
            <div style="display: none;" @if($loop->index == 0) show @endif" id="ccn_{{$key}}">
                <div class="notification-template-tags">
                     @if(!empty($value['extra_tags']))
                        <strong>@lang('lang_v1.available_tags'):</strong>
                        @include('notification_template.partials.tags', ['tags' => $value['extra_tags']])
                    
                    @endif
                    @if(!empty($value['help_text']))
                    <span>{{$value['help_text']}}</span>
                    @endif
                </div>

                <div class="notication-template-subject-info">
                    <div class="info-wrapper">
                        <div class="label-box">
                            {!! Form::label($key . '_subject',
                            __('lang_v1.email_subject').':') !!}
                        </div>

                        {!! Form::text('template_data[' . $key . '][subject]', 
                            $value['subject'], ['class' => 'subject-form'
                            , 'placeholder' => __('lang_v1.email_subject'), 'id' => $key . '_subject']); !!}
                    </div>

                    <div class="info-wrapper">
                        <div class="label-box">
                            {!! Form::label($key . '_cc',
                            'CC:') !!}
                        </div>

                        {!! Form::email('template_data[' . $key . '][cc]', 
                            $value['cc'], ['class' => 'subject-form'
                            , 'placeholder' => 'CC', 'id' => $key . '_cc']); !!}
                    </div>

                    <div class="info-wrapper">
                        <div class="label-box">
                            {!! Form::label($key . '_bcc',
                            'BCC:') !!}
                        </div>

                        {!! Form::email('template_data[' . $key . '][bcc]', 
                            $value['bcc'], ['class' => 'subject-form'
                            , 'placeholder' => 'BCC', 'id' => $key . '_bcc']); !!}
                    </div>
                </div>
                
                <div class="notification-template-body">
                    <div class="title">
                        <span>{!! Form::label($key . '_email_body',
                            __('lang_v1.email_body').':') !!}</span>
                    </div>

                    <div class="content-box">
                        {!! Form::textarea('template_data[' . $key . '][email_body]', 
                            $value['email_body'], ['class' => 'form-control ckeditor'
                            , 'placeholder' => __('lang_v1.email_body'), 'id' => $key . '_email_body', 'rows' => 6]); !!}
                    </div>
                </div>

                <div class="notification-template-tags">
                    <strong>
                    @lang('lang_v1.sms_body'):
                    </strong>
                </div>

                <div class="notification-template-body">
                    <div class="content-box">
                        {!! Form::textarea('template_data[' . $key . '][sms_body]', 
                        $value['sms_body'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.sms_body'), 'id' => $key . '_sms_body', 'rows' => 6]); !!}
                    </div>
                </div>

                <div class="notification-template-tags">
                    <strong>
                    @lang('lang_v1.whatsapp_text'):
                    </strong>
                </div>

                <div class="notification-template-body">
                    <div class="content-box">
                        {!! Form::textarea('template_data[' . $key . '][whatsapp_text]', 
                        $value['whatsapp_text'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.whatsapp_text'), 'id' => $key . '_whatsapp_text', 'rows' => 6]); !!}
                    </div>
                </div>

            </div>
            
        @endforeach

        <div class="notification-template-alert">
        @lang('lang_v1.logo_not_work_in_sms'):
        </div>

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

     $(document).ready( function() {
        $('#ccn_new_order').show();
        $('#page').on('change', function() {
            var target = $(this).find(":selected").val();
            if ( target == 'cn_new_order') {
                 $('#ccn_new_order').show();
                 $('#ccn_payment_paid').hide();
                 $('#ccn_items_received').hide();
                 $('#ccn_items_pending').hide();
             } else if (target == 'cn_payment_paid') {
                $('#ccn_new_order').hide();
                $('#ccn_payment_paid').show();
                $('#ccn_items_received').hide();
                $('#ccn_items_pending').hide();
             } else if (target == 'cn_items_received') {
                $('#ccn_new_order').hide();
                $('#ccn_payment_paid').hide();
                $('#ccn_items_received').show();
                $('#ccn_items_pending').hide();
             } else if (target == 'cn_items_pending') {
                $('#ccn_new_order').hide();
                $('#ccn_payment_paid').hide();
                $('#ccn_items_received').hide();
                $('#ccn_items_pending').show();
             } else {
                $('#ccn_new_order').show();
             }
         });
     });
</script>
@endsection