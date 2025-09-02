@php
    $providers = [
       'facebook'  => 'Facebook',
       'x'         => 'X (formerly Twitter)',
       'linkedin'  => 'LinkedIn',
       'google'    => 'Google',
       'github'    => 'GitHub',
       'gitlab'    => 'GitLab',
       'bitbucket' => 'Bitbucket',
       'slack'     => 'Slack',
       'twitch'    => 'Twitch',
    ];
  $social_logins = $app_settings->social_logins 
        ? json_decode($app_settings->social_logins, true) 
        : [];
@endphp

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>@lang('settings.social_login_settings')</h3>
        <p class="text-muted">
            @lang('settings.social_login_settings_help')
        </p>
    </div>
    <div class="panel-body">
        @foreach($providers as $provider => $providerName)
            @php
                $redirectUrl = route('social.callback', $provider);
                $storedRedirect = $social_logins[$provider]['redirect'] ?? $redirectUrl;
                $enabled = isset($social_logins[$provider]['enabled']) ? $social_logins[$provider]['enabled'] : false;
            @endphp
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>{{ $providerName }}</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="toggle-wrapper d-flex gap-2 mt-2">
                            <p>@lang('settings.enable_social_login')</p>
                            <label class="switch" for="social_{{ $provider }}_enabled">
                                {!! Form::checkbox("social_logins[$provider][enabled]", 1, $enabled, ['id' => "social_{$provider}_enabled"]) !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("social_logins[$provider][client_id]", $providerName . ' ' . __('settings.client_id')) !!}
                        {!! Form::text("social_logins[$provider][client_id]", $social_logins[$provider]['client_id'] ?? '', [
                            'class' => 'form-control', 'placeholder' => __('settings.enter_client_id', ['provider' => $providerName])]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("social_logins[$provider][client_secret]", $providerName . ' ' . __('settings.client_secret')) !!}
                        {!! Form::text("social_logins[$provider][client_secret]", $social_logins[$provider]['client_secret'] ?? '', ['class' => 'form-control', 'placeholder' => __('settings.enter_client_secret', ['provider' => $providerName])
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("social_logins[$provider][redirect]", $providerName . ' ' . __('settings.redirect_url')) !!}
                        {!! Form::text("social_logins[$provider][redirect]", $storedRedirect, ['class' => 'form-control', 'placeholder' => __('settings.enter_redirect_url', ['provider' => $providerName]),'readonly' => true
                        ]) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
