@php
    $english_fonts = [
        'Roboto'     => 'Roboto',
        'Open Sans'  => 'Open Sans',
        'Lato'       => 'Lato',
        'Montserrat' => 'Montserrat',
    ];
    $arabic_fonts = [
        'Cairo'      => 'Cairo',
        'Amiri'      => 'Amiri',
        'Changa'     => 'Changa',
        'El Messiri' => 'El Messiri',
        'Noto Kufi Arabic' => 'Noto Kufi Arabic',
    ];
@endphp

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
           {!! Form::label('english_font', __('settings.english_font')) !!}@show_tooltip(__('settings.english_font_tooltip', ['url' => 'https://fonts.google.com/']))
            <div class="input-group">
                {!! Form::text('fonts[english]', $app_settings->fonts['english'] ?? 'Roboto', ['class' => 'form-control', 'placeholder' => __('settings.custom_font_placeholder'),'id'=> 'english_font_input']) !!}
                <span class="input-group-addon">{{ __('settings.or') }}</span>
                <select id="english_font_select" class="form-control">
                    <option value="">{{ __('settings.select_font') }}</option>
                    @foreach($english_fonts as $font_name)
                        <option value="{{ $font_name }}">
                            {{ $font_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <small class="help-block">{{ __('settings.font_help_text') }}</small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('arabic_font', __('settings.arabic_font')) !!}@show_tooltip(__('settings.arabic_font_tooltip', ['url' => 'https://fonts.google.com/']))
            <div class="input-group">
                {!! Form::text('fonts[arabic]', $app_settings->fonts['arabic'] ?? 'Cairo', ['class' => 'form-control', 'placeholder' => __('settings.custom_font_placeholder'),'id' => 'arabic_font_input'  ]) !!}
                <span class="input-group-addon">{{ __('settings.or') }}</span>
                <select id="arabic_font_select" class="form-control">
                    <option value="">{{ __('settings.select_font') }}</option>
                    @foreach($arabic_fonts as $font_name)
                        <option value="{{ $font_name }}">
                            {{ $font_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <small class="help-block">{{ __('settings.font_help_text') }}</small>
        </div>
    </div>
</div>

<script>
    document.getElementById('english_font_select').addEventListener('change', function(){
        document.getElementById('english_font_input').value = this.value;
        this.value = '';
    });
    document.getElementById('arabic_font_select').addEventListener('change', function(){
        document.getElementById('arabic_font_input').value = this.value;
        this.value = '';
    });
</script>
