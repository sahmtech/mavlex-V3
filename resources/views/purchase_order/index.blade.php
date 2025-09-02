@extends('layouts.app')
@section('title', __('lang_v1.purchase_order'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.purchase', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.purchase_order')</h1>
                <p>@lang( 'purchase.purchases' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    @can('purchase_order.create')
                        <a class="btn btn-block btn-primary" href="{{action('PurchaseOrderController@create')}}">
                            <i class="fa fa-plus"></i> @lang('messages.add')
                        </a>
                        
                    @endcan
                </div>

                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->

        @component('components.filters', ['title' => __('report.filters')])
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('po_list_filter_location_id',  __('purchase.business_location') . ':') !!}
                {!! Form::select('po_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('po_list_filter_supplier_id',  __('purchase.supplier') . ':') !!}
                {!! Form::select('po_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('po_list_filter_status',  __('sale.status') . ':') !!}
                {!! Form::select('po_list_filter_status', $purchaseOrderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        @if(!empty($shipping_statuses))
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('shipping_status', __('lang_v1.shipping_status') . ':') !!}
                    {!! Form::select('shipping_status', $shipping_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
        @endif
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('po_list_filter_date_range', __('report.date_range') . ':') !!}
                {!! Form::text('po_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
            </div>
        </div>
    @endcomponent

        <div class="content">
            <table class="table ajax_view max-table" id="purchase_order_table" style="width: 100%;">
            <thead>
                <tr>
                    <th>@lang('messages.action')</th>
                    <th>@lang('messages.date')</th>
                    <th>@lang('purchase.ref_no')</th>
                    <th>@lang('purchase.location')</th>
                    <th>@lang('purchase.supplier')</th>
                    <th>@lang('sale.status')</th>
                    <th>@lang('lang_v1.quantity_remaining')</th>
                    <th>@lang('lang_v1.shipping_status')</th>
                </tr>
            </thead>
        </table>

        <div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
        </div>

    </div>
</div>

@stop
@section('javascript')	
@includeIf('purchase_order.common_js')
<script type="text/javascript">
    $(document).ready( function(){
        //Purchase table
        purchase_order_table = $('#purchase_order_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            scrollY: "75vh",
            scrollX:        true,
            scrollCollapse: true,
            ajax: {
                url: '{{action("PurchaseOrderController@index")}}',
                data: function(d) {
                    if ($('#po_list_filter_location_id').length) {
                        d.location_id = $('#po_list_filter_location_id').val();
                    }
                    if ($('#po_list_filter_supplier_id').length) {
                        d.supplier_id = $('#po_list_filter_supplier_id').val();
                    }
                    if ($('#po_list_filter_status').length) {
                        d.status = $('#po_list_filter_status').val();
                    }
                    if ($('#shipping_status').length) {
                        d.shipping_status = $('#shipping_status').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#po_list_filter_date_range').val()) {
                        start = $('input#po_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#po_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'name', name: 'contacts.name' },
                { data: 'status', name: 'transactions.status' },
                { data: 'po_qty_remaining', name: 'po_qty_remaining', "searchable": false},
                {data: 'shipping_status', name: 'transactions.shipping_status'},
            ]
        });

        $(document).on(
            'change',
            '#po_list_filter_location_id, #po_list_filter_supplier_id, #po_list_filter_status, #shipping_status',
            function() {
                purchase_order_table.ajax.reload();
            }
        );

        $('#po_list_filter_date_range').daterangepicker(
        dateRangeSettings,
            function (start, end) {
                $('#po_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
               purchase_order_table.ajax.reload();
            }
        );
        $('#po_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#po_list_filter_date_range').val('');
            purchase_order_table.ajax.reload();
        });


        $(document).on('click', 'a.delete-purchase-order', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                purchase_order_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    });
</script>
@endsection