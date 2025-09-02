@extends('layouts.app')
@section('title', __('lang_v1.activity_log'))

@section('content')

<div class="main-container no-print">
<div class="horizontal-scroll">
    <div class="storys-container">
    @include('layouts.partials.sub_menu.misc', ['link_class' => 'sub-menu-item'])
</div>
    </div>
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'lang_v1.activity_log' )</h1>
                <p>@lang( 'report.reports' )</p>
            </div>
    <!-- Card Wrapper for dashboard content -->
    

            <div class="filter">
                <div class="new-user">
                     {!! Form::select('al_users_filter', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'al_users_filter', 'placeholder' => __('lang_v1.all')]); !!}
                       
                </div>
                 <div class="new-user">
                         {!! Form::select('subject_type', $transaction_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'subject_type', 'placeholder' => __('lang_v1.all')]); !!}
                               
                </div>
                 <div class="new-user">
                      {!! Form::text('al_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly', 'id' => 'al_date_filter']); !!}
                              
                </div>
               
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">


    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="report-table" id="activity_log_table">
                    <thead>
                        <tr>
                            <th>@lang('lang_v1.date')</th>
                            <th>@lang('lang_v1.subject_type')</th>
                            <th>@lang('messages.action')</th>
                            <th>@lang('lang_v1.by')</th>
                            <th>@lang('brand.note')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        $('#al_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#al_date_filter').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            activity_log_table.ajax.reload();
        });
        $('#al_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#al_date_filter').val('');
            activity_log_table.ajax.reload();
        });

        activity_log_table = $('#activity_log_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": '{{action("ReportController@activityLog")}}',
                "data": function ( d ) {
                    var start_date = '';
                    var end_date = '';
                    if ($('#al_date_filter').val()) {
                        d.start_date = $('input#al_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('input#al_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    d.user_id = $('#al_users_filter').val();
                    d.subject_type = $('#subject_type').val();
                }
            },
            columns: [
                { data: 'created_at', name: 'created_at'  },
                { data: 'subject_type', "orderable": false, "searchable": false},
                { data: 'description', name: 'description'},
                { data: 'created_by', name: 'created_by'},
                { data: 'note', name: 'note'}
            ]
        });  

        $(document).on('change', '#al_users_filter, #subject_type', function(){
            activity_log_table.ajax.reload();
        })
    });
</script>
@endsection