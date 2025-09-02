@extends('layouts.app')
@section('title', __('settings.session_management'))

@section('content')
<div class="main-container no-print">
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
        </div>
    </div>
    
    <style>
        .small-box {
            border-radius: 26px;
            background-color: #fff !important;
            color: #000;
            border: 1px solid #ccc;
        }
        .small-box:hover {
            border-radius: 26px;
            background-color: #fff !important;
            color: #000;    
        }
        
        .badge-info {
            background-color: var(--secondary-color, #6c757d) !important;
            color: #fff !important;
        }
        
        .table-responsive {
            min-height: 400px;
            overflow: visible;
        }
        
        .btn-group .dropdown-menu {
            position: absolute;
            z-index: 1050;
            min-width: 200px;
        }
        
        .settings {
            overflow: visible !important;
        }
        
        .card-wrapper {
            overflow: visible !important;
        }
        .badge-success{
            background-color: var(--secondary-color, #6c757d) !important;
        }
        .badge-danger{
             background-color: red !important;
        }
        .badge-warning{
            background-color: orange;
        }
        html.dark-mode .small-box {
             border-radius: 26px;
        background: #3f405b !important;
        border-color: #2E2F44 !important;
    }

      
    </style>
    
    <div class="card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.session_management')</h1>
                <p>@lang('settings.manage_user_sessions_and_authentication')</p>
            </div>
            <div class="filter">
                <div class="form-group mr-2 mb-0">
                    <select class="form-control form-control-sm" id="session-filter" onchange="change_filter()">
                        <option value="all">@lang('settings.active_sessions')</option>
                        <option value="active">@lang('settings.all_users')</option>
                        <option value="locked">@lang('settings.locked_users')</option>
                        <option value="disabled">@lang('settings.disabled_logins')</option>
                        <option value="active_businesses">@lang('settings.active_businesses')</option>
                        <option value="inactive_businesses">@lang('settings.inactive_businesses')</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-sm" onclick="refresh_table()">
                    <i class="fas fa-sync-alt"></i> @lang('messages.refresh')
                </button>
            </div>
        </div>
        
        <div class="row mb-4" style="margin-top:10px">
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="active-sessions">-</h3>
                        <p>@lang('settings.active_sessions')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3 id="unique-users">-</h3>
                        <p>@lang('settings.unique_users')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="locked-users">-</h3>
                        <p>@lang('settings.locked_users')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="disabled-users">-</h3>
                        <p>@lang('settings.disabled_logins')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="active-businesses">-</h3>
                        <p>@lang('settings.active_businesses')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 id="inactive-businesses">-</h3>
                        <p>@lang('settings.inactive_businesses')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building" style="opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="content settings">
            <table class="table" id="users-table">
                <thead>
                    <tr>
                        <th>@lang('messages.actions')</th>
                        <th>@lang('settings.user_info')</th>
                        <th>@lang('business.business')</th>
                        <th>@lang('settings.session_info')</th>
                        <th>@lang('sale.status')</th>
                    </tr>
                </thead>
            </table>
        </section>
    </div>
</div>

<!-- Lock User Modal -->
<div class="modal fade" id="lockUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('settings.lock_user_account')</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="lockUserForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="lock_user_id">
                    <div class="form-group">
                        <label for="lock_duration">@lang('settings.lock_duration')</label>
                        <select name="duration" id="lock_duration" class="form-control" required onchange="toggleCustomDuration()">
                            <option value="15">15 @lang('settings.minutes')</option>
                            <option value="30">30 @lang('settings.minutes')</option>
                            <option value="60" selected>1 @lang('settings.hour')</option>
                            <option value="120">2 @lang('settings.hours')</option>
                            <option value="240">4 @lang('settings.hours')</option>
                            <option value="480">8 @lang('settings.hours')</option>
                            <option value="720">12 @lang('settings.hours')</option>
                            <option value="1440">24 @lang('settings.hours')</option>
                            <option value="custom">@lang('settings.custom_duration')</option>
                        </select>
                        <small class="form-text text-muted">@lang('settings.user_will_be_locked_for_selected_duration')</small>
                    </div>
                    
                    <div class="form-group" id="custom-duration-group" style="display: none;">
                        <label for="custom_duration">@lang('settings.custom_duration_minutes')</label>
                        <input type="number" name="custom_duration" id="custom_duration" class="form-control" min="1" max="10080" placeholder="@lang('settings.enter_minutes')">
                        <small class="form-text text-muted">@lang('settings.enter_custom_duration_help')</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-lock"></i> @lang('settings.lock_user')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
let current_filter = 'all';

$(document).ready(function() {
    // Load statistics
    load_stats();
    
    // Initialize DataTable
    const table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("session-management.data") }}',
            data: function(d) {
                d.filter = current_filter;
            }
        },
        columns: [
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
            { data: 'user_info', name: 'user_info' },
            { data: 'business_info', name: 'business_info' },
            { data: 'session_info', name: 'session_info' },
            { data: 'user_status', name: 'user_status' }
        ],
        order: [[3, 'desc']],
        pageLength: 25,
        responsive: true,
        autoWidth: false
    });

    setInterval(function() {
        table.ajax.reload(null, false);
        load_stats();
    }, 30000);
});

function load_stats() {
    $.get('{{ route("session-management.stats") }}', function(data) {
        $('#active-sessions').text(data.active_sessions);
        $('#unique-users').text(data.unique_users);
        $('#locked-users').text(data.locked_users);
        $('#disabled-users').text(data.disabled_users);
        $('#active-businesses').text(data.active_businesses);
        $('#inactive-businesses').text(data.inactive_businesses);
    });
}

function refresh_table() {
    $('#users-table').DataTable().ajax.reload();
    load_stats();
    toastr.info('@lang("messages.success")');
}

function change_filter() {
    current_filter = $('#session-filter').val();
    $('#users-table').DataTable().ajax.reload();
}

function show_lock_modal(user_id, username) {
    $('#lock_user_id').val(user_id);
    $('#lockUserModal .modal-title').html('Lock User: <strong>' + username + '</strong>');
    
    // Reset form and enable button
    $('#lockUserForm')[0].reset();
    $('#lockUserForm button[type="submit"]').prop('disabled', false);
    $('#lock_duration').val('60');
    $('#custom-duration-group').hide();
    
    $('#lockUserModal').modal('show');
}

function toggleCustomDuration() {
    const duration = $('#lock_duration').val();
    if (duration === 'custom') {
        $('#custom-duration-group').show();
        $('#custom_duration').prop('required', true);
    } else {
        $('#custom-duration-group').hide();
        $('#custom_duration').prop('required', false);
    }
}

// Lock User Modal handler

$('#lockUserForm').on('submit', function (e) {
    e.preventDefault();
    
    // Get duration value
    let duration = $('#lock_duration').val();
    if (duration === 'custom') {
        duration = $('#custom_duration').val();
        if (!duration || duration < 1) {
            toastr.error('@lang("settings.please_enter_valid_duration")');
            return;
        }
    }
    
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true);
    
    const formData = {
        user_id: $('#lock_user_id').val(),
        duration: duration,
        _token: '{{ csrf_token() }}'
    };
    
    $.post('{{ route("session-management.lock-user") }}', formData)
        .done(function (data) {
            toastr.success(data.message);
            $('#lockUserModal').modal('hide');
            $('#users-table').DataTable().ajax.reload();
            load_stats();
        })
        .fail(function (xhr) {
            toastr.error(xhr.responseJSON?.message || '@lang("messages.error")');
        })
        .always(function() {
            submitBtn.prop('disabled', false);
        });
});

// Force logout with confirmation
function force_logout(session_id, username) {
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_force_logout")'.replace(':username', username),
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willLogout => {
        if (willLogout) {
            $.post('{{ route("session-management.force-logout") }}', {
                session_id: session_id,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_logout_user")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_logging_out_user")');
            });
        }
    });
}

// Lock user with confirmation
function lock_user(user_id, username, duration) {
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_lock_user")'.replace(':username', username).replace(':duration', duration),
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willLock => {
        if (willLock) {
            $.post('{{ route("session-management.lock-user") }}', {
                user_id: user_id,
                duration: duration,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_lock_user")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_locking_user")');
            });
        }
    });
}

// Unlock user with confirmation
function unlock_user(user_id, username) {
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_unlock_user")'.replace(':username', username),
        icon: 'warning',
        buttons: true,
        dangerMode: false,
    }).then(willUnlock => {
        if (willUnlock) {
            $.post('{{ route("session-management.unlock-user") }}', {
                user_id: user_id,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_unlock_user")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_unlocking_user")');
            });
        }
    });
}

// Toggle user status
function toggle_user_status(user_id, status, username) {
    const action = status === 'active' ? '@lang("settings.activate")' : '@lang("settings.deactivate")';
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_toggle_user_status")'.replace(':action', action).replace(':username', username),
        icon: 'warning',
        buttons: true,
        dangerMode: status === 'inactive',
    }).then(willToggle => {
        if (willToggle) {
            $.post('{{ route("session-management.toggle-status") }}', {
                user_id: user_id,
                status: status,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_update_user_status")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_updating_user_status")');
            });
        }
    });
}

// Toggle login permission
function toggle_login_permission(user_id, allow_login, username) {
    const action = allow_login ? '@lang("settings.allow_login")' : '@lang("settings.block_login")';
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_toggle_login_permission")'.replace(':action', action).replace(':username', username),
        icon: 'warning',
        buttons: true,
        dangerMode: !allow_login,
    }).then(willToggle => {
        if (willToggle) {
            $.post('{{ route("session-management.toggle-login") }}', {
                user_id: user_id,
                allow_login: allow_login,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_update_login_permission")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_updating_login_permission")');
            });
        }
    });
}

// Toggle business status
function toggle_business_status(business_id, is_active, business_name) {
    const action = is_active ? '@lang("settings.activate")' : '@lang("settings.deactivate")';
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_toggle_business_status")'.replace(':action', action).replace(':business', business_name),
        icon: 'warning',
        buttons: true,
        dangerMode: !is_active,
    }).then(willToggle => {
        if (willToggle) {
            $.post('{{ route("session-management.toggle-business") }}', {
                business_id: business_id,
                is_active: is_active,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#users-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_update_business_status")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_updating_business_status")');
            });
        }
    });
}

// Toggle session details
function toggleSessionDetails(sessionId) {
    const element = document.getElementById(sessionId);
    const badge = event.target.closest('.session-toggle');
    
    if (element.style.display === 'none' || element.style.display === '') {
        element.style.display = 'block';
        badge.innerHTML = '<i class="fas fa-compress-alt"></i> Hide details';
        badge.title = 'Click to hide session details';
    } else {
        element.style.display = 'none';
        const sessionCount = badge.innerHTML.match(/\d+/)[0];
        badge.innerHTML = '<i class="fas fa-expand-alt"></i> ' + sessionCount + ' sessions';
        badge.title = 'Click to show all sessions';
    }
}
</script>
@endsection