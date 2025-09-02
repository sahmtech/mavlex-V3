@php
    $default = [];
    $default['show_table'] = 1;
    $default['table_label'] = 'Table';

    $default['show_service_staff'] = 1;
    $default['service_staff_label'] = 'Service staff';

    if (!empty($edit_il)) {
        $default['show_table'] = isset($module_info['tables']['show_table']) ? $module_info['tables']['show_table'] : 0;
        $default['table_label'] = isset($module_info['tables']['table_label'])
            ? $module_info['tables']['table_label']
            : '';

        $default['show_service_staff'] = isset($module_info['service_staff']['show_service_staff'])
            ? $module_info['service_staff']['show_service_staff']
            : 0;

        $default['service_staff_label'] = isset($module_info['service_staff']['service_staff_label'])
            ? $module_info['service_staff']['service_staff_label']
            : '';
    }

@endphp

    <h3>@lang('lang_v1.restaurant_module_settings')</h3>
    <div class="setting-two-grid">
        @if (in_array('tables', $enabled_modules))
            <div class="form-box">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_table" class="switchBtn">
                        {!! Form::checkbox('module_info[tables][show_table]', 1, $default['show_table'], ['id' => 'show_table']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('restaurant.show_table')</p>
                </div>
            </div>
        @endif
        @if (in_array('service_staff', $enabled_modules))
            <div class="form-box">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_service_staff" class="switchBtn">
                        {!! Form::checkbox('module_info[service_staff][show_service_staff]', 1, $default['show_service_staff'], [
                            'id' => 'show_service_staff',
                        ]) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('restaurant.show_service_staff')</p>
                </div>
            </div>
        @endif
    </div>
    <div class="setting-two-grid">
        @if (in_array('tables', $enabled_modules))
            <div class="form-box">
                {!! Form::label('module_info[tables][table_label]', __('restaurant.table_label') . ':') !!}
                {!! Form::text('module_info[tables][table_label]', $default['table_label'], [
                    'class' => 'form-control',
                    'placeholder' => __('restaurant.table_label'),
                ]) !!}
            </div>
        @endif
        @if (in_array('service_staff', $enabled_modules))
            <div class="form-box">
                {!! Form::label('module_info[service_staff][service_staff_label]', __('restaurant.service_staff_label') . ':') !!}
                {!! Form::text('module_info[service_staff][service_staff_label]', $default['service_staff_label'], [
                    'class' => 'form-control',
                    'placeholder' => __('restaurant.service_staff_label'),
                ]) !!}
            </div>
        @endif
    </div>

