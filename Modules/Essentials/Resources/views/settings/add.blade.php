@extends('layouts.app')
@section('title', __('essentials::lang.essentials_n_hrm_settings'))

@section('css')
    <style type="text/css">
        .crm-setting-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 0.75rem;
  margin-top: 1.5rem;
}

@media (max-width: 768px){
  div.pos-tab-menu {
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;
    width: 100%!important;
  }

  .crm-setting-grid .crm-settings-wrapper {
    background: #ffffff;
    box-shadow: 0px 3px 17px rgb(0 0 0 / 12%);
    width: 100%;
    height: fit-content;
    border-radius: 5px;
  }

  .col-xs-4 {
    width: 100%;
  }
  
  .col-xs-6 {
    width: 100%;
  }
}
    </style>
@endsection

@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('essentials::layouts.nav_hrm')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('messages.settings')</h1>
                <p>{{__('essentials::lang.hrm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

        <div class="crm-setting-grid">
            <div class="hrm-setting-flex">
                <!-- Settings Submenu -->
                <div class="settings-submenu">
                    <a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsSettingsController@edit')}}" class="link {{ request()->segment(1) == 'hrm' && request()->segment(2) == 'settings' ? 'active' : '' }}">@lang('business.settings')</a>
                    @can('essentials.crud_leave_type')
                        <a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController@index')}}" class="link {{ request()->segment(2) == 'leave-type' ? 'active' : '' }}">@lang('essentials::lang.leave_type')</a>
                    @endcan
                     
                    <a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsHolidayController@index')}}" class="link {{ request()->segment(2) == 'holiday' ? 'active' : '' }}">@lang('essentials::lang.holiday')</a>
                    @can('essentials.crud_department')
                    <a href="{{action('TaxonomyController@index') . '?type=hrm_department'}}" class="link {{ request()->get('type') == 'hrm_department' ? 'active' : '' }}">@lang('essentials::lang.departments')</a>

                    @endcan

                    @can('essentials.crud_designation')
                    <a href="{{action('TaxonomyController@index') . '?type=hrm_designation'}}" class="link {{ request()->get('type') == 'hrm_designation' ? 'active' : '' }}">@lang('essentials::lang.designations')</a>
                    @endcan

                    @if(auth()->user()->can('essentials.access_sales_target'))
                    <a href="{{action('\Modules\Essentials\Http\Controllers\SalesTargetController@index')}}" class="link {{ request()->segment(1) == 'hrm' && request()->segment(2) == 'sales-target' ? 'active' : '' }}">@lang('essentials::lang.sales_target')</a>
                        
                    @endif
                    
                </div>

                <!-- content -->
                <div class="crm-settings-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['action' => '\Modules\Essentials\Http\Controllers\EssentialsSettingsController@update', 'method' => 'post', 'id' => 'essentials_settings_form']) !!}
                    <div class="row">
                        <div class="col-xs-12">
                           <!--  <pos-tab-container> -->
                            <div class="col-xs-12 pos-tab-container">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item text-center active">@lang('essentials::lang.leave')</a>
                                        <a href="#" class="list-group-item text-center">@lang('essentials::lang.payroll')</a>
                                        <a href="#" class="list-group-item text-center">@lang('essentials::lang.attendance')</a>
                                        <a href="#" class="list-group-item text-center">@lang('essentials::lang.sales_target')</a>
                                        <a href="#" class="list-group-item text-center">@lang('essentials::lang.essentials')</a>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                                    @include('essentials::settings.partials.leave_settings')
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                                    @include('essentials::settings.partials.payroll_settings')
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                                    @include('essentials::settings.partials.attendance_settings')
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                                    @include('essentials::settings.partials.sales_target_settings')
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                                    @include('essentials::settings.partials.essentials_settings')
                                </div>
                            </div>

                            <!--  </pos-tab-container> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group pull-right">
                                    {{Form::submit(__('messages.update'), ['class'=>"btn btn-danger"])}}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            </div>
                        </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('javascript')
@endsection