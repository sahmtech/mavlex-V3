@extends('layouts.app')
@section('title', __('lang_v1.warranties'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.warranties')</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
                  <div class="new-user">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="{{action('WarrantyController@create')}}" 
                        data-container=".view_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('unit.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="warranty_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'lang_v1.name' )</th>
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'lang_v1.duration' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

            <div class="footer">
                <div class="pagination">
                    
                </div>

              
            </div>
    </div>

</div>

@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        //Status table
        var warranty_table = $('#warranty_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('WarrantyController@index')}}",
                columnDefs: [ {
                    "targets": 3,
                    "orderable": false,
                    "searchable": false
                } ],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'duration', name: 'duration' },
                    { data: 'action', name: 'action' },
                ]
            });

        $(document).on('submit', 'form#warranty_form', function(e){
            e.preventDefault();
            $(this).find('button[type="submit"]').attr('disabled', true);
            var data = $(this).serialize();

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success == true){
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        warranty_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
@endsection
