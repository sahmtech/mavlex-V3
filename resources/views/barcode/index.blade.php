@extends('layouts.app')
@section('title', __('barcode.barcodes'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.setting', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('barcode.barcodes')</h1>
                <p>@lang('barcode.manage_your_barcodes')</p>
            </div>

            <div class="filter">
                <a class="btn btn-block btn-primary" href="{{action('BarcodeController@create')}}">
                        <i class="fa fa-plus"></i> @lang('barcode.add_new_setting')
                </a>
            </div>
        </div>

        <div class="content">
           
                <div class="table-responsive">
                    <table class="table max-table" id="barcode_table">
                        <thead>
                            <tr>
                                <th>@lang('barcode.setting_name')</th>
                                <th>@lang('barcode.setting_description')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        var barcode_table = $('#barcode_table').DataTable({
            processing: true,
            serverSide: true,
            buttons:[],
            ajax: '/barcodes',
            bPaginate: false,
            columnDefs: [ {
                "targets": 2,
                "orderable": false,
                "searchable": false
            } ]
        });
        $(document).on('click', 'button.delete_barcode_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_barcode,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();

                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success === true){
                                toastr.success(result.msg);
                                barcode_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', 'button.set_default', function(){
            var href = $(this).data('href');
            var data = $(this).serialize();

            $.ajax({
                method: "get",
                url: href,
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success === true){
                        toastr.success(result.msg);
                        barcode_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
@endsection