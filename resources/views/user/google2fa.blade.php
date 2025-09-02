@extends('layouts.app')
@section('title', __('settings.two_factor_auth_title'))
@section('content')
<div class="main-container no-print">
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.user', ['link_class' => 'sub-menu-item'])
        </div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.two_factor_auth_title')</h1>
                <p>@lang('settings.google_auth_app_desc')</p>
            </div>
            <div class="filter">
                <div class="new-user">
                    @if(auth()->user()->two_factor_enabled)
                    <span style="color: #fff; background-color: #28a745; padding: 5px 10px; border-radius: 5px;">
                        @lang('settings.configured_status')
                    </span>
                    @else
                    <span style="color: #fff; background-color: #ffc107; padding: 5px 10px; border-radius: 5px;">
                        @lang('settings.needs_configuration_status')
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">

            <p>@lang('settings.two_factor_scan_or_enter_msg')</p>
            <p>

                <a href="#" id="toggle-apps"><strong>@lang('settings.supported_app') </strong></a>
            </p>
            <ul id="supported-apps-list" style="display: none;">
                @foreach(trans('settings.supported_apps') as $app => $platforms)
                <li>
                    <strong>{{ $app }}</strong> for {{ implode(', ', $platforms) }}
                </li>
                @endforeach
            </ul>
            <div class="text-center">
                {!! $qr_code_url !!}
            </div>
            <p>
                @lang('settings.your_secret_key_msg')
                <strong>{{ $secret_key }}</strong>
            </p>
            <form action="{{ route('2fa.setup_verify') }}" method="POST">
                @csrf
                <input type="hidden" name="source" value="setup">

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('one_time_password', __('settings.one_time_password_label') . ':' ) !!}
                        {!! Form::text('one_time_password', null, [ 'class' => 'form-control', 'required', 'placeholder'
                        => __('settings.enter_2fa_code_placeholder')] ) !!}
                        @error('one_time_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary btn-big pull-right">
                            @lang('settings.verify_button')
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var toggleLink = document.getElementById('toggle-apps');
      var appsList = document.getElementById('supported-apps-list');
  
      toggleLink.addEventListener('click', function(e) {
          e.preventDefault();
          // Check if the list is hidden or not.
          if (appsList.style.display === 'none' || appsList.style.display === '') {
              appsList.style.display = 'block';
          } else {
              appsList.style.display = 'none';
             
          }
      });
  });
</script>