@extends('layouts.auth')
@section('title', __('lang_v1.reset_password'))

@section('content')
<div class="auth-container {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="form-content reset-password-form">
    <div class="details">
        <h2>@lang('lang_v1.reset_password')</h2>
        @if (session('status'))
           <p class="alert alert-success">{{ session('status') }}</p>
        @endif
        <!--<p>Welcome back.</p>-->

    </div>

    <form  method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
         <div class="input-wrapper">
            <label for="email">@lang('lang_v1.email_address')</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        @if ($errors->has('email'))
                <div class="input-error">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        
        <div class="button-wrapper">
            <button type="submit">
                @lang('lang_v1.send_password_reset_link')
            </button>
        </div>
    </form>

    <div class="form-footer">
        <p>{{ __('business.already_registered')}} 
            <a href="{{ action('Auth\LoginController@login') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">
                {{ __('business.sign_in') }}
            </a>
        </p>
    </div>
</div>
</div>
@endsection
@section('javascript')
