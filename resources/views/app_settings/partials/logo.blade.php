@php
    $logoData = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
    $logoLight = $logoData['light'] ?? null;
    $logoDark  = $logoData['dark'] ?? null;
    $favicon   = $logoData['favicon'] ?? null;
@endphp

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('app_logo_light', __('lang_v1.upload_light_logo') . ':') !!}
            @show_tooltip(__('settings.logo_light_tooltip'))
            {!! Form::file('app_logo_light', ['accept' => 'image/*']) !!}
            @if(!empty($logoLight))
                <div style="margin-top:10px;">
                    <img src="{{ upload_asset('uploads/app_logos/' . $logoLight) }}" alt="Light Logo" style="max-width:100%;">
                </div>
            @endif
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('app_logo_dark', __('lang_v1.upload_dark_logo') . ':') !!}
            @show_tooltip(__('settings.logo_dark_tooltip'))
            {!! Form::file('app_logo_dark', ['accept' => 'image/*']) !!}
            @if(!empty($logoDark))
                <div style="margin-top:10px;">
                    <img src="{{ upload_asset('uploads/app_logos/' . $logoDark) }}" alt="Dark Logo" style="max-width:100%;">
                </div>
            @endif
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('app_favicon', __('settings.upload_favicon') . ':') !!}
            @show_tooltip(__('settings.favicon_tooltip'))
            {!! Form::file('app_favicon', ['accept' => 'image/*']) !!}
            @if(!empty($favicon))
                <div style="margin-top:10px;">
                    <img src="{{ upload_asset('uploads/app_logos/' . $favicon) }}" alt="Favicon" style="width:32px;height:32px;">
                </div>
            @endif
        </div>
    </div>
</div>
