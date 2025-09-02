@extends('layouts.auth')

@section('content')
<div class="form-content login-form">
    <h3 class="auth-text-heading">@lang('settings.one_time_password_heading')</h3>

    <form action="{{ route('2fa.form_verify') }}" method="POST">
        @csrf
        <div class="form-group">
            {!! Form::label('one_time_password', __('settings.one_time_password_label')) !!}
            {!! Form::text('one_time_password', null, ['class' => 'form-control','id' => 'one_time_password', 'placeholder' => __('settings.enter_2fa_code_placeholder'),'autofocus' => 'autofocus' ]) !!}
            @error('one_time_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        @if(!empty($app_settings->two_factor_settings['allow_disable_2fa']))
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="disable_2fa_temporarily">
                    {!! Form::checkbox('disable_2fa_temporarily', 1,false, ['id' => 'disable_2fa_temporarily']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <label for="disable_2fa_temporarily" class="ms-2">
                    @lang('settings.disable_2fa_for', ['duration' => $app_settings->two_factor_settings['disable_2fa_duration'] ?? 30,'unit' => ucfirst($app_settings->two_factor_settings['disable_duration_unit'] ?? 'minutes')])
                </label>
            </div>
        </div>
    @endif 

        <div class="button-wrapper">
            <button type="submit" class="btn btn-primary">
                @lang('settings.verify_button')
            </button>
        </div>
    </form>
</div>
@endsection
