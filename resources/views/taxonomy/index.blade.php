@extends('layouts.app')
@php
    $heading = !empty($module_category_data['heading']) ? $module_category_data['heading'] : __('category.categories');
    $navbar = !empty($module_category_data['navbar']) ? $module_category_data['navbar'] : null;
@endphp
@section('title', $heading)

@section('content')
@if(!empty($navbar))
    
@endif

@php
    $can_add = true;
    if(request()->get('type') == 'product' && !auth()->user()->can('category.create')) {
        $can_add = false;
    }
@endphp

<div class="main-container no-print">
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
        @if(request()->get('type') == 'product')
            @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
        @endif
        @if(!empty($navbar))
            @include($navbar)
        @endif
        </div>
    </div>

    

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{$heading }}</h1>
                <p>{{ $module_category_data['sub_heading'] ?? __( 'category.manage_your_categories' ) }}</p>
            </div>

            <div class="filter">
                <div class="new-user">
                 @if($can_add)
                    <button type="button" class="btn-modal  btn-block btn-primary" 
                        data-href="{{action('TaxonomyController@create')}}?type={{request()->get('type')}}" 
                        data-container=".category_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                @endif
            </div>
            </div>
            
        </div>
        <!-- End of Filter through table -->

        @if(request()->get('type') == 'source' || request()->get('type') == 'life_stage' || request()->get('type') == 'followup_category')

                <div class="content">
                @php
                    $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
                @endphp
                <input type="hidden" id="category_type" value="{{request()->get('type')}}">
                

                @can('category.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="category_table">
                            <thead>
                                <tr>
                                    <th>@if(!empty($module_category_data['taxonomy_label'])) {{$module_category_data['taxonomy_label']}} @else @lang( 'category.category' ) @endif</th>
                                    @if($cat_code_enabled)
                                        <th>{{ $module_category_data['taxonomy_code_label'] ?? __( 'category.code' )}}</th>
                                    @endif
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>


        @elseif(request()->get('type') == 'hrm_department' || request()->get('type') == 'hrm_designation')
            <div class="crm-setting-grid">
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
            <div class="crm-settings-wrapper" style="height: auto;">

                <div class="content">
                @php
                    $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
                @endphp
                <input type="hidden" id="category_type" value="{{request()->get('type')}}">
                

                @can('category.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="category_table">
                            <thead>
                                <tr>
                                    <th>@if(!empty($module_category_data['taxonomy_label'])) {{$module_category_data['taxonomy_label']}} @else @lang( 'category.category' ) @endif</th>
                                    @if($cat_code_enabled)
                                        <th>{{ $module_category_data['taxonomy_code_label'] ?? __( 'category.code' )}}</th>
                                    @endif
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>
            </div>
        </div>
        @else

            <div class="content">
                @php
                    $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
                @endphp
                <input type="hidden" id="category_type" value="{{request()->get('type')}}">
                

                @can('category.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="category_table">
                            <thead>
                                <tr>
                                    <th>@if(!empty($module_category_data['taxonomy_label'])) {{$module_category_data['taxonomy_label']}} @else @lang( 'category.category' ) @endif</th>
                                    @if($cat_code_enabled)
                                        <th>{{ $module_category_data['taxonomy_code_label'] ?? __( 'category.code' )}}</th>
                                    @endif
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>
        @endif

        <div class="modal fade category_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@stop
@section('javascript')
@includeIf('taxonomy.taxonomies_js')
@endsection
