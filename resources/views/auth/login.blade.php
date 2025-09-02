@extends('layouts.auth')
@section('title', __('lang_v1.login'))

@section('content')
@php
$username = old('username');
$password = null;
if(config('app.env') == 'demo'){
$username = 'superadmin';
$password = '123456';

$demo_types = array(
'all_in_one' => 'admin',
'super_market' => 'admin',
'pharmacy' => 'admin-pharmacy',
'electronics' => 'admin-electronics',
'services' => 'admin-services',
'restaurant' => 'admin-restaurant',
'superadmin' => 'superadmin',
'woocommerce' => 'woocommerce_user',
'essentials' => 'admin-essentials',
'manufacturing' => 'manufacturer-demo',
);

if( !empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types) ){
$username = $demo_types[$_GET['demo_type']];
}
}
@endphp
@if(config('app.env') == 'demo')

@endif
<div class="auth-container {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<style> 
.show_hide_icon {
    position: absolute;
    top: 25px;
    background-color: transparent;
    border: none;
    cursor: pointer;
}
.ltr .show_hide_icon {
    right: 5px;
}
.rtl .show_hide_icon {
    left: 5px;
}


</style>  
@if(config('app.env') == 'demo')
<div class="form-content demo-shops">
    <h4 class="text-center">Demo Shops<br> <small><i> Demos are for example purpose only, this application <u>can be used in many other similar businesses.</u></i></small></h4>

    <a href="?demo_type=all_in_one" class="demo-button bg-olive" data-toggle="tooltip" title="Showcases all feature available in the application." data-admin="{{$demo_types['all_in_one']}}">
        <i class="fas fa-star"></i> All In One
    </a>

    <a href="?demo_type=pharmacy" class="demo-button bg-maroon" data-toggle="tooltip" title="Shops with products having expiry dates." data-admin="{{$demo_types['pharmacy']}}">
        <i class="fas fa-medkit"></i> Pharmacy
    </a>

    <a href="?demo_type=services" class="demo-button bg-orange" data-toggle="tooltip" title="For all service providers like Web Development, Restaurants, Repairing, Plumber, Salons, Beauty Parlors etc." data-admin="{{$demo_types['services']}}">
        <i class="fas fa-wrench"></i> Multi-Service Center
    </a>

    <a href="?demo_type=electronics" class="demo-button bg-purple" data-toggle="tooltip" title="Products having IMEI or Serial number code." data-admin="{{$demo_types['electronics']}}">
        <i class="fas fa-laptop"></i> Electronics & Mobile Shop
    </a>

    <a href="?demo_type=super_market" class="demo-button bg-navy" data-toggle="tooltip" title="Super market & Similar kind of shops." data-admin="{{$demo_types['super_market']}}">
        <i class="fas fa-shopping-cart"></i> Super Market
    </a>

    <a href="?demo_type=restaurant" class="demo-button bg-red" data-toggle="tooltip" title="Restaurants, Salons and other similar kind of shops." data-admin="{{$demo_types['restaurant']}}">
        <i class="fas fa-utensils"></i> Restaurant
    </a>
</div>
@endif
<div class="form-content login-form">
<h3 class="auth-text-heading">@lang('lang_v1.login_to_your_account')</h3>

<form method="POST" action="{{ route('login') }}" id="login-form">
    {{ csrf_field() }}
    <div class="input-wrapper">
        <label for="username">@lang('lang_v1.username')</label>
        <input id="username" type="text" name="username" value="{{ $username }}" required autofocus>
    </div>
    @if ($errors->has('username'))
    <div class="input-error">
        <strong>{{ $errors->first('username') }}</strong>
    </div>
    @endif


    <div class="input-wrapper">
        <label for="password">@lang('lang_v1.password')</label>
        <input id="password" type="password" class="password-switch" name="password" value="{{ $password }}" required>
        <button type="button" id="show_hide_icon" class="show_hide_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            </svg>
        </button>

    </div>
    @if ($errors->has('password'))
    <div class="input-error">
        <strong>{{ $errors->first('password') }}</strong>
    </div>
    @endif


   
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                {!! Form::hidden('remember', 0) !!}
                <label class="switch" for="remember">
                    {!! Form::checkbox('remember', 1,false, ['id' => 'remember']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __('lang_v1.remember_me') }}</p>
            </div>
        </div>
    
    <a href="{{ route('password.request') }}" class="forget-password">@lang('lang_v1.forgot_your_password') </a>
    @if(isset($app_settings->google_recaptcha['enable_recaptcha']) && $app_settings->google_recaptcha['enable_recaptcha'])
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ $app_settings->google_recaptcha['google_recaptcha_key'] }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </div>
        </div>
    </div>
    @endif

    <div class="button-wrapper">
        <button type="submit">@lang('lang_v1.login')</button>
        @if(config('app.env') != 'demo')

        @endif
    </div>
</form>

<div class="form-footer">
    <p>@lang('lang_v1.new_to') {{ env('APP_NAME') }}? <a href="{{route('business.getRegister')}}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">@lang('lang_v1.create_an_account')</a></p>
</div>
@if($app_settings)
@php
    $social_logins = $app_settings->social_logins ? json_decode($app_settings->social_logins, true) : [];

    $providers = [
        'facebook'  => 'facebook',
        'x'         => 'x-twitter',
        'linkedin'  => 'linkedin',
        'google'    => 'google',
        'github'    => 'github',
        'gitlab'    => 'gitlab',
        'bitbucket' => 'bitbucket',
        'slack'     => 'slack',
        'twitch'    => 'twitch'
    ];

    $enabled_providers = [];
    foreach($providers as $key => $cssClass) {
        if(isset($social_logins[$key]['enabled']) && $social_logins[$key]['enabled']) {
            $enabled_providers[] = [
                'provider' => $key,
                'css'      => $cssClass
            ];
        }
    }

    $count = count($enabled_providers);
    if ($count === 1) {
        $width = '100%';
    } elseif ($count === 2) {
        $width = '50%';
    } else {
        $width = '30%';
    }
@endphp
@if($count > 0)
<div class="social-login-divider">
    <span>@lang('settings.or_login_with')</span>
</div>
@endif
<div class="social-login-list" style="flex-wrap: {{ $count >= 3 ? 'wrap' : 'nowrap' }};">
    @foreach($enabled_providers as $item)
        @php
            $provider = $item['provider'];
            $cssClass = $item['css'];
        @endphp
        <a href="{{ route('social.login', $provider) }}" 
           class="social-login-btn {{ $cssClass }}"
           style="width: {{ $width }};">
            @if($provider === 'x')
                <i class="fab fa-twitter"></i> X
            @elseif($provider === 'facebook')
                <i class="fab fa-facebook"></i> Facebook
            @elseif($provider === 'linkedin')
                <i class="fab fa-linkedin"></i> LinkedIn
            @elseif($provider === 'google')
                <i class="fab fa-google"></i> Google
            @elseif($provider === 'github')
                <i class="fab fa-github"></i> GitHub
            @elseif($provider === 'gitlab')
                <i class="fab fa-gitlab"></i> GitLab
            @elseif($provider === 'bitbucket')
                <i class="fab fa-bitbucket"></i> Bitbucket
            @elseif($provider === 'slack')
                <i class="fab fa-slack"></i> Slack
            @elseif($provider === 'twitch')
                <i class="fab fa-twitch"></i> Twitch
            @endif
        </a>
    @endforeach
</div>
@endif
<style>
.social-login-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
    }
    .social-login-divider::before,
    .social-login-divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #ccc;
        margin: 0 10px;
    }
    .social-login-divider span {
        font-weight: 500;
        color: #555;
    }
    .social-login-list {
        display: flex;
        gap: 10px;
        max-width: 500px; 
        margin: 0 auto;
        justify-content: center;
    }
    
    .social-login-btn {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #ffffff;
        padding: 10px 15px;
        border-radius: 999px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        font-size: 0.95rem;
        justify-content: center;
    }
    
    .social-login-btn i {
        margin-right: 8px;
        font-size: 1.2rem;
    }
    
    .facebook {
        background-color: #3b5998;
    }
    .facebook:hover {
        background-color: #2d4373;
    }
    
    .x-twitter {
        background-color: #1da1f2;
    }
    .x-twitter:hover {
        background-color: #0c93dd;
    }
    
    .linkedin {
        background-color: #0077b5;
    }
    .linkedin:hover {
        background-color: #005f93;
    }
    
    .google {
        background-color: #db4437;
    }
    .google:hover {
        background-color: #c33c2a;
    }
    
    .github {
        background-color: #333;
    }
    .github:hover {
        background-color: #222;
    }
    
    .gitlab {
        background-color: #fc6d26;
    }
    .gitlab:hover {
        background-color: #e55a0b;
    }
    
    .bitbucket {
        background-color: #205081;
    }
    .bitbucket:hover {
        background-color: #163a5e;
    }
    
    .slack {
        background-color: #611f69;
    }
    .slack:hover {
        background-color: #4a154b;
    }
    
    .twitch {
        background-color: #6441a5;
    }
    .twitch:hover {
        background-color: #4b3180;
    }
</style>

</div>


@if(config('app.env') == 'demo')
<div class="form-content demo-modules">
    <h4 class="text-center">Premium Modules<small><i> Premium optional modules</i></small></h4>

    <a href="?demo_type=superadmin" class="demo-button bg-red-active" data-toggle="tooltip" title="SaaS & Superadmin extension Demo" data-admin="{{$demo_types['superadmin']}}">
        <i class="fas fa-university"></i> SaaS / Superadmin
    </a>

    <a href="?demo_type=woocommerce" class="demo-button bg-woocommerce" data-toggle="tooltip" title="WooCommerce demo user - Open web shop in minutes!!" style="color:white !important" data-admin="{{$demo_types['woocommerce']}}">
        <i class="fab fa-wordpress"></i> WooCommerce
    </a>

    <a href="?demo_type=essentials" class="demo-button bg-navy" data-toggle="tooltip" title="Essentials & HRM (human resource management) Module Demo" style="color:white !important" data-admin="{{$demo_types['essentials']}}">
        <i class="fas fa-check-circle"></i> Essentials & HRM
    </a>

    <a href="?demo_type=manufacturing" class="demo-button bg-orange" data-toggle="tooltip" title="Manufacturing module demo" style="color:white !important" data-admin="{{$demo_types['manufacturing']}}">
        <i class="fas fa-industry"></i> Manufacturing Module
    </a>

    <a href="?demo_type=superadmin" class="demo-button bg-maroon" data-toggle="tooltip" title="Project module demo" style="color:white !important" data-admin="{{$demo_types['superadmin']}}">
        <i class="fas fa-project-diagram"></i> Project Module
    </a>

    <a href="?demo_type=services" class="demo-button bg-maroon" data-toggle="tooltip" title="Advance repair module demo" style="color:white !important; background-color: #bc8f8f" data-admin="{{$demo_types['services']}}">
        <i class="fas fa-wrench"></i> Advance Repair Module
    </a>


    <a href="https://bardpos.com" target="_blank" class="demo-button bg-blue" data-toggle="tooltip" title="More Modules" style="color:white !important;">
        <i class="fas fa-arrow-right"></i> View More
    </a>
</div>
@endif
</div>

@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('#show_hide_icon').off('click');
        $('.change_lang').click(function() {
            window.location = "{{ route('login') }}?lang=" + $(this).attr('value');
        });
        $('a.demo-login').click(function(e) {
            e.preventDefault();
            $('#username').val($(this).data('admin'));
            $('#password').val("{{ $password }}");
            $('form#login-form').submit();
        });

        $('#show_hide_icon').on('click', function(e) {
            e.preventDefault();
            const passwordInput = $('#password');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                $('#show_hide_icon').html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"/>
            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"/>
            <path d="M3 3l18 18"/>
        </svg>
    `);
            } else if (passwordInput.attr('type') === 'text') {
                passwordInput.attr('type', 'password');
                $('#show_hide_icon').html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
        </svg>
    `);
            }

        });
    })
</script>
@endsection