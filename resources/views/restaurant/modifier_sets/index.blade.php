@extends('layouts.app')
@section('title', __('restaurant.modifiers'))

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
                <h1>@lang( 'restaurant.modifier_sets' )</h1>
                <p>@lang('lang_v1.restaurant')</p>
            </div>

            <div class="filter">
               
            
            @can('restaurant.view')
            <div class="new-user pull-right">
                @can('restaurant.create')
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="{{action('Restaurant\ModifierSetsController@create')}}" 
                        data-container=".modifier_modal">
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
                        <table class="max-table" id="modifier_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'restaurant.modifier_sets' )</th>
                                    <th>@lang( 'restaurant.modifiers' )</th>
                                    <th>@lang( 'restaurant.products' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    @endcan
            <div class="modal fade modifier_modal" tabindex="-1" role="dialog" 
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

            $(document).on('click', 'button.remove-modifier-row', function(e){
                $(this).closest('tr').remove();
            });

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
                            $('div.modifier_modal').modal('hide');
                            toastr.success(result.msg);
                            modifier_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //Brands table
            var modifier_table = $('#modifier_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/modules/modifiers',
                    columnDefs: [ {
                        "targets": [1,2, 3],
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'name', name: 'name'  },
                        { data: 'variations', name: 'variations'},
                        { data: 'modifier_products', name: 'modifier_products'},
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_modifier_button', function(){

                $( "div.modifier_modal" ).load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.modifier_modal').modal('hide');
                                    toastr.success(result.msg);
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_modifier_button', function(){
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
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'button.add-modifier-row', function(){
                $('table#add-modifier-table').append($(this).data('html'));
            });

            $(document).on('click', 'button.remove_modifier_product', function(){
                swal({
                  title: LANG.sure,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(this).closest('tr').remove();
                    }
                });
            });
            
        });
    </script>
@endsection