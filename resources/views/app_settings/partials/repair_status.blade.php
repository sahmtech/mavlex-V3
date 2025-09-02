<div class="row">
    {{-- show_repair_status_login_screen --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.show_repair_status_login_screen')</p>
                <label class="switch" for="show_repair_status_login_screen">
                    {!! Form::checkbox('show_repair_status_login_screen', 1, $app_settings->show_repair_status_login_screen, ['id' => 'show_repair_status_login_screen']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                
            </div>
        </div>
    </div>
</div>
