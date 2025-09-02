@php
$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
$link_class = $link_class ?? ''; 
@endphp



  {{-- Settings and Modules Links --}}
  @canany(['business_settings.access', 'barcode_settings.access', 'invoice_settings.access', 'tax_rate.view', 'tax_rate.create'])
  <a href="{{ action('BusinessController@getSettings') }}"
    class="{{ $link_class }} {{ request()->segment(2) == 'settings' ? 'active' : '' }}">
    <span>@lang('lang_v1.settings')</span>
  </a>

  <a href="{{ url('business/modules-settings') }}"
    class="{{ $link_class }} {{ request()->segment(2) == 'modules-settings' ? 'active' : '' }}">
    <span>@lang('lang_v1.modules')</span>
  </a>
  @endcanany

  {{-- Business Locations Link --}}
  @canany(['business_settings.access', 'barcode_settings.access', 'invoice_settings.access', 'tax_rate.view', 'tax_rate.create', 'access_package_subscriptions'])
  <a href="{{ action('BusinessLocationController@index') }}"
    class="{{ $link_class }} {{ request()->segment(1) == 'business-location' ? 'active' : '' }}">
    <span>@lang('business.business_locations')</span>
  </a>
  @endcanany

  {{-- Superadmin Subscription Link --}}
  @if(Module::has('Superadmin') && auth()->user()->can('access_package_subscriptions'))
  <a href="{{ url('subscription') }}"
    class="{{ $link_class }} {{ request()->segment(1) == 'subscription' ? 'active' : '' }}">
    <span>@lang('lang_v1.subscription')</span>
  </a>
  @endif

  @php
  $is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
  @endphp
  @if($is_admin)
  <a href="{{ action('ReportController@activityLog') }}" class="{{ $link_class }} {{ request()->segment(2) == 'activity-log' ? 'active' : '' }}">

    <span>@lang('lang_v1.activity_log')</span>
  </a>
  @endif
  @php
  $is_superadmin = auth()->user()->can('superadmin');
  @endphp

  @if($is_superadmin)
  <a href="{{ url('/manage-modules') }}" class="{{ $link_class }} {{ request()->segment(1) == 'manage-modules' ? 'active' : '' }}">
    <span>@lang('lang_v1.premium_modules')</span>
  </a>
  @endif

  {{-- Backup Link --}}
  @can('backup')
  <a href="{{ action([\App\Http\Controllers\BackUpController::class, 'index']) }}"
    class="{{ $link_class }} {{ request()->segment(1) == 'backup' ? 'active' : '' }}">
    <span>@lang('lang_v1.backup')</span>
  </a>
  @endcan