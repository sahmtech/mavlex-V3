@php $all_langs = []; foreach (config('constants.langs') as $code => $lang_info) { $all_langs[$code] = $lang_info['full_name']; } $selected_langs = $app_settings->header_languages ?? []; @endphp
<div class="row">
    {{-- header_language_change --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>@lang('settings.header_language_change') @show_tooltip(__('settings.header_language_change_tooltip'))</p>
                <label class="switch" for="header_language_change">
                    {!! Form::checkbox('header_language_change', 1, $app_settings->header_language_change, ['id' => 'header_language_change']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                
            </div>
        </div>
    </div>
    {{-- header_languages --}}
    <div class="col-sm-8">
        <div class="form-group mt-4">
            {!! Form::label('header_languages', __('settings.header_languages_label')) !!} @show_tooltip(__('settings.header_languages_label_tooltip'))
            {!! Form::select('header_languages[]', $all_langs, $selected_langs, ['class' => 'form-control select2', 'multiple' => true, 'id' => 'header_languages', 'data-placeholder' => __('settings.select_languages_placeholder')]) !!}
        </div>
    </div>
</div>
