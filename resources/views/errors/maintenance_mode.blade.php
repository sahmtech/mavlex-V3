

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('settings.under_maintenance')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @php
        $s = app(\App\Services\AppSettingsService::class);
        $secondsLeft = $s->maintenance_seconds_left();
    @endphp

    <div class="error-page">
        <div>
            <img src="{{ asset('img/pictures/disconnect.svg') }}"
                 alt="@lang('settings.under_maintenance')"
                 class="error-icon">
        </div>
        <div class="error-pattern">
            <h1>@lang('settings.under_maintenance')</h1>

            <h2>
                @lang('settings.maintenance_heading')<br>
                @lang('settings.maintenance_subheading')
            </h2>

            @if($s->maintenance_timer_enabled() && $secondsLeft > 0)
                <p>
                    {!! __('settings.maintenance_back_in', [
                        'time' => "<span id=\"countdown\" class=\"timer\">—:—:—</span>"
                    ]) !!}
                </p>
            @else
                <p>@lang('settings.maintenance_back_no_timer')</p>
            @endif

            <a href="{{ route('logout') }}" class="home-link">
                @lang('lang_v1.logout')
            </a>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
      
            function two_digit(n) { return (n < 10 ? '0' : '') + n; }
        
            function format_time(seconds) {
                var days    = Math.floor(seconds / 86400);
                seconds     = seconds % 86400;
                var hours   = Math.floor(seconds / 3600);
                seconds     = seconds % 3600;
                var minutes = Math.floor(seconds / 60);
                var secs    = seconds % 60;
        
                return (days ? days + 'd ' : '') +
                       two_digit(hours)   + ':' +
                       two_digit(minutes) + ':' +
                       two_digit(secs);
            }
        
            var countdown_el = document.getElementById('countdown');
            var seconds_left = {{ $secondsLeft }};
        
            if (countdown_el) {
                countdown_el.textContent = format_time(seconds_left);
            }
            if (seconds_left <= 0) {
                location.reload(true);
                return;
            }
            var timer_id = setInterval(function () {
                seconds_left--;
        
                if (seconds_left <= 0) {
                    clearInterval(timer_id);
                    location.reload(true);  
                    return;
                }
        
                if (countdown_el) {
                    countdown_el.textContent = format_time(seconds_left);
                }
            }, 1000);
        });
        </script>
</body>
</html>
