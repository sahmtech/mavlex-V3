<details class="dropdown" style="margin: 10px;">
    <summary class="select-none select-summary">
    
 {{ isset($_GET['lang']) ? config('constants.langs')[$_GET['lang']]['full_name'] : config('constants.langs')[config('app.locale')]['full_name'] }}
 <i class="fas fa-chevron-right small-icon"></i>    
</summary>
    <ul
        class="language-dropdown-menu">
        @foreach (config('constants.langs') as $key => $val)
            <li><a value="{{ $key }}" class="change_lang dropdown-item"> {{ $val['full_name'] }}</a>
            </li>
        @endforeach
    </ul>
</details>
