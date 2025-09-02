@extends('layouts.app')
@section('title', __('settings.locked_users'))

@section('content')
<div class="main-container no-print">
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <div class="card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.locked_users')</h1>
                <p>@lang('settings.view_locked_users')</p>
            </div>
            <div class="filter"></div>
        </div>
        <section class="content settings">

            <table class="table" id="locked_users_table">
                <thead>
                    <tr>
                        <th>@lang('business.username')</th>
                        <th>@lang('user.name')</th>
                        <th>@lang('business.business_name')</th>
                        <th>@lang('settings.locked_until')</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
            </table>

        </section>
    </div>
</div>
@moduleEnabled('Superadmin')
@include('superadmin::business.update_password_modal')
@endmoduleEnabled
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    $('#locked_users_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.locked_users_data') }}',
        columns: [
            {data: 'username', name: 'username'},
            {data: 'full_name', name: 'full_name'},
            {data: 'business_name', name: 'business_name'},
            {data: 'locked_until', name: 'locked_until'},
            {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
    });

     $(document).on('click', '.update_user_password', function (e) {
        e.preventDefault();
        $('form#password_update_form, #user_id').val($(this).data('user_id'));
        $('span#user_name').text($(this).data('user_name'));
        $('#update_password_modal').modal('show');
    });

    password_update_form_validator = $('form#password_update_form').validate();

    $('#update_password_modal').on('hidden.bs.modal', function() {
        password_update_form_validator.resetForm();
        $('form#password_update_form')[0].reset();
    });

    $(document).on('submit', 'form#password_update_form', function(e) {
        e.preventDefault();
        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('#update_password_modal').modal('hide');
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
                $('form#password_update_form')
                .find('button[type="submit"]')
                .attr('disabled', false);
            },
        });
    });
});
    </script>
    
@endsection