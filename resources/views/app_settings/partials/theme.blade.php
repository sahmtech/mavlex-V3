<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.allow_theme_change')
                    @show_tooltip(__('settings.allow_theme_change_tooltip'))
                </p>
                <label class="switch" for="enable_theme_change">
                    {!! Form::checkbox('enable_theme_change', 1, $app_settings->enable_theme_change, ['id' => 'enable_theme_change']) !!}
                     <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>
    @include('app_settings.partials.theme_selector')
    <div class="col-sm-4">
        <div class="form-group">
            <br>
            <button type="button" class="btn btn-primary" id="reset-colors">
                {{ __( 'lang_v1.reset_to_default' ) }}
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('primary_color', __('settings.primary_color_label')) !!}
            @show_tooltip(__('settings.primary_color_label_tooltip'))
            {!! Form::color( 'theme_settings[primary_color]', $app_settings->theme_settings['primary_color'] ??
            '#FFB600', ['class' => 'form-control', 'id' => 'primary_color'] ) !!}
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('secondary_color', __('settings.secondary_color_label')) !!}
            @show_tooltip(__('settings.secondary_color_label_tooltip'))
            {!! Form::color( 'theme_settings[secondary_color]',$app_settings->theme_settings['secondary_color'] ??
            '#011530',['class' => 'form-control', 'id' => 'secondary_color']) !!}
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('body_color', __('settings.body_color_label')) !!}
            @show_tooltip(__('settings.body_color_label_tooltip'))
            {!! Form::color('theme_settings[body_color]',$app_settings->theme_settings['body_color'] ??
            '#F8F9FF',['class' => 'form-control', 'id' => 'body_color']) !!}
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('sidebar_text_color', __('settings.sidebar_text_color_label')) !!}
            @show_tooltip(__('settings.sidebar_text_color_label_tooltip'))
            {!! Form::color('theme_settings[sidebar_text_color]', $app_settings->theme_settings['sidebar_text_color'] ??
            '#FFFFFF',['class' => 'form-control', 'id' => 'sidebar_text_color']) !!}
        </div>
    </div>
</div>
