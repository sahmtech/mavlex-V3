@extends('layouts.app')
@section('title', __('essentials::lang.sales_target'))

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
                <h1>@lang('essentials::lang.sales_target')
                </h1>
                <p> {{__('essentials::lang.hrm')}}  </p>
            </div>

            <div class="filter">
                   
            </div>
        </div>

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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table max-table" id="sales_target_table">
                                    <thead>
                                        <tr>
                                            <th>@lang( 'report.user' )</th>
                                            <th>@lang( 'messages.action' )</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

<!-- /.content -->
<div class="modal fade" id="set_sales_target_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            sales_target_table = $('#sales_target_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{action([\Modules\Essentials\Http\Controllers\SalesTargetController::class, 'index'])}}"
                },
                columns: [
                    { data: 'full_name', name: 'full_name' },
                    { data: 'action', name: 'action' },
                ],
            });

            $(document).on('submit', 'form#add_holiday_form', function(e) {
                e.preventDefault();
                $(this).find('button[type="submit"]').attr('disabled', true);
                var data = $(this).serialize();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div#add_holiday_modal').modal('hide');
                            toastr.success(result.msg);
                            holidays_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });

        $(document).on('click', '#add_target', function(e) {
            $('#target_table tbody').append($('#sales_target_row_hidden tbody').html());
        });
        $(document).on('click', '.remove_target', function(e) {
            $(this).closest('tr').remove();
        });
    </script>
@endsection
