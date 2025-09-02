@extends('layouts.app')
@section('title', __('settings.otp_verification_management'))

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
    border:1px solid #ccc;
}
.small-box:hover {
    border-radius: 26px;
    background-color: #fff !important;
    color: #000;
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
                <h1>@lang('settings.otp_verification_management')</h1>
                <p>@lang('settings.manage_otp_verification_requests')</p>
            </div>
            <div class="filter">
                <div class="btn-group mr-2" role="group">
                    <button type="button" class="btn btn-primary btn-sm filter-btn active" data-filter="active">
                        <i class="fas fa-mobile-alt"></i> @lang('settings.active_otps')
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm filter-btn" data-filter="inactive">
                        <i class="fas fa-user-clock"></i> @lang('settings.unverified_users')
                    </button>
                </div>
                <button type="button" class="btn btn-primary btn-sm" onclick="refresh_table()">
                    <i class="fas fa-sync-alt"></i> @lang('messages.refresh')
                </button>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="row mb-4" style="margin-top:10px">
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="active-otps">-</h3>
                        <p>@lang('settings.active_otps')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="expired-otps">-</h3>
                        <p>@lang('settings.expired_otps')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="failed-attempts">-</h3>
                        <p>@lang('settings.failed_attempts')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 id="pending-verification">-</h3>
                        <p>@lang('settings.pending_users')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="today-requests">-</h3>
                        <p>@lang('settings.today_requests')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                <div class="small-box">
                    <div class="inner">
                        <h3 id="high-retry-users">-</h3>
                        <p>@lang('settings.high_retries')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-redo"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="content settings">
            <table class="table" id="otp-table">
                <thead>
                    <tr>
                        <th>@lang('settings.user_info')</th>
                        <th>@lang('business.business')</th>
                        <th>@lang('settings.otp_code')</th>
                        <th>@lang('sale.status')</th>
                        <th>@lang('settings.attempts')</th>
                        <th>@lang('settings.resend_count')</th>
                        <th>@lang('messages.created_at')</th>
                        <th>@lang('messages.actions')</th>
                    </tr>
                </thead>
            </table>
        </section>
    </div>
</div>

@endsection

@section('javascript')
<script>
let current_filter = 'active';

$(document).ready(function() {
    // Load statistics
    load_stats();
    
    // Initialize DataTable
    const table = $('#otp-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.otp.data") }}',
            data: function(d) {
                d.filter = current_filter;
            }
        },
        columns: [
            { data: 'user_info', name: 'user_info' },
            { data: 'business_info', name: 'business_info' },
            { data: 'otp_code', name: 'otp_code' },
            { data: 'otp_status', name: 'otp_status' },
            { data: 'attempts', name: 'attempts' },
            { data: 'resend_count', name: 'resend_count' },
            { data: 'created_info', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[6, 'desc']],
        pageLength: 25,
        responsive: true,
        autoWidth: false
    });

    $('.filter-btn').on('click', function() {
        const filter = $(this).data('filter');
        current_filter = filter;
        
        $('.filter-btn').removeClass('active btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('active btn-primary');
        
        table.ajax.reload();
    });

    setInterval(function() {
        table.ajax.reload(null, false);
        load_stats();
    }, 60000);
});

function load_stats() {
    $.get('{{ route("admin.otp.stats") }}', function(data) {
        $('#active-otps').text(data.active_otps);
        $('#expired-otps').text(data.expired_otps);
        $('#failed-attempts').text(data.failed_attempts);
        $('#pending-verification').text(data.pending_verification);
        $('#today-requests').text(data.today_requests);
        $('#high-retry-users').text(data.high_retry_users);
    });
}

function refresh_table() {
    $('#otp-table').DataTable().ajax.reload();
    load_stats();
    toastr.info('@lang("messages.success")');
}

function reset_otp(token_id) {
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_reset_otp")',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willReset => {
        if (willReset) {
            $.post('{{ route("admin.otp.reset") }}', {
                token_id: token_id,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#otp-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_reset_otp")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_resetting_otp")');
            });
        }
    });
}

function manual_verify(user_id, username) {
    const is_inactive = current_filter === 'inactive';
    const message = is_inactive 
        ? '@lang("settings.confirm_verify_unverified_user")'.replace(':username', username)
        : '@lang("settings.confirm_verify_user")'.replace(':username', username);
        
    swal({
        title: '@lang("messages.sure")',
        text: message,
        icon: 'warning',
        buttons: true,
        dangerMode: false,
    }).then(willVerify => {
        if (willVerify) {
            $.post('{{ route("admin.otp.verify") }}', {
                user_id: user_id,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#otp-table').DataTable().ajax.reload();
                    load_stats();
                    
                    if (is_inactive) {
                        toastr.info('@lang("settings.user_verified_removed_from_list")');
                    }
                } else {
                    toastr.error('@lang("settings.failed_to_verify_user")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_verifying_user")');
            });
        }
    });
}

function deactivate_token(token_id) {
    swal({
        title: '@lang("messages.sure")',
        text: '@lang("settings.confirm_deactivate_token")',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDeactivate => {
        if (willDeactivate) {
            $.post('{{ route("admin.otp.deactivate") }}', {
                token_id: token_id,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#otp-table').DataTable().ajax.reload();
                    load_stats();
                } else {
                    toastr.error('@lang("settings.failed_to_deactivate_token")');
                }
            }).fail(function() {
                toastr.error('@lang("settings.error_deactivating_token")');
            });
        }
    });
}
</script>
@endsection