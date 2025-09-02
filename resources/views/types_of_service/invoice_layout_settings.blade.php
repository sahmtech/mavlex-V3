<h3>@lang('lang_v1.types_of_service_module_settings')</h3>
     
<div class="setting-three-grid">
  <div class="form-box">
            {!! Form::label('types_of_service_label', __('lang_v1.types_of_service_label') . ':' ) !!}
            {!! Form::text('module_info[types_of_service][types_of_service_label]', !empty($module_info['types_of_service']['types_of_service_label']) ? $module_info['types_of_service']['types_of_service_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.types_of_service_label') ]); !!}
          </div>
          <div class="form-box">
            <div class="toggle-wrapper" style="display: flex; gap: 10px;">
              <label for="show_types_of_service" class="switchBtn">
                {!! Form::checkbox('module_info[types_of_service][show_types_of_service]', 1, !empty($module_info['types_of_service']['show_types_of_service']), ['id' => 'show_types_of_service']); !!} 
                  <span class="slider"></span>
              </label>
              <p>@lang('lang_v1.show_types_of_service')</p>
          </div>
          </div>
          <div class="form-box">
            <div class="toggle-wrapper" style="display: flex; gap: 10px;">
              <label for="show_tos_custom_fields" class="switchBtn">
                {!! Form::checkbox('module_info[types_of_service][show_tos_custom_fields]', 1, !empty($module_info['types_of_service']['show_tos_custom_fields']), ['id' => 'show_tos_custom_fields']); !!}
                  <span class="slider"></span>
              </label>
              <p>@lang('lang_v1.show_tos_custom_fields')</p>
          </div>
          </div>
        </div>