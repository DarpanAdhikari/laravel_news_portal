<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach ($logoImageUrls as $imageUrl)
        <link rel="shortcut icon" href="{{ $imageUrl }}" type="image/x-icon">
    @endforeach
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/blank.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/chatting.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}" />
    @livewireStyles
    <title>{{ __('site-name') }} - Chat </title>
</head>

<body>
    <main>
        {{ $slot }}
    </main>
    <script src="{{asset('asset/js/blank.js')}}"></script>
    @livewireScripts
</body>

</html>
