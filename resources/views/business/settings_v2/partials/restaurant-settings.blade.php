<div class="pos-tab-content">
    <div class="row">
            <div class="col-sm-4" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.enable_restaurant_module_tooltip')" data-html="true">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('restaurant_settings[enable_restaurant_module]', 0) !!}
                        <label class="switch" for="enable_restaurant_module">
                            {!! Form::checkbox('restaurant_settings[enable_restaurant_module]', 1, $restaurant_settings['enable_restaurant_module'], ['id' => 'enable_restaurant_module']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_restaurant_module' ) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 toggle-item" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.enable_kot_tooltip')" data-html="true">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('restaurant_settings[enable_kot]', 0) !!}
                        <label class="switch" for="enable_kot">
                      
                       
                            {!! Form::checkbox('restaurant_settings[enable_kot]', 1, $restaurant_settings['enable_kot'], ['id' => 'enable_kot']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_kot' ) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 toggle-item" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.enable_running_orders_tooltip')" data-html="true">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('restaurant_settings[enable_running_orders]', 0) !!}
                        <label class="switch" for="enable_running_orders">
                           
                       
                            {!! Form::checkbox('restaurant_settings[enable_running_orders]', 1, $restaurant_settings['enable_running_orders'], ['id' => 'enable_running_orders']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_running_orders' ) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 toggle-item" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.enable_order_type_tooltip')" data-html="true">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('restaurant_settings[enable_order_type]', 0) !!}
                        <label class="switch" for="enable_order_type">
                           
                       
                            {!! Form::checkbox('restaurant_settings[enable_order_type]', 1, $restaurant_settings['enable_order_type'], ['id' => 'enable_order_type']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_order_type' ) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 toggle-item" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.order_type_required_tooltip')" data-html="true">
    <div class="form-group">
        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
            {!! Form::hidden('restaurant_settings[order_type_required]', 0) !!}
            <label class="switch" for="order_type_required">                       
                {!! Form::checkbox('restaurant_settings[order_type_required]', 1, ($restaurant_settings['order_type_required'] ?? 0), ['id' => 'order_type_required']) !!}
            <div class="sliderCheckbox round"></div>
            </label>
            <p>{{ __( 'lang_v1.order_type_required' ) }}</p>
        </div>
    </div>
</div>

<div class="col-sm-4 toggle-item" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.default_order_type_tooltip')" data-html="true">
    <div class="form-group">
        <label for="default_order_type">{{ __('lang_v1.default_order_type') }}</label>
        {!! Form::select('restaurant_settings[default_order_type]', [
            '' => __('lang_v1.select_order_type'),
            'dine_in' => __('lang_v1.dine_in'),
            'takeaway' => __('lang_v1.take_away'),
            'delivery' => __('lang_v1.delivery')
        ], !empty($restaurant_settings['default_order_type']) ? $restaurant_settings['default_order_type'] : '', ['class' => 'form-control', 'id' => 'default_order_type']) !!}
    </div>
</div>


</div>
</div>
