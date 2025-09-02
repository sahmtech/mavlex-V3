<div class="row">
    <div class="col-sm-12">
        <h4>@lang('settings.pos_performance_settings')</h4>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.enable_instant_pos')
                    @show_tooltip(__('settings.enable_instant_pos_tooltip'))
                </p>
                <label class="switch" for="enable_instant_pos">
                    {!! Form::checkbox('enable_instant_pos', 1, $app_settings->enable_instant_pos ?? false, ['id' => 'enable_instant_pos']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
            <p class="help-block">@lang('settings.enable_instant_pos_help')</p>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.enable_instant_search')
                    @show_tooltip(__('settings.enable_instant_search_tooltip'))
                </p>
                <label class="switch" for="enable_instant_search">
                    {!! Form::checkbox('enable_instant_search', 1, $app_settings->enable_instant_search ?? false, ['id' => 'enable_instant_search']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
            <p class="help-block">@lang('settings.enable_instant_search_help')</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="callout callout-info">
            <h4><i class="fa fa-info-circle"></i> @lang('settings.pos_performance_info_title')</h4>
            <p>@lang('settings.pos_performance_info_desc')</p>
            <ul>
                <li>@lang('settings.instant_pos_benefit_1')</li>
                <li>@lang('settings.instant_pos_benefit_2')</li>
                <li>@lang('settings.instant_pos_benefit_3')</li>
                <li>@lang('settings.instant_pos_benefit_4')</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h4>@lang('settings.pos_cache_settings')</h4>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('pos_cache_refresh_interval', __('settings.pos_cache_refresh_interval')) !!}
            @show_tooltip(__('settings.pos_cache_refresh_interval_tooltip'))
            {!! Form::select('pos_cache_refresh_interval', [
                'auto' => __('settings.auto_refresh'),
                '30' => __('settings.30_minutes'),
                '60' => __('settings.60_minutes'),
                '120' => __('settings.2_hours'),
                'manual' => __('settings.manual_only')
            ], $app_settings->pos_cache_refresh_interval ?? 'auto', ['class' => 'form-control']) !!}
            <p class="help-block">@lang('settings.pos_cache_refresh_interval_help')</p>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('pos_max_cached_products', __('settings.pos_max_cached_products')) !!}
            @show_tooltip(__('settings.pos_max_cached_products_tooltip'))
            {!! Form::select('pos_max_cached_products', [
                '500' => '500 ' . __('report.products'),
                '1000' => '1000 ' . __('report.products'),
                '2000' => '2000 ' . __('report.products'),
                '5000' => '5000 ' . __('report.products'),
                '10000' => '10000 ' . __('report.products'),
                '0' => __('settings.unlimited')
            ], $app_settings->pos_max_cached_products ?? 1000, ['class' => 'form-control']) !!}
            <p class="help-block">@lang('settings.pos_max_cached_products_help')</p>
        </div>
    </div>
</div>