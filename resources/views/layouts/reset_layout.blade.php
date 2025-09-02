<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(!empty($favicon))
    <link rel="icon" href="{{ upload_asset('uploads/app_logos/' . $favicon) }}" type="image/png">
@endif
    <title>Login</title>
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --body-color: {{$bodyColor}};
            --sidebar-text: {{$sidebarTextColor}}
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- font awesome -->
</head>
<body>


    <div class="login-layout">

        <div class="auth-logo">
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

        <div class="form-content">

            {{-- <h3 class="auth-text-heading">Login to your account
            </h3>

            <form action="">
                <div class="input-wrapper">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>

                <div class="input-wrapper">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="password-switch">
                    <button id="show-password" type="button">
                        <img src="asset/img/icons/eye.png" alt="">
                    </button>
                </div>

                <a href="#" class="forget-password">Forget Password?</a>

                <div class="button-wrapper">
                    <button>Sign In</button>
                </div>
            </form>

            <div class="form-footer">
                <p>New to {{ env('APP_NAME') }}? <a href="#">Create an Account</a></p>
            </div> --}}

            @yield('content')
            
        </div>
        

    </div>
    
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>