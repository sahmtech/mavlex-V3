<div class="storys-container">


    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{action([\Modules\Essentials\Http\Controllers\DashboardController::class, 'hrmDashboard'])}}"><i class="fa fas fa-users"></i> {{__('essentials::lang.hrm')}}</a>
    </div>


    @can('essentials.crud_leave_type')
    <a href="{{action([\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'leave-type' ? 'active' : '' }}">@lang('essentials::lang.leave_type')</a>
    @endcan
    @can('essentials.crud_all_leave', 'essentials.crud_own_leave')
<a href="{{action([\Modules\Essentials\Http\Controllers\EssentialsLeaveController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'leave' ? 'active' : '' }}">@lang('essentials::lang.leave')</a>
@endcan

@can('essentials.crud_all_attendance', 'essentials.view_own_attendance')
<a href="{{action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'attendance' ? 'active' : '' }}">@lang('essentials::lang.attendance')</a>
@endcan

<a href="{{action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'payroll' ? 'active' : '' }}">@lang('essentials::lang.payroll')</a>

<a href="{{action([\Modules\Essentials\Http\Controllers\EssentialsHolidayController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'holiday' ? 'active' : '' }}">@lang('essentials::lang.holiday')</a>

@can('essentials.crud_department')
<a href="{{action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=hrm_department'}}" class="sub-menu-item {{ request()->get('type') == 'hrm_department' ? 'active' : '' }}">@lang('essentials::lang.departments')</a>
@endcan

@can('essentials.crud_designation')
<a href="{{action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=hrm_designation'}}" class="sub-menu-item {{ request()->get('type') == 'hrm_designation' ? 'active' : '' }}">@lang('essentials::lang.designations')</a>
@endcan

@if(auth()->user()->can('essentials.access_sales_target'))
<a href="{{action([\Modules\Essentials\Http\Controllers\SalesTargetController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'hrm' && request()->segment(2) == 'sales-target' ? 'active' : '' }}">@lang('essentials::lang.sales_target')</a>
@endif

@if(auth()->user()->can('edit_essentials_settings'))
<a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsSettingsController@edit')}}" class="sub-menu-item {{ request()->segment(1) == 'hrm' && request()->segment(2) == 'settings' ? 'active' : '' }}">@lang('business.settings')</a>
@endif



</div>