@extends('layouts.app')
@section('title', __('essentials::lang.payroll'))

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
                <h1>@lang('essentials::lang.payroll')
                    </h1>
                <p> {{__('essentials::lang.hrm')}}  </p>
            </div>
            <div class="filter">
                    
                    <div class="new-user">
                        @can('essentials.create_payroll')
                            <button id="payrollButton" type="button" class="add-user-modal-btn" data-toggle="modal" data-target="#payroll_modal">
                                    <i class="fa fa-plus"></i>
                                    @lang( 'messages.add' )
                            </button>
                        @endcan

                        @can('essentials.add_allowance_and_deduction')
                            <button id="pay_componentButton" style="display: none;" type="button" class="add-user-modal-btn btn-modal btn-primary" data-href="{{action('\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController@create')}}" data-container="#add_allowance_deduction_modal">
                                <i class="fa fa-plus"></i> @lang( 'messages.add' ) 
                            </button>  
                        @endcan
                    </div>
                    
                    <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                        <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                       
                    </a>
                </div>
        </div>
 @component('components.filters', ['title' => __('report.filters'), 'class' => 'box-solid', 'closed' => true])
                                    @can('essentials.view_all_payroll')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('user_id_filter', __('essentials::lang.employee') . ':') !!}
                                                {!! Form::select('user_id_filter', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('department_id', __('essentials::lang.department') . ':') !!}
                                                {!! Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('designation_id', __('essentials::lang.designation') . ':') !!}
                                                {!! Form::select('designation_id', $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                                            </div>
                                        </div>
                                    @endcan
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::label('location_id_filter',  __('purchase.business_location') . ':') !!}

                                                {!! Form::select('location_id_filter', $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
                                            </div>
                                        </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('month_year_filter', __( 'essentials::lang.month_year' ) . ':') !!}
                                            <div class="input-group">
                                                {!! Form::text('month_year_filter', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.month_year' ) ]); !!}
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endcomponent
 
        <div class="content">
            <div class="col-md-3 pull-right">
        <div class="form-box ">
                        <select name="" id="showType">
                            <option value="payroll">@lang('essentials::lang.all_payrolls')</option>
                            <option value="payroll_group">@lang('essentials::lang.all_payroll_groups')</option>
                            <option value="pay_component">@lang( 'essentials::lang.pay_components' )</option>
                        </select>
                    </div>
                    <br>
            </div>
            
                
            <div class="row" id="payroll_tab">
                
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table max-table" id="payrolls_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>@lang( 'essentials::lang.employee' )</th>
                                    <th>@lang( 'essentials::lang.department' )</th>
                                    <th>@lang( 'essentials::lang.designation' )</th>
                                    <th>@lang( 'essentials::lang.month_year' )</th>
                                    <th>@lang( 'purchase.ref_no' )</th>
                                    <th>@lang( 'sale.total_amount' )</th>
                                    <th>@lang( 'sale.payment_status' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>                                
                </div>
            </div>
        @can('essentials.view_all_payroll')
            <div class="row" id="payroll_group_tab" style="display: none;">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table max-table" id="payroll_group_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>@lang('essentials::lang.name')</th>
                                    <th>@lang('sale.status')</th>
                                    <th>@lang( 'sale.payment_status' )</th>
                                    <th>@lang('essentials::lang.total_gross_amount')</th>
                                    <th>@lang('lang_v1.added_by')</th>
                                    <th>@lang('business.location')</th>
                                    <th>@lang('lang_v1.created_at')</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        @endcan
        @if(auth()->user()->can('essentials.view_allowance_and_deduction') || auth()->user()->can('essentials.add_allowance_and_deduction'))
            <div class="row" id="pay_component_tab" style="display: none;">
                
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table max-table" id="ad_pc_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'lang_v1.type' )</th>
                                    <th>@lang( 'sale.amount' )</th>
                                    <th>@lang( 'essentials::lang.applicable_date' )</th>
                                    <th>@lang( 'essentials::lang.employee' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" id="user_leave_summary"></div>
        @endif

            @can('essentials.create_payroll')
                @includeIf('essentials::payroll.payroll_modal')
            @endcan
            <div class="modal fade" id="add_allowance_deduction_modal" tabindex="-1" role="dialog"
         aria-labelledby="gridSystemModalLabel"></div>
       
    </div>
    </div>
</div>


</section>
<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready( function(){
  $('#showType').on('change', function() {
            var target = $(this).find(":selected").val();
            if ( target == 'payroll') {
                $('#payroll_tab').show();
                $('#payroll_group_tab').hide();
                $('#pay_component_tab').hide();

                $('#payrollButton').show();
                $('#pay_componentButton').hide();
                
                
            } else if (target == 'payroll_group') {
                $('#payroll_tab').hide();
                $('#payroll_group_tab').show();
                payroll_group_table.ajax.reload(null, false);
                $('#pay_component_tab').hide();

                $('#payrollButton').hide();
                $('#pay_componentButton').hide();

            } else if (target == 'pay_component') {
                $('#payroll_tab').hide();
                $('#payroll_group_tab').hide();
                $('#pay_component_tab').show();
                ad_pc_table.ajax.reload(null, false);

                $('#payrollButton').hide();
                $('#pay_componentButton').show();

            }
        });
            payrolls_table = $('#payrolls_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index'])}}",
                    data: function (d) {
                        if ($('#user_id_filter').length) {
                            d.user_id = $('#user_id_filter').val();
                        }
                        if ($('#location_id_filter').length) {
                            d.location_id = $('#location_id_filter').val();
                        }
                        d.month_year = $('#month_year_filter').val();
                        if ($('#department_id').length) {
                            d.department_id = $('#department_id').val();
                        }
                        if ($('#designation_id').length) {
                            d.designation_id = $('#designation_id').val();
                        }
                    },
                },
                columnDefs: [
                    {
                        targets: 7,
                        orderable: false,
                        searchable: false,
                    },
                ],
                aaSorting: [[4, 'desc']],
                columns: [
                    { data: 'user', name: 'user' },
                    { data: 'department', name: 'dept.name' },
                    { data: 'designation', name: 'dsgn.name' },
                    { data: 'transaction_date', name: 'transaction_date'},
                    { data: 'ref_no', name: 'ref_no'},
                    { data: 'final_total', name: 'final_total'},
                    { data: 'payment_status', name: 'payment_status'},
                    { data: 'action', name: 'action' },
                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#payrolls_table'));
                },
            });

            $(document).on('change', '#user_id_filter, #month_year_filter, #department_id, #designation_id, #location_id_filter', function() {
                payrolls_table.ajax.reload();
            });

            if ($('#add_payroll_step1').length) {
                $('#add_payroll_step1').validate();
                $('#employee_id').select2({
                    dropdownParent: $('#payroll_modal')
                });
            }

            $('div.view_modal').on('shown.bs.modal', function(e) {
                __currency_convert_recursively($('.view_modal'));
            });

            $('#month_year, #month_year_filter').datepicker({
                autoclose: true,
                format: 'mm/yyyy',
                minViewMode: "months"
            });
$(document).on('click', '.delete-payroll', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).attr('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    payrolls_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
   @can('essentials.delete_payroll')
                $(document).on('click', '.delete-payroll', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    }).then(willDelete => {
                        if (willDelete) {
                            var href = $(this).attr('href');
                            var data = $(this).serialize();

                            $.ajax({
                                method: 'DELETE',
                                url: href,
                                dataType: 'json',
                                data: data,
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        payroll_group_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            @endcan
            //pay components
            @if(auth()->user()->can('essentials.view_allowance_and_deduction') || auth()->user()->can('essentials.add_allowance_and_deduction'))
                $('#add_allowance_deduction_modal').on('shown.bs.modal', function(e) {
                    var $p = $(this);
                    $('#add_allowance_deduction_modal .select2').select2({dropdownParent:$p});
                    $('#add_allowance_deduction_modal #applicable_date').datepicker();
                    
                });

                $(document).on('submit', 'form#add_allowance_form', function(e) {
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
                                $('div#add_allowance_deduction_modal').modal('hide');
                                toastr.success(result.msg);
                                ad_pc_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                });
                
                ad_pc_table = $('#ad_pc_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{action([\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController::class, 'index'])}}",
                    columns: [
                        { data: 'description', name: 'description' },
                        { data: 'type', name: 'type' },
                        { data: 'amount', name: 'amount' },
                        { data: 'applicable_date', name: 'applicable_date' },
                        { data: 'employees', searchable: false, orderable: false },
                        { data: 'action', name: 'action' }
                    ],
                    fnDrawCallback: function(oSettings) {
                        __currency_convert_recursively($('#ad_pc_table'));
                    },
                });

                $(document).on('click', '.delete-allowance', function(e) {
                    e.preventDefault();
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
                                        ad_pc_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            @endif
            //payroll groups
            @can('essentials.view_all_payroll')
                payroll_group_table = $('#payroll_group_table').DataTable({
                	
                        processing: true,
                        serverSide: true,
                        ajax: "{{action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'payrollGroupDatatable'])}}",
                        aaSorting: [[6, 'desc']],
                        columns: [
                            { data: 'name', name: 'essentials_payroll_groups.name' },
                            { data: 'status', name: 'essentials_payroll_groups.status' },
                            { data: 'payment_status', name: 'essentials_payroll_groups.payment_status' },
                            { data: 'gross_total', name: 'essentials_payroll_groups.gross_total' },
                            { data: 'added_by', name: 'added_by' },
                            { data: 'location_name', name: 'BL.name' },
                            { data: 'created_at', name: 'essentials_payroll_groups.created_at', searchable: false},
                            { data: 'action', name: 'action', searchable: false, orderable: false}
                        ]
                    });
            @endcan
         

            $(document).on('change', '#primary_work_location', function () {
                let location_id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnLocation'])}}",
                    dataType: 'json',
                    data: {
                        'location_id' : location_id
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('select#employee_ids').html('');
                            $('select#employee_ids').html(result.employees_html);
                        }
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection
