@extends('layouts.app')
@section('title', __('settings.confirm_access_recovery_codes'))
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
                <h1>@lang('settings.confirm_access_recovery_codes')</h1>
                <p>
                    @lang('settings.re_authenticate_message')
                </p>
            </div>
            <div class="filter">
                <div class="new-user">

                </div>
            </div>
        </div>
        <section class="content">
   
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $msg)
                        {{ $msg }}<br>
                    @endforeach
                </div>
            @endif

            {!! Form::open(['route' => '2fa.reauth_verify', 'method' => 'POST']) !!}
                
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
            <!-- Also pass the source if needed (e.g., 'setup' or 'recovery') -->
            <input type="hidden" name="source" value="{{ request('source', 'setup') }}">
            <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('confirm_method', __('settings.choose_method')) !!}
                        {!! Form::select('confirm_method', [
                            'otp' => __('settings.one_time_password'),
                            'password' => __('settings.password')
                        ], null, ['id' => 'confirm_method', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('confirm_value', __('settings.enter_code_or_password')) !!}
                        {!! Form::text('confirm_value', null, ['id' => 'confirm_value', 'class' => 'form-control', 'required' => true ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::submit(__('settings.confirm'), ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </section>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    var method_select = document.getElementById('confirm_method');
    var confirm_input = document.getElementById('confirm_value');

    function update_input_type() {
        if (method_select.value === 'password') {
            confirm_input.type = 'password';
        } else {
            confirm_input.type = 'text';
        }
    }
    update_input_type();
    method_select.addEventListener('change', update_input_type);
});
</script>

