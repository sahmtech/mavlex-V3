@php
  $link_class = $link_class ?? ''; 
@endphp
<a href="{{ url('app/settings') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'settings' ? 'active' : '' }}">
<span>@lang('settings.app_settings')</span>
</a>
<a href="{{ url('app/locked-users') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'locked-users' ? 'active' : '' }}">
<span>@lang('settings.locked_users')</span>
</a>
@if($app_settings->force_email_verify == 1)
<a href="{{ url('app/otp-verification') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'otp-verification' ? 'active' : '' }}">
<span>@lang('settings.otp_verification')</span>
</a>
@endif
<a href="{{ url('app/menus') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'menus' ? 'active' : '' }}">
<span>@lang('settings.custom_menu')</span>
</a>
<a href="{{ url('app/migration') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'migration' ? 'active' : '' }}">
<span>@lang('settings.storage_migration')</span>
</a>
<a href="{{ url('app/session-management') }}"
class="{{ $link_class }} {{ request()->segment(2) == 'session-management' ? 'active' : '' }}">
<span>@lang('settings.session_management')</span>
</a>
{{-- DO NOT ENABLE FEATURE UNDER DEVELOPMENT --}}
{{-- <a href="{{ url('stock-rebuild/reset-mapping') }}"
class="{{ $link_class }} {{ request()->segment(1) == 'stock-rebuild' ? 'active' : '' }}">
<span>@lang('settings.reset_mapping')</span>
</a> --}}
