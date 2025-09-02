@extends('layouts.auth')

@section('title', __('lang_v1.reset_password'))

@section('content')
<div class="auth-container {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="form-content reset-password-form">
        <h3 class="auth-text-heading">@lang('lang_v1.reset_password')</h3>

        @if (session('status'))
            <p class="alert alert-success">{{ session('status') }}</p>
        @else
            <p class="text-center">@lang('lang_v1.enter_email_to_reset')</p>
        @endif

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-wrapper">
                <label for="email">@lang('lang_v1.email_address')</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>
            @if ($errors->has('email'))
                <div class="input-error">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif

            <div class="input-wrapper">
                <label for="password">@lang('lang_v1.password')</label>
                <input id="password" type="password" name="password" required>
            </div>
            @if ($errors->has('password'))
                <div class="input-error">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif

            <div class="input-wrapper">
                <label for="password_confirmation">@lang('business.confirm_password')</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            @if ($errors->has('password_confirmation'))
                <div class="input-error">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif

            <div class="button-wrapper">
                <button type="submit" class="auth-button">@lang('lang_v1.reset_password')</button>
            </div>
        </form>

        <div class="form-footer">
            <p>{{ __('business.already_registered') }} <a href="{{ route('login') }}">{{ __('business.sign_in') }}</a></p>
        </div>
    </div>
</div>
@endsection
