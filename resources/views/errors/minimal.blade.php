<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error -  @yield('code')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    
    <div class="error-page">
        <div>
            <img src="{{asset('img/pictures/disconnect.svg')}}" alt="" class="error-icon">
        </div>
        
        <div class="error-pattern">
            <h1>@yield('code')</h1>
            <h3>@yield('message')</h3>
            <p>@lang('lang_v1.404_page')</p>
            <a href="{{route('home')}}">@lang('lang_v1.home')</a>
        </div>
    </div>

    <!-- Javascript file -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>

