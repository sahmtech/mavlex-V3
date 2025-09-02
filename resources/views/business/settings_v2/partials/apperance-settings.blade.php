<div class="pos-tab-content">
    <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                        $page_entries = [25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000, -1 => __('lang_v1.all')];
                        @endphp
                        {!! Form::label('default_datatable_page_entries', __('lang_v1.default_datatable_page_entries')); !!}
                        {!! Form::select('common_settings[default_datatable_page_entries]', $page_entries, !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25 ,
                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'default_datatable_page_entries']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('enable_tooltip', 0) !!}
                            <label class="switch" for="enable_tooltip">
                                {!! Form::checkbox('enable_tooltip', 1, $business->enable_tooltip, ['id' => 'enable_tooltip']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'business.show_help_text' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                @if($app_settings->enable_theme_change)
                
                @include('app_settings.partials.theme_selector')
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('primary_color', __('lang_v1.primary_color')) !!}
                        {!! Form::color('primary_color', $primary_color, ['class' => 'form-control', 'id' => 'primary_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('secondary_color',  __('lang_v1.secondary_color')) !!}
                        {!! Form::color('secondary_color', $secondary_color, ['class' => 'form-control', 'id' => 'secondary_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('sidebar_text_color', __('settings.sidebar_text_color_label')) !!}
                        {!! Form::color('sidebar_text_color', $sidebar_text_color, ['class' => 'form-control', 'id' => 'sidebar_text_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                         {!! Form::label('body_color', __('settings.body_color_label')) !!}
                        {!! Form::color('body_color', $body_color, ['class' => 'form-control', 'id' => 'body_color']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                       <br>
                        <button type="button" class="btn btn-primary" id="reset-colors">{{ __( 'lang_v1.reset_to_default' ) }}</button>
                    </div>
                </div>
                <script>
                    document.getElementById('reset-colors').addEventListener('click', function() {
                    document.getElementById('primary_color').value = '#FFB600';
                    document.getElementById('secondary_color').value = '#011530';
                });
                    </script>
                @endif
 
    </div>   
        
</div>
         