@extends('crm::layouts.app')
@section('title', __('restaurant.bookings'))

@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
    @include('crm::layouts.partials.submenu.customer_nav')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'restaurant.bookings' )</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>

<!-- Main content -->
<section class="content">
    <div class="row">
        
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if(count($business_locations) > 1)
                            <select id="business_location_id" class="select2" style="width:60%">
                                <option value="">@lang('purchase.business_location')</option>
                                @foreach( $business_locations as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mb-12">
                            <button type="button" class="btn btn-primary pull-right" id="add_new_booking_btn"><i class="fa fa-plus"></i> @lang('restaurant.add_booking')</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-condensed" id="bookings_table">
                                <thead>
                                <tr>
                                    <th>@lang('restaurant.booking_starts')</th>
                                    <th>@lang('restaurant.booking_ends')</th>
                                    <th>@lang('sale.status')</th>
                                    <th>@lang('messages.location')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
    </div>
</div>
<!-- /.content -->
@include('crm::booking.create')

@endsection

@section('javascript')
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#add_booking_modal').on('shown.bs.modal', function (e) {
                $(this).find('select').each( function(){
                    if(!($(this).hasClass('select2'))){
                        $(this).select2({
                            dropdownParent: $('#add_booking_modal')
                        });
                    }
                });
                booking_form_validator = $('form#add_booking_form').validate({
                    submitHandler: function(form) {
                        $(form).find('button[type="submit"]').attr('disabled', true);
                        var data = $(form).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(form).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div#add_booking_modal').modal('hide');
                                    toastr.success(result.msg);
                                    bookings_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                                $(form).find('button[type="submit"]').attr('disabled', false);
                                reset_booking_form();
                            }
                        });
                    }
                });
            });

            $('form#add_booking_form #start_time').datetimepicker({
                format: moment_date_format + ' ' +moment_time_format,
                minDate: moment(),
                ignoreReadonly: true
            });
            
            $('form#add_booking_form #end_time').datetimepicker({
                format: moment_date_format + ' ' +moment_time_format,
                minDate: moment(),
                ignoreReadonly: true,
            });

            bookings_table = $('#bookings_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "{{action([\Modules\Crm\Http\Controllers\ContactBookingController::class, 'index'])}}",
                                "data": function ( d ) {
                                    d.location_id = $('#business_location_id').val();
                                }
                            },
                            columns: [
                                {data: 'booking_start', name: 'booking_start'},
                                {data: 'booking_end', name: 'booking_end'},
                                {data: 'booking_status'},
                                {data: 'location_name', name: 'bl.name'},
                            ]
                        });
            $('button#add_new_booking_btn').click( function(){
                $('div#add_booking_modal').modal('show');
            });

        });

        $(document).on('change', 'select#business_location_id', function(){
            bookings_table.ajax.reload();
        });

        function reset_booking_form(){
            $('select#booking_location_id').val('').change();
            $('#booking_note, #start_time, #end_time').val('');
        }

    </script>
@endsection
