@extends('layouts.app')
@section('title', __('user.roles'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.user-management', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'user.user_management' )</h1>
                <p>@lang( 'user.roles' )</p>
            </div>

            <div class="filter">
            <div class="add-role">
                    <a class="btn btn-primary" href="{{action('RoleController@create')}}" >
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </a>
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

        @can('roles.view')
            <div class="roles-list">
                @foreach($roles as $role)
                <div class="role-items">
                    <!-- heading -->
                    <div class="heading">
                        @php
                            $role_name = str_replace('#'. $role->business_id, '', $role->name);
                            if (in_array($role_name, ['Admin', 'Cashier'])) {
                                $role_name = __('lang_v1.' . $role_name);
                            }
                        @endphp

                        <h4>{{ $role_name }}</h4>

                        <div class="buttons">
                            @if(!$role->is_default || $role->name == "Cashier#" . $role->business_id)
                                @can('roles.update')
                                <button>
                                    <a href="{{ action('RoleController@edit', [$role->id]) }} "  class="edit_role_button">
                                        <img src="{{ asset('img/icons/edit.svg') }}" alt="">
                                    </a>
                                </button>
                                @endcan
                                @can('roles.delete')
                                <button data-href="{{ action('RoleController@destroy', [$role->id]) }}" class="delete_role_button">
                                    <img src="{{ asset('img/icons/delete.svg') }}" alt="">
                                </button>
                                @endcan
                            @endif
                        </div>
                    </div>
                    <!-- description -->
                    <div class="desc">
                        <p></p>
                    </div>
                </div>

                @endforeach

                

                    
                </div>
        @endcan
    </div>

</div>

@stop
@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var roles_table = $('#roles_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/roles',
                    buttons:[],
                    columnDefs: [ {
                        "targets": 1,
                        "orderable": false,
                        "searchable": false
                    } ]
                });
        $(document).on('click', 'button.delete_role_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_role,
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
                                roles_table.ajax.reload();
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
