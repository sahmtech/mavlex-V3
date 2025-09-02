


@inject('request', 'Illuminate\Http\Request')
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
    $logoData = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
    $favicon   = $logoData['favicon'] ?? null;
@endphp
@php
    $whitelist = ['127.0.0.1', '::1'];
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}" class="no-transition">
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

        <title>@yield('title') - {{ Session::get('business.name') }}</title>
        <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --body-color: {{$bodyColor}};
            --sidebar-text: {{$sidebarTextColor}}
        }
        </style>
        @include('layouts.partials.css')

        @yield('css')


    </head>

    <body>
        <!-- Add currency related field-->
        <input type="hidden" id="__code" value="{{ session('currency')['code'] }}">
        <input type="hidden" id="__symbol" value="{{ session('currency')['symbol'] }}">
        <input type="hidden" id="__thousand" value="{{ session('currency')['thousand_separator'] }}">
        <input type="hidden" id="__decimal" value="{{ session('currency')['decimal_separator'] }}">
        <input type="hidden" id="__symbol_placement" value="{{ session('business.currency_symbol_placement') }}">
        <input type="hidden" id="__precision" value="{{ session('business.currency_precision', 2) }}">
        <input type="hidden" id="__quantity_precision" value="{{ session('business.quantity_precision', 2) }}">
        <!-- End of currency related field-->
       

                        @yield('content')
                   
            

            @if(!empty($__additional_html))
                {!! $__additional_html !!}
            @endif

            @include('layouts.partials.javascripts')

            <div class="modal fade view_modal" tabindex="-1" role="dialog" 
            aria-labelledby="gridSystemModalLabel"></div>



            @if(!empty($__additional_views) && is_array($__additional_views))
                @foreach($__additional_views as $additional_view)
                    @includeIf($additional_view)
                @endforeach
            @endif

            
    </body>

</html>
