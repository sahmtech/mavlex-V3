@extends('layouts.app')
@section('title', __('lang_v1.my_profile'))

@section('content')
<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.user', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="setting-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.my_profile')</h1>
                <p></p>
            </div>

            <div class="filter">
                
            </div>
        </div>
        <div class="edit-profile-section">
            {!! Form::open(['url' => action('UserController@updatePassword'), 'method' => 'post', 'id' => 'edit_password_form',
        'class' => 'form-horizontal' ]) !!}
            <div class="sub-title">
                <h3>@lang('user.change_password')</h3>
            </div>

            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('current_password', __('user.current_password') . ':') !!}
                    {!! Form::password('current_password', ['placeholder' => __('user.current_password'), 'required']); !!}
                </div>

                <div class="form-box">
                    {!! Form::label('new_password', __('user.new_password') . ':') !!}
                    {!! Form::password('new_password', ['placeholder' => __('user.new_password'), 'required']); !!}
                </div>

                <div class="form-box">
                    {!! Form::label('confirm_password', __('user.confirm_new_password') . ':') !!}
                    {!! Form::password('confirm_password', ['class' => 'form-control','placeholder' =>  __('user.confirm_new_password'), 'required']); !!}
                </div>

                <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
            </div>
            {!! Form::close() !!}
        </div>
            
        {!! Form::open(['url' => action('UserController@updateProfile'), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true ]) !!}

            <div class="edit-profile-section">
                <div class="sub-title">
                    <h3>@lang('user.edit_profile')</h3>
                </div>

                <div class="setting-three-grid">
                    <div class="form-box">
                        {!! Form::label('surname', __('business.prefix') . ':') !!}
                        {!! Form::text('surname', $user->surname, ['class' => 'form-control','placeholder' => __('business.prefix_placeholder')]); !!}
                    </div>

                    <div class="form-box">
                        {!! Form::label('first_name', __('business.first_name') . ':') !!}
                        {!! Form::text('first_name', $user->first_name, ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']); !!}
                    </div>

                    <div class="form-box">
                        {!! Form::label('last_name', __('business.last_name') . ':') !!}
                        {!! Form::text('last_name', $user->last_name, ['class' => 'form-control','placeholder' => __('business.last_name')]); !!}
                    </div>

                    <div class="form-box">
                        {!! Form::label('email', __('business.email') . ':') !!}
                        {!! Form::email('email',  $user->email, ['class' => 'form-control','placeholder' => __('business.email') ]); !!}
                    </div>

                    <div class="form-box">
                        {!! Form::label('language', __('business.language') . ':') !!}
                        {!! Form::select('language',$languages, $user->language, ['class' => 'form-control select2']); !!}
                    </div>

                    <div class="form-box">
                        <div class="profile-page-information">
                            @if(!empty($user->media))
                                <div class="avatar">
                                    {!! $user->media->thumbnail([150, 150], 'img-circle') !!}
                                </div>
                            @endif

                            {!! Form::label('profile_photo', __('lang_v1.upload_image') . ':') !!}
                                {!! Form::file('profile_photo', ['id' => 'profile_photo', 'accept' => 'image/*']); !!}
                                <!-- <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])</p></small> -->
                        </div>
                        
                    </div>  
                </div>
            </div>

            @include('user.edit_profile_form_part', ['bank_details' => !empty($user->bank_details) ? json_decode($user->bank_details, true) : null])
            

            <div class="footer">
                <div class="footer-btn">
                    <button class="btn btn-default">@lang('messages.cancel')</button>
                    <button type="submit" class="primary-btn">@lang('messages.update')</button>
                </div>
            </div>
        {!! Form::close() !!}
        
    </div>
</div>

@endsection