@extends('layouts.app')
@section('title', __('settings.app_settings'))

@section('content')
<div class="main-container no-print">
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
        </div>
    </div>

    <div class="card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.storage_migration')</h1>
                <p>@lang('settings.manage_uploads_data')</p>
            </div>
            <div class="filter"></div>
        </div>

        <div class="content">
            <div class="alert alert-info">
                <div>
                    <strong>@lang('settings.push')</strong>:
                    @lang('settings.local') <code>public/uploads</code> &rarr; @lang('settings.external_disk')
                </div>
                <div>
                    <strong>@lang('settings.pull')</strong>:
                    @lang('settings.external_disk') &rarr; @lang('settings.local') <code>public/uploads</code>
                </div>
                <div>@lang('settings.duplicate_files_skipped_safe_to_resume')</div>
            </div>

            {!! Form::open(['route' => 'storage.migration.run','method' => 'post','id' => 'migration-form']) !!}
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('direction', __('settings.direction'), ['class' => 'form-label']) !!}<br>
                    {!! Form::select( 'direction',['push' => __('settings.push_local_to_external'),'pull' => __('settings.pull_external_to_local'),],old('direction'),['id' => 'direction', 'class' => 'form-select', 'style' => 'max-width: 200px']) !!}
                </div>
            </div>

            @php
            $from_selected = old('from') ?? 'local';
            $to_selected = old('to') ?? ($default_external !== 'local' ? $default_external : 's3');
            @endphp

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('from', __('settings.from_disk'), ['class' => 'form-label']) !!}<br>
                    {!! Form::select('from', $disk_options, $from_selected, ['id' => 'from', 'class' => 'form-select','style' => 'max-width:200px'] ) !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('to', __('settings.to_disk'), ['class' => 'form-label']) !!}<br>
                    {!! Form::select('to',$disk_options,$to_selected,['id' => 'to', 'class' => 'form-select', 'style' => 'max-width:200px'] ) !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('visibility', __('settings.destination_visibility'), ['class' => 'form-label']) !!}<br>
                    {!! Form::select('visibility', [ '' => __('settings.visibility_none_bucket_signed'), 'public' => __('settings.visibility_public_acl'),'private' => __('settings.visibility_private_acl'),],old('visibility'),['id' => 'visibility', 'class' =>'form-select', 'style' => 'max-width: 200px']) !!}
                </div>
            </div>

            <div class="clearfix"></div>

            @php
            use Illuminate\Support\Str;
            $selected_folders = collect(old('folders', []));
            @endphp

            <div class="col-md-12">
                {!! Form::label('folders', '', ['class' => 'form-label']) !!}
                <p>
                    @lang('settings.folders_to_include_optional')
                    @show_tooltip(__('settings.folders_include_tooltip'))
                </p>

                <div class="d-flex gap-2 mb-2">
                    {!! Form::button(__('settings.select_all'), ['type' => 'button', 'class' => 'btn btn-sm btn-outline-secondary', 'id' => 'folders_select_all']) !!}
                    {!! Form::button(__('settings.none'), ['type' => 'button', 'class' => 'btn btn-sm btn-outline-secondary', 'id' => 'folders_select_none']) !!}
                    {!! Form::button(__('settings.invert'), ['type' => 'button', 'class' => 'btn btn-sm btn-outline-secondary', 'id' => 'folders_select_invert']) !!}
                </div>

                <div class="border rounded p-2">
                    <div id="folders-container" class="row g-2">
                        @forelse($local_folders as $f)
                        @php $id = 'f_'.Str::slug($f, '_'); @endphp
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="form-group">
                                <div class="toggle-wrapper d-flex gap-2 mt-4">
                                    <p class="folder-name" title="{{ $f }}">{{ $f }}</p>
                                    <label class="switch" for="{{ $id }}">
                                        {!! Form::checkbox('folders[]',$f,$selected_folders->contains($f),['class' => 'folder-toggle', 'id' => $id]) !!}
                                        <div class="sliderCheckbox round"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-muted">@lang('settings.no_suggestions_found')</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <hr>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        {!! Form::hidden('delete', 0, ['id' => 'delete_hidden']) !!}
                        <p>@lang('settings.delete_source_after_copy')</p>
                        <label class="switch" for="delete_switch">
                            {!! Form::checkbox('_delete_switch', 1, false, ['id' => 'delete_switch']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        {!! Form::hidden('dry_run', 0, ['id' => 'dry_hidden']) !!}
                        <p>@lang('settings.dry_run_plan_only')</p>
                        <label class="switch" for="dry_switch">
                            {!! Form::checkbox('_dry_switch', 1, false, ['id' => 'dry_switch']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        {!! Form::hidden('verbose', 0, ['id' => 'verbose_hidden']) !!}
                        <p>@lang('settings.verbose_log_messages')</p>
                        <label class="switch" for="verbose_switch">
                            {!! Form::checkbox('_verbose_switch', 1, false, ['id' => 'verbose_switch']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>

            @php $current_run_mode = old('run_mode', 'job'); @endphp
            {!! Form::hidden('run_mode', $current_run_mode, ['id' => 'run_mode']) !!}
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label d-block">
                        <p>@lang('settings.execution') @show_tooltip(__('settings.execution_tooltip_html'))</p>
                    </label>
                    <small class="text-muted">@lang('settings.pick_how_to_execute')</small>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <p>@lang('settings.background_job_recommended')</p>
                        <label class="switch" for="run_mode_job_toggle">
                            {!! Form::checkbox('_run_mode_job_toggle', 1, $current_run_mode !== 'direct', ['id' => 'run_mode_job_toggle']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <p>@lang('settings.run_direct_now')</p>
                        <label class="switch" for="run_mode_direct_toggle">
                            {!! Form::checkbox('_run_mode_direct_toggle', 1, $current_run_mode === 'direct', ['id' => 'run_mode_direct_toggle']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
            <div id="progress-card" class="card mt-4 col-md-12" style="display:none;">
                <div class="card-body">
                    <h5 class="card-title">@lang('settings.progress')</h5>
                    <div class="progress mb-2">
                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                    </div>
                    <pre id="progress-text" class="bg-light p-2" style="height: 200px; overflow:auto;"></pre>
                </div>
            </div>
            </div>
            <div class="row">
            <div id="result-card" class="card mt-4 col-md-12" style="display:none;">
                <div class="card-body">
                    <h5 class="card-title">@lang('settings.result')</h5>
                    <pre id="result-text" class="bg-light p-2" style="height: 200px; overflow:auto;"></pre>
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12 text-center">
                {!! Form::button(__('settings.start_migration'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'startBtn']) !!}
                {!! Form::button(__('settings.reset'), ['type' => 'button', 'class' => 'btn btn-outline-secondary', 'id' => 'resetBtn']) !!}
                </div>
            </div>
           
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
(function(){
  var i18n_strings = @js([
    'from' => __('settings.from'),
    'to' => __('settings.to'),
    'folders' => __('settings.folders'),
    'total' => __('settings.total'),
    'copied' => __('settings.copied'),
    'skipped' => __('settings.skipped'),
    'deleted' => __('settings.deleted'),
    'failed' => __('settings.failed'),
    'invalid_response' => __('settings.invalid_response'),
    'failed_to_start' => __('settings.failed_to_start_migration'),
    'confirm_delete' => __('settings.confirm_delete_source'),
  ]);

  var default_external = @json($default_external);

  function set_defaults() {
    var direction_value = document.getElementById('direction').value;
    var from_el = document.getElementById('from');
    var to_el   = document.getElementById('to');

    if (direction_value === 'push') {
      from_el.value = 'local';
      to_el.value = default_external || 's3';
    } else {
      from_el.value = default_external || 's3';
      to_el.value = 'local';
    }
  }

  function sync_hidden(id_switch, id_hidden) {
    var switch_el = document.getElementById(id_switch);
    var hidden_el = document.getElementById(id_hidden);
    var update_hidden = function(){ hidden_el.value = switch_el.checked ? 1 : 0; };
    update_hidden(); switch_el.addEventListener('change', update_hidden);
  }

  function confirm_destructive() {
    var delete_enabled = document.getElementById('delete_switch').checked;
    if (!delete_enabled) return true;
    return confirm(i18n_strings.confirm_delete);
  }

  function calc_percent(copied, skipped, failed, total) {
    var done = copied + skipped + failed;
    if (total <= 0) return 0;
    return Math.min(100, Math.round((done / total) * 100));
  }

  function show_progress() {
    document.getElementById('progress-card').style.display = 'block';
  }

  function update_progress_view(status) {
    var bar_el = document.getElementById('progress-bar');
    var pre_el = document.getElementById('progress-text');

    var p = calc_percent(status.copied, status.skipped, status.failed, status.total);
    bar_el.style.width = p + '%';
    bar_el.textContent = p + '%';

    var lines = [];
    lines.push(i18n_strings.from + ': ' + status.from + '  \u2192  ' + i18n_strings.to + ': ' + status.to);
    if (status.only && status.only.length) lines.push(i18n_strings.folders + ': ' + status.only.join(', '));
    lines.push(
      i18n_strings.total + ': ' + status.total +
      ' | ' + i18n_strings.copied + ': ' + status.copied +
      ' | ' + i18n_strings.skipped + ': ' + status.skipped +
      ' | ' + i18n_strings.deleted + ': ' + status.deleted +
      ' | ' + i18n_strings.failed + ': ' + status.failed
    );
    if (status.message) lines.push(status.message);
    pre_el.textContent = lines.join('\n');
  }

  function get_run_mode() {
    var el = document.getElementById('run_mode');
    return el ? (el.value || 'job') : 'job';
  }
  function set_run_mode(val) {
    var el = document.getElementById('run_mode');
    if (el) el.value = (val === 'direct') ? 'direct' : 'job';
    var job_toggle    = document.getElementById('run_mode_job_toggle');
    var direct_toggle = document.getElementById('run_mode_direct_toggle');
    if (job_toggle)    job_toggle.checked    = (val !== 'direct');
    if (direct_toggle) direct_toggle.checked = (val === 'direct');
  }

  function init_run_mode_toggles() {
    var job_toggle    = document.getElementById('run_mode_job_toggle');
    var direct_toggle = document.getElementById('run_mode_direct_toggle');

    set_run_mode(get_run_mode());

    if (job_toggle) job_toggle.addEventListener('change', function() {
      if (job_toggle.checked) set_run_mode('job'); else set_run_mode('job');
    });
    if (direct_toggle) direct_toggle.addEventListener('change', function() {
      if (direct_toggle.checked) set_run_mode('direct'); else set_run_mode('direct');
    });
  }

  function hide_progress_and_result() {
    document.getElementById('progress-card').style.display = 'none';
    document.getElementById('result-card').style.display = 'none';
  }

  var poll_timer = null;
  function start_polling(id) {
    if (poll_timer) clearInterval(poll_timer);
    poll_timer = setInterval(async function () {
      var res = await fetch('{{ route('storage.migration.status', ['id' => '___ID___']) }}'.replace('___ID___', id));
      if (!res.ok) return;
      var json = await res.json();
      if (!json.ok) return;
      var status = json.status;
      update_progress_view(status);
      if (status.done) clearInterval(poll_timer);
    }, 1500);
  }

  document.addEventListener('DOMContentLoaded', function(){
    init_run_mode_toggles();
    set_defaults();
    document.getElementById('direction').addEventListener('change', set_defaults);

    sync_hidden('delete_switch', 'delete_hidden');
    sync_hidden('dry_switch', 'dry_hidden');
    sync_hidden('verbose_switch', 'verbose_hidden');

    document.getElementById('resetBtn').addEventListener('click', function(){
      document.getElementById('migration-form').reset();
      set_defaults();
    });

    document.getElementById('migration-form').addEventListener('submit', async function(e){
      e.preventDefault();
      if (!confirm_destructive()) return;

      var start_btn = document.getElementById('startBtn');
      start_btn.disabled = true;

      var run_mode = get_run_mode();
      hide_progress_and_result();

      var form_el = e.target;
      var form_data = new FormData(form_el);
      if (run_mode === 'job') {
        document.getElementById('progress-card').style.display = 'block';
      }

      var res = await fetch(form_el.action, {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}, body: form_data});
      var json = await res.json().catch(function(){ return {ok:false, error:i18n_strings.invalid_response}; });

      if (!json.ok) {
        alert(json.error || i18n_strings.failed_to_start);
        start_btn.disabled = false;
        return;
      }

      if (json.mode === 'direct') {
        var result = json.summary || {};
        var lines = [];
        lines.push(i18n_strings.from + ': ' + (result.from || '') + '  \u2192  ' + i18n_strings.to + ': ' + (result.to || ''));
        if (Array.isArray(result.only) && result.only.length) lines.push(i18n_strings.folders + ': ' + result.only.join(', '));
        lines.push(
          i18n_strings.total + ': ' + result.total +
          ' | ' + i18n_strings.copied + ': ' + result.copied +
          ' | ' + i18n_strings.skipped + ': ' + result.skipped +
          ' | ' + i18n_strings.deleted + ': ' + result.deleted +
          ' | ' + i18n_strings.failed + ': ' + result.failed
        );
        if (result.message) lines.push(result.message);
        document.getElementById('result-text').textContent = lines.join('\n');
        document.getElementById('result-card').style.display = 'block';
        start_btn.disabled = false;
        return;
      }

      if (json.id) {
        document.getElementById('progress-card').style.display = 'block';
        start_polling(json.id);
      }

      start_btn.disabled = false;
    });
  });
})();
</script>

<script>
(function(){
  function query_all(sel, root){ return Array.prototype.slice.call((root||document).querySelectorAll(sel)); }

  document.addEventListener('DOMContentLoaded', function(){
    var container_el = document.getElementById('folders-container');
    if (!container_el) return;

    function all_cbs(){
      return query_all('input.folder-toggle[name="folders[]"]', container_el);
    }

    var btn_all  = document.getElementById('folders_select_all');
    var btn_none = document.getElementById('folders_select_none');
    var btn_inv  = document.getElementById('folders_select_invert');

    if (btn_all)  btn_all.addEventListener('click',  function(){ all_cbs().forEach(function(cb){ cb.checked = true;  }); });
    if (btn_none) btn_none.addEventListener('click', function(){ all_cbs().forEach(function(cb){ cb.checked = false; }); });
    if (btn_inv)  btn_inv.addEventListener('click',  function(){ all_cbs().forEach(function(cb){ cb.checked = !cb.checked; }); });
  });
})();
</script>
@endsection
