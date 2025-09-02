<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('ManageUserController@store'), 'method' => 'post', 'id' => 'user_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'user.add_user' )</h4>
      <p>@lang( 'user.user_management' )</p>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle is-open">
            <h2 class="">@lang( 'lang_v1.personal_info' )</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <!-- Personal Information -->
          <div class="accordionContent">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                  {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                  {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('email', __( 'business.email' ) . ':*') !!}
                  {!! Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.email' ) ]); !!}
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="toggle-wrapper">
                    <br>
                    <label class="switchBtn">
                      {!! Form::checkbox('is_active', 'active', true, ['class' => 'input-icheck status']); !!}
                      <span class="slider"></span>
                    </label>

                    <p>{{ __('lang_v1.status_for_user') }}</p>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="toggle-wrapper">
                    <br>
                    <label class="switchBtn">
                      {!! Form::checkbox('is_enable_service_staff_pin', 0, false, ['class' => 'input-icheck status', 'id' => 'is_enable_service_staff_pin']); !!}

                      <span class="slider"></span>
                    </label>

                    <p>{{ __('lang_v1.enable_service_staff_pin') }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 hide service_staff_pin_div">
                <div class="form-group">
                  {!! Form::label('service_staff_pin', __( 'lang_v1.staff_pin' ) . ':') !!}
                  {!! Form::password('service_staff_pin', ['class' => 'form-control', 'required' => true, 'placeholder' => __( 'lang_v1.staff_pin' ) ]); !!}
                </div>
              </div>
            </div>
            <!-- End of Personal Information -->
          </div>
        </div>
        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle">
            <h2 class="">@lang( 'lang_v1.roles_and_permissions' )</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <!-- Roles and Permission -->
          <div class="accordionContent">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="toggle-wrapper">
                    <label class="switchBtn">
                      {!! Form::checkbox('allow_login', 1, true,
                      [ 'class' => 'input-icheck', 'id' => 'allow_login']); !!}
                      <span class="slider"></span>
                    </label>

                    <p>{{ __( 'lang_v1.allow_login' ) }}</p>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="user_auth_fields">
                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('username', __( 'business.username' ) . ':') !!}
                    @if(!empty($username_ext))
                    <div class="input-group">
                      {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]); !!}
                      <span class="input-group-addon">{{$username_ext}}</span>
                    </div>
                    <p class="help-block" id="show_username"></p>
                    @else
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]); !!}
                    @endif
                    <p class="help-block">@lang('lang_v1.username_help')</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('password', __( 'business.password' ) . ':*') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.password' ) ]); !!}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('confirm_password', __( 'business.confirm_password' ) . ':*') !!}
                    {!! Form::password('confirm_password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.confirm_password' ) ]); !!}
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('role', __( 'user.role' ) . ':*') !!}
                  {!! Form::select('role', $roles, null, ['class' => 'form-control select2', 'id' => 'role', 'style' => 'width: 100%;']); !!}
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-3">
                <h4>@lang( 'role.access_locations' )</h4>
              </div>
              <div class="col-md-9">
                <div class="col-md-12">
                  <div class="checkbox">
                    <label>
                      {!! Form::checkbox('access_all_locations', 'access_all_locations', true,
                      ['class' => 'input-icheck']); !!} {{ __( 'role.all_locations' ) }}
                    </label>

                  </div>
                </div>
                @foreach($locations as $location)
                <div class="col-md-12">
                  <div class="checkbox">
                    <label>
                      {!! Form::checkbox('location_permissions[]', 'location.' . $location->id, false,
                      [ 'class' => 'input-icheck']); !!} {{ $location->name }} @if(!empty($location->location_id))({{ $location->location_id}}) @endif
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle">
            <h2 class="">@lang('sale.sells')</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <!-- Invoices -->
          <div class="accordionContent">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':') !!}
                  {!! Form::text('cmmsn_percent', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ) ]); !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('max_sales_discount_percent', __( 'lang_v1.max_sales_discount_percent' ) . ':') !!}
                  {!! Form::text('max_sales_discount_percent', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.max_sales_discount_percent' ) ]); !!}
                </div>
              </div>
              <div class="clearfix"></div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="toggle-wrapper">
                    <label class="switchBtn">
                      {!! Form::checkbox('selected_contacts', 1, false,
                      [ 'class' => 'input-icheck', 'id' => 'selected_contacts']); !!}
                      <span class="slider"></span>
                    </label>

                    <p>{{ __( 'lang_v1.allow_selected_contacts' ) }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 hide selected_contacts_div">
                <div class="form-group">
                  {!! Form::label('user_allowed_contacts', __('lang_v1.selected_contacts') . ':') !!}
                  <div class="form-group">
                    {!! Form::select('selected_contact_ids[]', [], null, ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'id' => 'user_allowed_contacts' ]); !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle">
            <h2 class="">@lang('lang_v1.more_info')</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <!-- More Information -->
          <div class="accordionContent">
            @include('user.edit_profile_form_part')
          </div>
        </div>

        @if(!empty($form_partials))
        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle">
            <h2 class="">@lang('lang_v1.hrm_essentials')</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <!-- HRM -->
          <div class="accordionContent">
            <div class="row">
              @foreach($form_partials as $partial)
              {!! $partial !!}
              @endforeach
            </div>
          </div>
        </div>
        @endif

      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id="submit_user_button">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@section('javascript')
<script type="text/javascript">
  __page_leave_confirmation('#user_add_form');
  $('.user_modal').on('shown.bs.modal', function() {


  });
  $(document).ready(function() {
    $('#selected_contacts').on('ifChecked', function(event) {
      $('div.selected_contacts_div').removeClass('hide');
    });
    $('#selected_contacts').on('ifUnchecked', function(event) {
      $('div.selected_contacts_div').addClass('hide');
    });

    $('#is_enable_service_staff_pin').on('ifChecked', function(event) {
      $('div.service_staff_pin_div').removeClass('hide');
    });

    $('#is_enable_service_staff_pin').on('ifUnchecked', function(event) {
      $('div.service_staff_pin_div').addClass('hide');
      $('#service_staff_pin').val('');
    });

    $('#allow_login').on('ifChecked', function(event) {
      $('div.user_auth_fields').removeClass('hide');
    });
    $('#allow_login').on('ifUnchecked', function(event) {
      $('div.user_auth_fields').addClass('hide');
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

  $('form#user_add_form').validate({
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
    }
  });
  $('#username').change(function() {
    if ($('#show_username').length > 0) {
      if ($(this).val().trim() != '') {
        $('#show_username').html("{{__('lang_v1.your_username_will_be')}}: <b>" + $(this).val() + "{{$username_ext}}</b>");
      } else {
        $('#show_username').html('');
      }
    }
  });
</script>
@endsection