@inject('request', 'Illuminate\Http\Request')

@php
    $pos_layout = true;
@endphp
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

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}">
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
        <script type="text/javascript">
            if(localStorage.getItem("upos_sidebar_collapse") == 'true'){
                var body = document.getElementsByTagName("body")[0];
                body.className += " sidebar-collapse";
            }
        </script>

        @include('layouts.partials.header-restaurant')

        <div class="kitchen-wrapper">
            <!-- Add currency related field-->
            <input type="hidden" id="__code" value="{{session('currency')['code']}}">
            <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
            <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
            <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
            <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">

            <input type="hidden" id="__orders_refresh_interval" value="{{config('constants.orders_refresh_interval', 600)}}">
            <!-- End of currency related field-->

            @if (session('status'))
                <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
            @endif
            @yield('content')
            @if(config('constants.iraqi_selling_price_adjustment'))
                <input type="hidden" id="iraqi_selling_price_adjustment">
            @endif

            <!-- This will be printed -->
            <section class="invoice print_section" id="receipt_section">
            </section>
                
            @include('home.todays_profit_modal')
            <!-- /.content-wrapper -->

            

        </div>

        @include('layouts.partials.javascripts')
        <script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
        <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
    </body>

</html>