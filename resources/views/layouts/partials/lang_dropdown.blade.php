@php
    $current_lang = session('user.language', 'en');
    $all_langs = config('constants.langs');
    $allowed_langs = $app_settings->header_languages ?? [];

    if (!in_array($current_lang, $allowed_langs)) {
        $current_lang = !empty($allowed_langs) ? $allowed_langs[0] : 'en';
    }
    $current_lang_full = $all_langs[$current_lang]['full_name'] ?? $current_lang;
@endphp

<div class="dropdown" id="lang_change">
    <button class="btn btn-secondary dropdown-toggle"type="button"id="language_dropdown"data-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
        <img src="{{ asset('img/lang/' . $current_lang . '.jpg') }}" alt="{{ $current_lang_full }}" title="{{ $current_lang_full }}" style="width:35px; height:35px; margin-right:5px; border-radius:50%;">
    </button>

    <div class="dropdown-menu" aria-labelledby="language_dropdown">
        @foreach($allowed_langs as $lang_code)
            @php
                $lang_info = $all_langs[$lang_code] ?? ['full_name' => $lang_code];
                $lang_full_name = $lang_info['full_name'] ?? $lang_code;
            @endphp
            <a class="dropdown-item" href="{{ route('user.update_lang', ['lang' => $lang_code]) }}">
                <img src="{{ asset('img/lang/' . $lang_code . '.jpg') }}" alt="{{ $lang_full_name }}" style="width:20px; height:20px; margin-right:5px; border-radius:50%;">
                {{ $lang_full_name }}
            </a>
        @endforeach
    </div>
</div>
