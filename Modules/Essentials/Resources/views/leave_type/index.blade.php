@extends('layouts.app')
@section('title', __('essentials::lang.essentials_n_hrm_settings'))
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
                <h1>@lang('essentials::lang.leave_type')</h1>
                <p>{{__('essentials::lang.hrm')}}</p>
            </div>

            <div class="filter">
                
            </div>

            <div class="new-user">
                <button type="button" class="add-user-modal-btn" data-toggle="modal" data-target="#add_leave_type_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>

        </div>
        <!-- End of Filter through table -->

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
            <div class="crm-settings-wrapper">  
                <div class="content">
                    <div class="table-responsive">
                        <table class="table max-table" id="leave_type_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'essentials::lang.leave_type' )</th>
                                    <th>@lang( 'essentials::lang.max_leave_count' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                

                @include('essentials::leave_type.create')
                    </div>
        </div>
    </div>
</div>

@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready( function(){

            leave_type_table = $('#leave_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController@index')}}",
                columnDefs: [
                    {
                        targets: 2,
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

        });

        $(document).on('submit', 'form#add_leave_type_form, form#edit_leave_type_form', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div#add_leave_type_modal').modal('hide');
                        $('.view_modal').modal('hide');
                        toastr.success(result.msg);
                        leave_type_table.ajax.reload();
                        $('form#add_leave_type_form')[0].reset();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        })
    </script>
@endsection
