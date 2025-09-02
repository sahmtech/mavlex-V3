@extends('layouts.auth')
@section('title', __('lang_v1.register'))

@section('stylesheet')
    <style type="text/css">

.wizard > .content {
    background: #fff !important;
}

.right-col label {
    color: #111827;
    font-size: 14px;
}

.input-group .input-group-addon {
    border-radius: 5px 0px 0px 5px;
    border-color: #d2d6de;
    background-color: #fff;
}

.wizard>.content>.body input {
    display: block;
    border: 1px solid #ccc;
    border-left: none;
}

.input-group .input-group-addon .fa {
    position: relative;
    left: 7px;
}


.input-group-addon .fas {
    position: relative;
    left: 7px;
}
.form-content {
    width: 800px !important;
    margin: 0 auto;
    margin-top: 5.188rem;
    max-width: 100%;
}
.auth-layout .auth-form .form-content {
    width: 800px !important;
    margin: 0 auto;
    margin-top: 5.188rem;
    max-width: 100%;
}.wizard>.steps .current a, .wizard>.steps .current a:active, .wizard>.steps .current a:hover {
    background: #111827;
    color: #fff;
    cursor: default;
    font-size: 0.75rem;
}
.wizard > .steps .done a,
.wizard > .steps .done a:active,
.wizard > .steps .done a:hover {
    background: #4a5d6f;
    color: #fff;
    cursor: default;
    font-size: 0.75rem;
}

.wizard>.steps .disabled a, .wizard>.steps .disabled a:active, .wizard>.steps .disabled a:hover {
    background: #eee;
    color: #aaa;
    cursor: default;
    font-size: 0.75rem;
}


.previous-btn {
    background-color: #6c757d!important; 
    color: #ffffff; 
    font-weight: 500;
    font-size: large;
}

.previous-btn:disabled {
    background-color: #adb5bd;
    color: #ffffff; 
}

.next-btn {
    background-color: var(--primary-color) !important;
    color: #ffffff; 
    font-weight: 500;
    font-size: large;
}

.next-btn:hover {
    background-color: var(--primary-color) !important;
}
.login-layout .auth-logo img {
      margin-top: 25px;
  }

.input-group-addon .fas {
    position: relative;
    left: 7px;
}
    </style>
@endsection
@section('content')

<div class="form-content register-form">
{!! Form::open(['url' => route('business.postRegister'),'method' => 'post','id' => 'business_register_form','files' => true]) !!}
            
            @include('business.partials.register_form')
            {!! Form::hidden('package_id', $package_id) !!}
            {!! Form::close() !!}
</div>
@stop
