@extends('layouts.app')
@section('title', __( 'user.users' ))

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
                <p>@lang( 'user.users' )</p>
            </div>

            <div class="filter">

            </div>

            <div class="new-user">
                @can('user.create')
                <button type="button" class="add-user-modal-btn btn-modal " data-href="{{action('ManageUserController@create')}}" data-container=".user_add_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )
                </button>
                @endcan
            </div>
        </div>
        <!-- End of Filter through table -->

        <div class="content">
            @can('user.view')
            <div class="table-responsive">
                <table class="ajax_view max-table" id="users_table">
                    <thead>
                        <tr>
                            <th>@lang( 'business.username' )</th>
                            <th>@lang( 'user.name' )</th>
                            <th>@lang( 'user.role' )</th>
                            <th>@lang( 'business.email' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
            @endcan
        </div>

        <div class="modal fade user_add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
    </div>

</div>

@stop
@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready(function() {
        var users_table = $('#users_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/users',
            columnDefs: [{
                "targets": [4],
                "orderable": false,
                "searchable": false
            }],
            "columns": [{
                    "data": "username"
                },
                {
                    "data": "full_name"
                },
                {
                    "data": "role"
                },
                {
                    "data": "email"
                },
                {
                    "data": "action"
                }
            ]
        });
        $(document).on('click', 'button.delete_user_button', function() {
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_user,
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
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

        $('.user_add_modal, .user_edit_modal').on('shown.bs.modal', function(e) {
            $('form#user_add_form')
                .submit(function(e) {
                    e.preventDefault();
                })
                .validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        email: {
                            email: true,
                            remote: {
                                url: "/business/register/check-email",
                                type: "post",
                                data: {
                                    email: function() {
                                        return $("#email").val();
                                    }
                                }
                            }
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            equalTo: "#password"
                        },
                        username: {
                            minlength: 5,
                            remote: {
                                url: "/business/register/check-username2",
                                type: "post",
                                data: {
                                    username: function() {
                                        return $("#username").val();
                                    },
                                    @if(!empty($username_ext))
                                    username_ext: "{{$username_ext}}"
                                    @endif
                                }
                            }
                        }
                    },
                    messages: {
                        password: {
                            minlength: 'Password should be minimum 5 characters',
                        },
                        confirm_password: {
                            equalTo: 'Should be same as password'
                        },
                        username: {
                            remote: 'Invalid username or User already exist'
                        },
                        email: {
                            remote: '{{ __("validation.unique", ["attribute" => __("business.email")]) }}'
                        }
                    },
                    submitHandler: function(form) {
                        e.preventDefault();
                        var data = $(form).serialize();

                        $.ajax({
                            method: 'POST',
                            url: $(form).attr('action'),
                            dataType: 'json',
                            data: data,
                            beforeSend: function(xhr) {
                                __disable_submit_button($(form).find('button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.user_add_modal').modal('hide');
                                    $('div.user_edit_modal').modal('hide');
                                    toastr.success(result.msg);
                                    users_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    },
                });
            $('form#user_add_form').find('.select2')
                .each(function() {
                    var $p = $(this).parent();
                    $(this).select2({
                        dropdownParent: $p
                    });
                });

            function initializeAccordion(modal) {
                $(modal).find('.accordionTitle').off('click').on('click', function() {
                    let $this = $(this);
                    let $parentModal = $this.closest('.modal');

                    if ($this.hasClass("is-open")) {
                        $this.removeClass("is-open");
                    } else {
                        $parentModal.find('.accordionTitle.is-open').removeClass("is-open");
                        $this.addClass("is-open");
                    }
                });
            }

            $('.modal').on('shown.bs.modal', function() {
                initializeAccordion(this);
            });

            $('.modal').each(function() {
                if (!$(this).data('accordion-initialized')) {
                    initializeAccordion(this);
                    $(this).data('accordion-initialized', true);
                }
            });

            $("#selected_contacts").click(function() {
                var checked = $(this).is(':checked');
                if (checked) {
                    $('div.selected_contacts_div').removeClass('hide');
                } else {
                    $('div.selected_contacts_div').addClass('hide');
                }

            });

            $("#allow_login").click(function() {
                var checked = $(this).is(':checked');
                if (checked) {
                    $('div.user_auth_fields').removeClass('hide');
                } else {
                    $('div.user_auth_fields').addClass('hide');
                }

            });
            $("#is_enable_service_staff_pin").click(function() {
                var checked = $(this).is(':checked');
                if (checked) {
                    $('div.service_staff_pin_div').removeClass('hide');
                } else {
                    $('div.service_staff_pin_div').addClass('hide');
                }

            });

            $('#user_allowed_contacts').select2({
                ajax: {
                    url: '/contacts/customers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            all_contact: true
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                templateResult: function(data) {
                    var template = '';
                    if (data.supplier_business_name) {
                        template += data.supplier_business_name + "<br>";
                    }
                    template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

                    return template;
                },
                minimumInputLength: 1,
                escapeMarkup: function(markup) {
                    return markup;
                },
            });
        });

    });
</script>
@endsection