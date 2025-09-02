@php
  $link_class = $link_class ?? ''; 
@endphp


<a href="{{ action('UserController@getProfile') }}" class="{{ $link_class }} {{ request()->segment(2) == 'profile' ? 'active' : '' }}">@lang('lang_v1.my_profile')</a>
@if(!empty($app_settings->two_factor_settings['enable_2fa']))
<a href="{{ action('Auth\TwoFactorController@setup_2fa_form') }}" class="{{ $link_class }} {{ request()->segment(2) == 'setup' ? 'active' : '' }}">@lang('settings.2fa')</a>
@endif
@if((auth()->user()->two_factor_enabled) == 1 && !empty($app_settings->two_factor_settings['enable_2fa']))
    <a href="{{ action('Auth\TwoFactorController@recovery_code_index') }}" class="{{ $link_class }} {{ request()->segment(2) == 'recovery-code' ? 'active' : '' }}">
        @lang('settings.2fa_recovery_codes')
    </a>
@endif
