@props([
    'name',
    'checked' => false,
    'text',
    'id' => Str::slug($name, '_'),
])

{{-- always send a 0 when it is OFF --}}
{!! Form::hidden($name, 0) !!}

<div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
    <label class="switch" for="{{ $id }}">
        {!! Form::checkbox($name, 1, $checked, ['id' => $id]) !!}
        <div class="sliderCheckbox round"></div>
    </label>
    <label class="mb-0 ml-2" for="{{ $id }}">
        {{ __($text) }}
    </label>
</div>

