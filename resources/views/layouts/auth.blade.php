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
    if($app_settings){
    $logoData = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
    $favicon   = $logoData['favicon'] ?? null;
    }
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

    <title>@yield('title') - {{ config('app.name', 'POS') }}</title>
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --body-color: {{$bodyColor}};
            --sidebar-text: {{$sidebarTextColor}}
        }
        .login-layout {
                background: var(--secondary-color);
                background-repeat: no-repeat;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;            
        }
    </style>
        @if( $app_settings && $app_settings->login_bg_image && $app_settings->login_bg_image_url)
        <style>
            .login-layout {
                background-image: url('{{ upload_asset('uploads/bg_images/' . $app_settings->login_bg_image_url) }}');
            }
        </style>
        @endif


    @include('layouts.partials.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('stylesheet')
    <script src='https://www.google.com/recaptcha/api.js'></script>
   
</head>

<body>
   
    <div class="login-layout">
        @if (!isset($no_header))
        @include('layouts.partials.header-auth')
        @endif

        <!-- logo -->
        <div class="auth-logo">
            @php
            $app_logo_data = $app_settings ? $app_settings->app_logo : null;
            $app_logo = $app_logo_data ? json_decode($app_logo_data, true) : [];
        
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
        @if (session('status'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
        @endif

        @yield('content')

    </div>


    @include('layouts.partials.javascripts')
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2_register').select2();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('dark-mode-toggle');
            const html = document.documentElement;
            const isLoginPage = window.location.pathname.includes('login');
            if (isLoginPage) {
                html.classList.remove('dark-mode');
            } else {
                if (toggle) {
                    if (localStorage.getItem('dark-mode') === 'true') {
                        html.classList.add('dark-mode');
                        toggle.checked = true;
                    } else {
                        html.classList.remove('dark-mode');
                        toggle.checked = false;
                    }

                    toggle.addEventListener('change', function() {
                        if (toggle.checked) {
                            html.classList.add('dark-mode');
                            localStorage.setItem('dark-mode', 'true');
                        } else {
                            html.classList.remove('dark-mode');
                            localStorage.setItem('dark-mode', 'false');
                        }
                    });
                }
            }
            // Remove no-transition class after DOM is fully loaded
            html.classList.remove('no-transition');
        });
    </script>

<script>
    document.querySelector('.menu-button').addEventListener('click', function() {
        this.classList.toggle('active');
        document.querySelector('.dropdown-menu').classList.toggle('active');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.change_lang').click(function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('lang', $(this).attr('value'));
            window.location.href = currentUrl.toString();
        });
    });
</script>
</body>

</html>