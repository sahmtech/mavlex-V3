@php
    $enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
    $is_mobile = isMobile();
@endphp


<div class="storys-container">
    <a class="navbar-brand" href="{{action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index'])}}">
        <i class="fa fas fa-users-cog"></i> {{__('superadmin::lang.superadmin')}}
    </a>
        
        <a href="{{action([Modules\Superadmin\Http\Controllers\BusinessController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'business' ? 'active' : '' }}">@lang('superadmin::lang.all_business')</a>
        
        <a href="{{action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'superadmin-subscription' ? 'active' : '' }}">@lang('superadmin::lang.subscription')</a>
        
        <a href="{{action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'packages' ? 'active' : '' }}"> @lang('superadmin::lang.subscription_packages')</a>
        
        <a href="{{action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'coupons' ? 'active' : '' }}"> @lang('superadmin::lang.all_coupons')</a>
       
        <a href="{{action([\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class, 'edit'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'settings' ? 'active' : '' }}"> @lang('superadmin::lang.super_admin_settings')</a>
        
        <a href="{{action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'superadmin' && request()->segment(2) == 'communicator' ? 'active' : '' }}">  @lang('superadmin::lang.communicator')</a>
        
</div>

