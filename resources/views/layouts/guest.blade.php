<!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" referrerpolicy="no-referrer" />
      @foreach ($logoImageUrls as $imageUrl)
    <link rel="shortcut icon" href="{{$imageUrl}}" type="image/x-icon">
    @endforeach
      <link rel="preconnect" href="https://fonts.bunny.net">
       @vite(['resources/css/app.css', 'resources/js/app.js'])
      <link rel="stylesheet" href="{{ asset('asset/css/user.css') }}"/>
     <link rel="stylesheet" href="{{asset('asset/css/custom.css')}}" />
      <title>{{ __('site-name') }} @stack('app_name')</title>
   </head>
   <body>
      <div class="login">
         <a href="{{ route('home') }}" class="fixed top-0 left-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0L5 9m-4-4L5 1"/>
               </svg>   
            <span class="sr-only">Back Home</span>
            </a>
         {{ $slot }}
      </div>
      @stack('javascript')
   </body>
</html>