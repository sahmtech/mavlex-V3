@extends('layouts.app')
@section('title', __('essentials::lang.holiday'))

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
                <h1>@lang('essentials::lang.holiday')
                </h1>
                <p> {{__('essentials::lang.hrm')}}  </p>
            </div>
            <div class="filter">
            <div class="new-user">
                 @if($is_admin)
                    <button type="button" class="add-user-modal-btn btn-modal btn-primary" data-href="{{action('\Modules\Essentials\Http\Controllers\EssentialsHolidayController@create')}}" data-container="#add_holiday_modal">
                                <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>     
                @endif                
            </div>
        
            <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                        <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                       
                    </a>
            </div>
        </div>
        @component('components.filters', ['title' => __('report.filters'), 'class' => 'box-solid', 'closed' => true])
        <div class="col-md-3">
                <div class="form-box">
                      {!! Form::select('location_id', $locations, null, ['id' => 'location_id', 'class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
                  </div>
        </div>
                  <div class="col-md-3">
                  <div class="form-box">
                      {!! Form::text('holiday_filter_date_range', null, ['id' => 'holiday_filter_date_range', 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                  </div>
                  </div>
        @endcomponent

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
                        <table class="table max-table" id="holidays_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'lang_v1.name' )</th>
                                    <th>@lang( 'lang_v1.date' )</th>
                                    <th>@lang( 'business.business_location' )</th>
                                    <th>@lang( 'brand.note' )</th>
                                    @if($is_admin)
                                        <th>@lang( 'messages.action' )</th>
                                    @endif
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
</div>
<!-- /.content -->
<div class="modal fade" id="add_holiday_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            holidays_table = $('#holidays_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{action([\Modules\Essentials\Http\Controllers\EssentialsHolidayController::class, 'index'])}}",
                    "data" : function(d) {
                        d.location_id = $('#location_id').val();
                        if($('#holiday_filter_date_range').val()) {
                            var start = $('#holiday_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            var end = $('#holiday_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                        }
                    }
                },
                @if($is_admin)
                columnDefs: [
                    {
                        targets: 4,
                        orderable: false,
                        searchable: false,
                    },
                ],
                @endif
                columns: [
                    { data: 'name', name: 'essentials_holidays.name' },
                    { data: 'start_date', name: 'start_date'},
                    { data: 'location', name: 'bl.name' },
                    { data: 'note', name: 'note'},
                    @if($is_admin)
                    { data: 'action', name: 'action' },
                    @endif
                ],
            });

            $('#holiday_filter_date_range').daterangepicker(
                dateRangeSettings,
                function (start, end) {
                    $('#holiday_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                }
            );
            $('#holiday_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#holiday_filter_date_range').val('');
                holidays_table.ajax.reload();
            });

            $(document).on( 'change', '#holiday_filter_date_range, #location_id', function() {
                holidays_table.ajax.reload();
            });

            $('#add_holiday_modal').on('shown.bs.modal', function(e) {
                $('#add_holiday_modal .select2').select2();

                $('form#add_holiday_form #start_date, form#add_holiday_form #end_date').datepicker({
                    autoclose: true,
                });
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

        $(document).on('click', 'button.delete-holiday', function() {
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();

                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                holidays_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    </script>
@endsection
