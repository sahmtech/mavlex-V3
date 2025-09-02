<div class="row">
{{-- ================= Maintenance Mode ================= --}}
<div class="col-sm-4">
    <div class="form-group">
        <p>@lang('settings.maintenance_mode') @show_tooltip(__('settings.maintenance_mode_tooltip'))</p>
        <div class="toggle-wrapper d-flex gap-2 mt-4">
            <label class="switch" for="maintenance_enabled">
                {!! Form::hidden('maintenance_mode[enabled]', 0) !!}
                {!! Form::checkbox('maintenance_mode[enabled]', 1, $settings->maintenance_mode['enabled'] ?? 0,
                ['id' => 'maintenance_enabled']) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
</div>


<div class="clearfix"></div>

{{-- Toggle: enable_timer --}}
<div class="col-sm-4">
    <div class="form-group">
        <p>@lang('settings.enable_countdown') @show_tooltip(__('settings.enable_timer_tooltip'))</p>
        <div class="toggle-wrapper d-flex gap-2 mt-4">
            <label class="switch" for="enable_timer">
                {!! Form::hidden('maintenance_mode[enable_timer]', 0) !!}
                {!! Form::checkbox('maintenance_mode[enable_timer]', 1, $settings->maintenance_mode['enable_timer'] ?? 0, ['id' => 'enable_timer']) !!}
                <span class="sliderCheckbox round"></span>
            </label>
        </div>
    </div>
</div>

{{-- maintenance_duration --}}
<div class="col-sm-4">
    <div class="form-group">
        {!! Form::label('maintenance_mode[duration]', __('settings.maintenance_duration')) !!}
        {!! Form::number('maintenance_mode[duration]',$settings->maintenance_mode['duration'] ?? 60,['class' => 'form-control', 'min' => 1]) !!}
    </div>
</div>

{{-- maintenance_duration_unit --}}
<div class="col-sm-4">
    <div class="form-group">
        {!! Form::label('maintenance_mode[duration_unit]', __('settings.maintenance_unit')) !!}
        {!! Form::select('maintenance_mode[duration_unit]',['minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days'],$settings->maintenance_mode['duration_unit'] ?? 'minutes',['class' => 'form-control']) !!}
    </div>
</div>

</div>