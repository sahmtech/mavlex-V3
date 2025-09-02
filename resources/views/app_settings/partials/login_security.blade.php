<div class="row">
    {{-- Enable User Lock --}}
    <div class="col-sm-4">
        <div class="form-group">
            <p>
                @lang('settings.enable_user_lock_label')
                @show_tooltip(__('settings.enable_user_lock_tooltip'))
            </p>
            <label class="switch mt-4" for="user_lock_enabled">
                {!! Form::checkbox('user_lock[enabled]', 1, $app_settings->user_lock['enabled'] ?? false, ['id' => 'user_lock_enabled']) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <p>@lang('settings.force_email_verify') 
               @show_tooltip(__('settings.force_email_verify_tooltip'))
            </p>
            <label class="switch mt-4">
                {!! Form::checkbox(
                    'force_email_verify',
                    1,
                    $app_settings->force_email_verify,
                    ['id' => 'force_email_verify']
                ) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <p>@lang('settings.temp_email_protection') 
               @show_tooltip(__('settings.temp_email_protection_tooltip'))
            </p>
            <label class="switch mt-4">
                {!! Form::checkbox('temp_email_protection',1,$app_settings->temp_email_protection,['id' => 'temp_email_protection']) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
    <div class="clearfix"></div>

    {{-- Maximum Login Attempts --}}
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('user_lock_max_attempts', __('settings.max_login_attempts_label')) !!}
            @show_tooltip(__('settings.max_login_attempts_tooltip'))

            {!! Form::number(
                'user_lock[max_attempts]',
                $app_settings->user_lock['max_attempts'] ?? 4,
                ['class' => 'form-control', 'min' => 1, 'id' => 'user_lock_max_attempts']
            ) !!}
        </div>
    </div>

    {{-- Lock Duration --}}
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('user_lock_time', __('settings.lock_duration_label')) !!}
            @show_tooltip(__('settings.lock_duration_tooltip'))

            {!! Form::number(
                'user_lock[lock_time]',
                $app_settings->user_lock['lock_time'] ?? 20,
                ['class' => 'form-control', 'min' => 1, 'id' => 'user_lock_time']
            ) !!}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('user_lock_duration_unit', __('settings.lock_duration_unit_label')) !!}
            @show_tooltip(__('settings.lock_duration_unit_tooltip'))

            {!! Form::select(
                'user_lock[duration_unit]',
                ['minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'],
                $app_settings->user_lock['duration_unit'] ?? 'minutes',
                ['class' => 'form-control', 'id' => 'user_lock_duration_unit']
            ) !!}
        </div>
    </div>
</div>

<button id="sync-btn"type="button"class="btn btn-primary">@lang('settings.sync_disposable_list')</button>
  
<script>
  document.getElementById('sync-btn').addEventListener('click', function(e) {
    const btn = this;
    btn.disabled = true;
    btn.innerText = '{{ __("settings.syncing") }}';

    fetch("{{ route('settings.syncDisposable') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
      },
    })
    .then(res => res.json())
    .then(json => {
      btn.disabled = false;
      btn.innerText = '{{ __("settings.sync_disposable_list") }}';
      alert(json.message || '{{ __("settings.sync_disposable_success") }}');
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = '{{ __("settings.sync_disposable_list") }}';
      alert('{{ __("settings.sync_disposable_failed") }}');
    });
  });
</script>