
@php
    $svc = app(\App\Services\AppSettingsService::class);
    $svc->autoDisableIfTimerExpired();
@endphp
@if ($svc->maintenance_enabled() && ! auth()->user()?->can('superadmin'))
    @include('errors.maintenance_mode')
    @php exit; @endphp
@endif

@inject('request', 'Illuminate\Http\Request')

@if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit'))
@php
$pos_layout = true;
@endphp
@else
@php
$pos_layout = false;
@endphp
@endif
@php
    $business          = session('business');
    $theme             = $app_settings->theme_settings ?? [];
    $primaryColor      = $theme['primary_color']       ?? '#FFB600';
    $secondaryColor    = $theme['secondary_color']     ?? '#011530';
    $sidebarTextColor  = $theme['sidebar_text_color']  ?? '#FFFFF';
    $bodyColor         = $theme['body_color']          ?? '#F8F9FF';
    if (!empty($business)  && !empty($business['theme_color'])  && !empty($app_settings->enable_theme_change)) 
    {
        $theme_colors = json_decode($business['theme_color'], true);
        $primaryColor     = $theme_colors['primary']           ?? $primaryColor;
        $secondaryColor   = $theme_colors['secondary']         ?? $secondaryColor;
        $sidebarTextColor = $theme_colors['sidebar_text_color'] ?? $sidebarTextColor;
        $bodyColor        = $theme_colors['body_color']         ?? $bodyColor;
    }
    if($app_settings){
    $logoData = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
    $favicon   = $logoData['favicon'] ?? null;
    }
    $isDarkMode = isset($_COOKIE['dark-mode']) && $_COOKIE['dark-mode'] === 'true';
    $whitelist = ['127.0.0.1', '::1'];
    $sidebar_layout      = $app_settings->sidebar_layout      ?? 'layout1';
    $custom_sidebar_type = $app_settings->custom_sidebar_type ?? 'sidebar';   
    if (isMobile() && $sidebar_layout === 'custom' && $custom_sidebar_type === 'topbar') {
        $custom_sidebar_type = 'sidebar';
    }
    view()->share([
        'sidebar_layout'         => $sidebar_layout,
        'custom_sidebar_type'    => $custom_sidebar_type,
    ]);
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ in_array(session('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr' }}"
      class="{{ $isDarkMode ? 'dark-mode' : '' }} no-transition">
      
<head>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    @if(!empty($favicon))
        <link rel="icon" href="{{ upload_asset('uploads/app_logos/' . $favicon) }}" type="image/png">
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    (function() {
        var isAuthenticated = window.isAuthenticated || true; 
        if (isAuthenticated && localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.add('dark-mode');
        }
    })();
    </script>
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --body-color: {{$bodyColor}};
            --sidebar-text: {{$sidebarTextColor}}
        }
    </style>
    <title>@yield('title') - {{ Session::get('business.name') }}</title>
    @livewireStyles
    @include('layouts.partials.css')
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css?v=' . $asset_v) }}">
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
    @if(!$pos_layout)
    <div class="container grid">
        <script type="text/javascript">
            if (localStorage.getItem("bpos_sidebar_collapse") == 'true') {
                var body = document.getElementsByTagName("body")[0];
                body.className += " sidebar-collapse";
            }
        </script>
        <script type="text/javascript">
            if (localStorage.getItem("dark_mode") === 'true') {
              var html = document.getElementsByTagName("html")[0];
              html.className += " dark_mode";
            }
          </script>
        @switch($sidebar_layout)
        @case('layout1')
            {{-- Sidebar Layout 1 --}}
            @include('layouts.partials.sidebar')
        @break
        @case('layout2')
            {{-- Sidebar Layout 2 --}}
            @include('layouts.partials.sidebar_v2')
        @break
        @case('custom')
            @if($custom_sidebar_type === 'sidebar')
                {{-- Custom layout rendered as sidebar --}}
                @include('menus.partials.sidebar')
            @endif
        @break
        @endswitch

        @if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
        <input type="hidden" id="__is_localhost" value="true">
        @endif

        <!-- Content Wrapper. Contains page content -->
        <!-- <div class="@if(!$pos_layout) main @endif"> -->
        <main>
            @include('layouts.partials.header')
            @if($sidebar_layout === 'custom' && $custom_sidebar_type === 'topbar')
            <link rel="stylesheet" href="{{ asset('css/topbar.css?v=' . $asset_v) }}">
            @include('menus.partials.topbar')
            <script src="{{ asset('js/topbar.js?v=' . $asset_v) }}"></script>      
            
            @endif
            <!-- empty div for vuejs -->
            <div id="app">
                @yield('vue')
            </div>

            @can('view_export_buttons')
            <input type="hidden" id="view_export_buttons">
            @endcan
            @if(isMobile())
            <input type="hidden" id="__is_mobile">
            @endif
            @if (session('status'))
            <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
            @endif
            @yield('content')
            @include('layouts.partials.footer')
            <div class='scrolltop no-print'>
                <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
            </div>

            @if(config('constants.iraqi_selling_price_adjustment'))
            <input type="hidden" id="iraqi_selling_price_adjustment">
            @endif

            <!-- This will be printed -->
            <section class="invoice print_section" id="receipt_section">
            </section>

        </main>
        @include('home.todays_profit_modal')
       
        <!-- /.content-wrapper -->
    </div>

    <!-- Sticky POS button -->
    <div class="pos-mobile-button no-print">
        <a href="{{action('SellPosController@create')}}" title="@lang('sale.pos_sale')" data-toggle="tooltip" data-placement="bottom" class="pos">
           <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 21.5V16.1C15 15.5399 15 15.2599 14.891 15.046C14.7951 14.8578 14.6422 14.7049 14.454 14.609C14.2401 14.5 13.9601 14.5 13.4 14.5H10.6C10.0399 14.5 9.75992 14.5 9.54601 14.609C9.35785 14.7049 9.20487 14.8578 9.10899 15.046C9 15.2599 9 15.5399 9 16.1V21.5M3 7.5C3 9.15685 4.34315 10.5 6 10.5C7.65685 10.5 9 9.15685 9 7.5C9 9.15685 10.3431 10.5 12 10.5C13.6569 10.5 15 9.15685 15 7.5C15 9.15685 16.3431 10.5 18 10.5C19.6569 10.5 21 9.15685 21 7.5M6.2 21.5H17.8C18.9201 21.5 19.4802 21.5 19.908 21.282C20.2843 21.0903 20.5903 20.7843 20.782 20.408C21 19.9802 21 19.4201 21 18.3V6.7C21 5.5799 21 5.01984 20.782 4.59202C20.5903 4.21569 20.2843 3.90973 19.908 3.71799C19.4802 3.5 18.9201 3.5 17.8 3.5H6.2C5.0799 3.5 4.51984 3.5 4.09202 3.71799C3.71569 3.90973 3.40973 4.21569 3.21799 4.59202C3 5.01984 3 5.57989 3 6.7V18.3C3 19.4201 3 19.9802 3.21799 20.408C3.40973 20.7843 3.71569 21.0903 4.09202 21.282C4.51984 21.5 5.07989 21.5 6.2 21.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>

            <span>@lang( 'lang_v1.pos' )</span>
        </a>
    </div>
    <!-- End of sticky POS button -->
    @else
    <div id="coverScreen" class="LockOn" style="display: none;">
    </div>
    <div class="pos-wrapper">

        @include('layouts.partials.header-pos')

        <div class="pos-content">
            @yield('content')

        </div>

        <!-- Suspended Payment view -->
        <div class="suspended-payment-wrapper togglepay no-print " id='pending-payment' style="display: none;"></div>
        <!-- End of Suspended Payment view -->
    </div>
    @endif
    <audio id="success-audio">
        <source src="{{ asset('/audio/success.ogg?v=' . $asset_v) }}" type="audio/ogg">
        <source src="{{ asset('/audio/success.mp3?v=' . $asset_v) }}" type="audio/mpeg">
    </audio>
    <audio id="error-audio">
        <source src="{{ asset('/audio/error.ogg?v=' . $asset_v) }}" type="audio/ogg">
        <source src="{{ asset('/audio/error.mp3?v=' . $asset_v) }}" type="audio/mpeg">
    </audio>
    <audio id="warning-audio">
        <source src="{{ asset('/audio/warning.ogg?v=' . $asset_v) }}" type="audio/ogg">
        <source src="{{ asset('/audio/warning.mp3?v=' . $asset_v) }}" type="audio/mpeg">
    </audio>
    @if(!empty($__additional_html))
    {!! $__additional_html !!}
    @endif

    @include('layouts.partials.javascripts')

    <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
   {{-- 2FA Recommend modal --}}
    @if(!empty($app_settings->two_factor_settings['enable_2fa']) && $app_settings->two_factor_settings['enable_2fa'] === '1' && !empty($app_settings->two_factor_settings['recommend_2fa']) && $app_settings->two_factor_settings['recommend_2fa'] === '1' && isset($app_settings->two_factor_settings['force_2fa']) && $app_settings->two_factor_settings['force_2fa'] === false && !Auth::user()->two_factor_enabled && !session('recommended_2fa'))
    @include('user.2fa_verification_modal')
    @endif

    @if(!empty($__additional_views) && is_array($__additional_views))
    @foreach($__additional_views as $additional_view)
    @includeIf($additional_view)
    @endforeach
    @endif

    @livewireScripts
</body>

</html>