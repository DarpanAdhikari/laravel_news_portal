<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('asset/css/error.css') }}">
    <link rel="shortcut icon" href="{{asset('asset/default_img/login-bg.jpg')}}" type="image/x-icon">
    <title>{{__('site-name')}} - 404 ERROR</title>
</head>

<body>
    <div class="noise"></div>
    <div class="overlay"></div>
    <div class="terminal">
        <h1>Error <span class="errorcode">404</span></h1>
        <p class="output">The page you are looking for might have been removed, had its name changed or is temporarily
            unavailable.</p>
        <p class="output">Please try to <a href="javascript:history.back()">go back</a> or <a href="{{ route('home') }}">return to the homepage</a>.
        </p>
        <p class="output">Good luck.</p>
    </div>
</body>

</html>
