
{{-- ===========  SIDEBAR LAYOUT CHOICE  ===========--}}
<div class="row g-3">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.enable_custom_sidebar_logo')
                   @show_tooltip(__('settings.enable_custom_sidebar_logo_tooltip'))</p>
                <label class="switch" for="enable_custom_sidebar_logo">
                    {!! Form::checkbox( 'enable_custom_sidebar_logo',1,$app_settings->enable_custom_sidebar_logo, ['id' => 'enable_custom_sidebar_logo']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('sidebar_layout', __('settings.sidebar_layout')) !!}<br>
            {!! Form::select('sidebar_layout',['layout1' => __('settings.sidebar_layout_1'),'layout2' => __('settings.sidebar_layout_2'),'custom'  => __('settings.sidebar_layout_custom'),],$app_settings->sidebar_layout ?? 'layout1',['id' => 'sidebar_layout', 'class' => 'form-select'] ) !!}
        </div>
    </div>


    <div class="col-sm-4 sidebar-dropdown-wrapper">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.enable_sidebar_dropdown')
                   @show_tooltip(__('settings.enable_sidebar_dropdown_tooltip'))</p>
                <label class="switch" for="enable_sidebar_dropdown">
                    {!! Form::checkbox( 'enable_sidebar_dropdown', 1, $app_settings->enable_sidebar_dropdown, ['id' => 'enable_sidebar_dropdown']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-4 custom-sidebar-type-wrapper">
        <div class="form-group">
            {!! Form::label('custom_sidebar_type', __('settings.custom_sidebar_type')) !!}<br>
            {!! Form::select('custom_sidebar_type',['sidebar' => __('settings.sidebar'), 'topbar' => __('settings.topbar')],$app_settings->custom_sidebar_type ?? 'sidebar',['id' => 'custom_sidebar_type', 'class' => 'form-select']) !!}
        </div>
    </div>
</div> 