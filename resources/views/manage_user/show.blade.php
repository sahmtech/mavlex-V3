@extends('layouts.app')

@section('title', __( 'lang_v1.view_user' ))

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
                <h1>@lang( 'lang_v1.view_user' )</h1>
                <p>@lang( 'user.user_management' )</p>
            </div>

            <div class="filter">
                <div class="col-md-12 col-xs-12 mt-15 pull-right">
                    {!! Form::select('user_id', $users, $user->id , ['class' => 'form-control select2', 'id' => 'user_id']); !!}
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @php
                            if(isset($user->media->display_url)) {
                                $img_src = $user->media->display_url;
                            } else {
                                $img_src = 'https://ui-avatars.com/api/?name='.$user->first_name;
                            }
                        @endphp

                        <img class="profile-user-img img-responsive img-circle" src="{{$img_src}}" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            {{$user->user_full_name}}
                        </h3>

                        <p class="text-muted text-center" title="@lang('user.role')">
                            {{$user->role_name}}
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>@lang( 'business.username' )</b>
                                <a class="pull-right">{{$user->username}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang( 'business.email' )</b>
                                <a class="pull-right">{{$user->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('lang_v1.status_for_user') }}</b>
                                @if($user->status == 'active')
                                    <span class="label label-success pull-right">
                                        @lang('business.is_active')
                                    </span>
                                @else
                                    <span class="label label-danger pull-right">
                                        @lang('lang_v1.inactive')
                                    </span>
                                @endif
                            </li>
                        </ul>
                        @can('user.update')
                            <a data-href="{{action('ManageUserController@edit', [$user->id])}}"class="edit_user_button btn-modal btn btn-primary btn-block" data-container=".user_edit_modal">
                                <i class="glyphicon glyphicon-edit"></i>
                                @lang("messages.edit")
                            </a>
                        @endcan
                       
                        </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#user_info_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-user" aria-hidden="true"></i> @lang( 'lang_v1.user_info')</a>
                        </li>
                        
                        <li>
                            <a href="#documents_and_notes_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-paperclip" aria-hidden="true"></i> @lang('lang_v1.documents_and_notes')</a>
                        </li>

                        <li>
                            <a href="#activities_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-pen-square" aria-hidden="true"></i> @lang('lang_v1.activities')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="user_info_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                            <p><strong>@lang( 'lang_v1.cmmsn_percent' ): </strong> {{$user->cmmsn_percent}}%</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php
                                            $selected_contacts = ''
                                        @endphp
                                        @if(count($user->contactAccess)) 
                                            @php
                                                $selected_contacts_array = [];
                                            @endphp
                                            @foreach($user->contactAccess as $contact) 
                                                @php
                                                    $selected_contacts_array[] = $contact->name; 
                                                @endphp
                                            @endforeach 
                                            @php
                                                $selected_contacts = implode(', ', $selected_contacts_array);
                                            @endphp
                                        @else 
                                            @php
                                                $selected_contacts = __('lang_v1.all'); 
                                            @endphp
                                        @endif
                                        <p>
                                            <strong>@lang( 'lang_v1.allowed_contacts' ): </strong>
                                                {{$selected_contacts}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @include('user.show_details')
                        </div>
                        <div class="tab-pane" id="documents_and_notes_tab">
                            <!-- model id like project_id, user_id -->
                            <input type="hidden" name="notable_id" id="notable_id" value="{{$user->id}}">
                            <!-- model name like App\Models\User -->
                            <input type="hidden" name="notable_type" id="notable_type" value="App\Models\User">
                            <div class="document_note_body">
                            </div>
                        </div>
                        <div class="tab-pane" id="activities_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('activity_log.activities')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            
    </div>
    <div class="modal fade user_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
</div>

 
@endsection
@section('javascript')
    <!-- document & note.js -->
    @include('documents_and_notes.document_and_note_js')

    <script type="text/javascript">
        $(document).ready( function(){
            $('#user_id').change( function() {
                if ($(this).val()) {
                    window.location = "{{url('/users')}}/" + $(this).val();
                }
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready( function(){

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
                                    return $( "#email" ).val();
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
                                    return $( "#username" ).val();
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
                $(this).select2({ dropdownParent: $p });
            });
        $('.accordionTitle').each((index, element) => {
            
            $('.accordionTitle').click(function(){
                if ($(this).hasClass("is-open")){
                    $(this).removeClass("is-open");
                } else {
                    $('.is-open').each((i, e) => {
                        $(this).removeClass("is-open");
                    });
                    $(this).addClass("is-open");
                }
            });
            
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
        templateResult: function (data) { 
            var template = '';
            if (data.supplier_business_name) {
                template += data.supplier_business_name + "<br>";
            }
            template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

            return  template;
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