{{-- ===========  BUSINESS-SETTINGS LAYOUT  ===========--}}
<div class="row">
<div class="col-sm-4">
    <div class="form-group">
        {!! Form::label('business_settings_layout', __('settings.business_settings_layout')) !!}<br>
        {!! Form::select(
            'business_settings_layout',
            [
                'layout1' => __('settings.layout_1'),      // classic tabs
                'layout2' => __('settings.layout_2'),      // modern sidebar
            ],
            $app_settings->business_settings_layout ?? 'layout1',
            ['id' => 'business_settings_layout', 'class' => 'form-select']
        ) !!}
    </div>
</div>
</div>