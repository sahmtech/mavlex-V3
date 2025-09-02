@extends('layouts.app')
@section('title', __( 'restaurant.tables' ))

@section('content')
<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.restaurant', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'restaurant.tables' )</h1>
                <p>@lang('lang_v1.restaurant')</p>
            </div>

            <div class="filter">
               
           
            @can('restaurant.view')
            <div class="new-user">
                @can('restaurant.create')
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="{{action('Restaurant\TableController@create')}}" 
                    data-container=".tables_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )
                </button>
                
            @endcan
            </div>
            @endcan
        </div>
        </div>
        <!-- End of Filter through table -->

        <div class="content">
            @can('restaurant.view')
                <table class="max-table" id="tables_table">
                    <thead>
                        <tr>
                            <th>@lang( 'restaurant.table' )</th>
                            <th>@lang( 'purchase.business_location' )</th>
                            <th>@lang( 'restaurant.description' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            @endcan

            <div class="modal fade tables_modal" tabindex="-1" role="dialog" 
                aria-labelledby="gridSystemModalLabel">
            </div>
        </div>

        <div class="footer">
            <div class="pagination">
                
            </div>

           
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('submit', 'form#table_add_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            $('div.tables_modal').modal('hide');
                            toastr.success(result.msg);
                            tables_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //Brands table
            var tables_table = $('#tables_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/modules/tables',
                    columnDefs: [ {
                        "targets": 3,
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'name', name: 'res_tables.name'  },
                        { data: 'location', name: 'BL.name'},
                        { data: 'description', name: 'description'},
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_table_button', function(){

                $( "div.tables_modal" ).load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#table_edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.tables_modal').modal('hide');
                                    toastr.success(result.msg);
                                    tables_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_table_button', function(){
                swal({
                  title: LANG.sure,
                  text: LANG.confirm_delete_table,
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
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    tables_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection