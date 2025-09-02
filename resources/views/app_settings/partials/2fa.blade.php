<div class="row">
    {{-- Toggle: enable_2fa --}}
    <div class="col-sm-4">
        <div class="form-group">
            <p>@lang('settings.enable_2fa') @show_tooltip(__('settings.enable_2fa_tooltip'))</p>
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <label class="switch" for="enable_2fa">
                    {!! Form::checkbox('two_factor_settings[enable_2fa]', 1, $app_settings->two_factor_settings['enable_2fa'] ?? false, ['id' => 'enable_2fa']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                
            </div>
        </div>
    </div>

    {{-- Toggle: force_2fa --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.force_2fa') @show_tooltip(__('settings.force_2fa_tooltip'))</p>
                <label class="switch" for="force_2fa">
                    {!! Form::checkbox('two_factor_settings[force_2fa]', 1, $app_settings->two_factor_settings['force_2fa'] ?? false, ['id' => 'force_2fa']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
               
            </div>
        </div>
    </div>

    {{-- Toggle: recommend_2fa --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.recommend_2fa') @show_tooltip(__('settings.recommend_2fa_tooltip'))</p>
                <label class="switch" for="recommend_2fa">
                    {!! Form::checkbox('two_factor_settings[recommend_2fa]', 1, $app_settings->two_factor_settings['recommend_2fa'] ?? false, ['id' => 'recommend_2fa']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                
            </div>
        </div>
    </div>

 {{--Force OTP after Social Login --}}
 <div class="col-sm-4">
    <div class="form-group">
        <div class="toggle-wrapper d-flex gap-2 mt-4">
            <p>@lang('settings.force_otp_after_social_login') @show_tooltip(__('settings.force_otp_after_social_login_tooltip'))</p>
            <label class="switch" for="force_otp_after_social">
                {!! Form::checkbox('two_factor_settings[force_otp_after_social]', 1, $app_settings->two_factor_settings['force_otp_after_social'] ?? false, ['id' => 'force_otp_after_social']) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
</div>

    {{-- Toggle: allow_disable_2fa --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.allow_disable_2fa') @show_tooltip(__('settings.allow_disable_2fa_tooltip'))</p>
                <label class="switch" for="allow_disable_2fa">
                    {!! Form::checkbox('two_factor_settings[allow_disable_2fa]', 1, $app_settings->two_factor_settings['allow_disable_2fa'] ?? false, ['id' => 'allow_disable_2fa']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                
            </div>
        </div>
    </div>

    {{-- disable_2fa_duration --}}
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('two_factor_settings[disable_2fa_duration]', __('settings.disable_2fa_duration_label')) !!}@show_tooltip(__('settings.disable_2fa_duration_label_tooltip'))
            {!! Form::number('two_factor_settings[disable_2fa_duration]', $app_settings->two_factor_settings['disable_2fa_duration'] ?? 30, ['class' => 'form-control', 'min' => 1]) !!}
        </div>
    </div>

    {{-- disable_duration_unit --}}
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('two_factor_settings[disable_duration_unit]', __('settings.disable_2fa_unit_label')) !!}
            {!! Form::select('two_factor_settings[disable_duration_unit]', ['minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'], $app_settings->two_factor_settings['disable_duration_unit'] ?? 'minutes', ['class' => 'form-control']) !!}
        </div>
    </div>

    {{-- force_2fa_after_date --}}
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('two_factor_settings[force_2fa_after_date]', __('settings.force_2fa_after_date_label')) !!}@show_tooltip(__('settings.force_2fa_after_date_label_tooltip'))
            {!! Form::datetimeLocal('two_factor_settings[force_2fa_after_date]', !empty($app_settings->two_factor_settings['force_2fa_after_date']) ? \Carbon\Carbon::parse($app_settings->two_factor_settings['force_2fa_after_date'])->format('Y-m-d\TH:i') : null, ['class' => 'form-control']) !!}
        </div>
    </div>
   
    
</div>
