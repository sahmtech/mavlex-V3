<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @php
    $business          = session('business');
    $theme             = $app_settings->theme_settings ?? [];
    $primaryColor      = $theme['primary_color']       ?? '#FFB600';
    $secondaryColor    = $theme['secondary_color']     ?? '#011530';
    $sidebarTextColor  = $theme['sidebar_text_color']  ?? '#FFF';
    $bodyColor         = $theme['body_color']          ?? '#F8F9FF';

    if (!empty($business)  && !empty($business['theme_color'])  && !empty($app_settings->theme_settings['enable_theme_change'])) 
    {
        $theme_colors = json_decode($business['theme_color'], true);
        $primaryColor     = $theme_colors['primary']           ?? $primaryColor;
        $secondaryColor   = $theme_colors['secondary']         ?? $secondaryColor;
        $sidebarTextColor = $theme_colors['sidebar_text_color'] ?? $sidebarTextColor;
        $bodyColor        = $theme_colors['body_color']         ?? $bodyColor;
    }
@endphp
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @if(!empty($favicon))
    <link rel="icon" href="{{ upload_asset('uploads/app_logos/' . $favicon) }}" type="image/png">
@endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'POS') }}</title> 
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --body-color: {{$bodyColor}};
            --sidebar-text: {{$sidebarTextColor}}
        }
    </style>
    @include('layouts.partials.css')

</head>

<body class="hold-transition">
<div class="login-layout">
<div class="auth-logo" style="margin-top:50px;">
    @php
    $app_logo = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
    $logo_light = $app_logo['light'] ?? null;
@endphp

@if($logo_light)
    <img src="{{ upload_asset('uploads/app_logos/' . $logo_light) }}" alt="logo">
@else
    <div class="logo-text">
        {{ config('app.name', 'BardPOS') }}
    </div>
@endif
        </div>

   

    
    @yield('content')

    
</div>
</body>

</html>