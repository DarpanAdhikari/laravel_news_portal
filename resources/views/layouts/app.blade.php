<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#6284a5" />
    <meta name="msapplication-navbutton-color" content="#6284a5" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    @foreach ($logoImageUrls as $imageUrl)
    <meta name="msapplication-TileImage" content="{{$imageUrl}}" />
    @endforeach
    <meta name="msapplication-TileColor" content="#1f242d" />
    @stack('meta')
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="canonical" href="{{ url()->full() }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/home.css') }}">
    @livewireStyles
    @stack('css')
    @foreach ($logoImageUrls as $imageUrl)
        <link rel="shortcut icon" href="{{ $imageUrl }}" type="image/x-icon">
    @endforeach
    <script src="{{ asset('asset/js/home.js') }}" defer></script>
    @stack('script')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}" />
    <title>{{ __('site-name') }} - @stack('title') </title>

</head>

<body>
    <div class="top-header">
        <div class="container">
            <div class="flex justify-between items-center">
                <div class="flex justify-between items-center">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @foreach ($logoNameImageUrls as $imageUrl)
                                <img loading="lazy" src="{{ $imageUrl }}" class="object-cover h-10 select-none"
                                    alt="logo">
                            @endforeach
                        </a>
                        <span id="logo-date">{{ $nepaliDate }}
                        </span>
                    </div>
                </div>
                <div class="open-search-field min-[700px]:hidden" data-modal-target="searchEngine" data-modal-toggle="searchEngine">
                    <button class="px-2.5 py-2 rounded-full text-black outline-none shadow-inner"><i class="fas fa-search"></i></button>
                </div>
                <div class="min-[700px]:flex justify-center items-center max-[700px]:fixed max-[700px]:left-0 max-[700px]:top-0 max-[700px]:h-full max-[700px]:w-full hidden max-[700px]:z-50 max-[700px]:items-start max-[700px]:backdrop-blur-lg" id="searchEngine">
                    @livewire('search-engine')
                </div>
            </div>
        </div>
    </div>
    <nav id="navbar">
        <div class="flex justify-between h-[60px]">
            <div class="mx-3">
                <div class="header-nav" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                    <a>
                        <i class="fa-solid fa-bars-staggered"></i>
                    </a>
                </div>
                <div class="menu hide-tab hide-mobile" id="nav-items">
                    <ul class="flex justify-around w-full">
                        <li>
                            <a href="{{ route('home') }}"
                                class="{{ Route::is('home') ? 'active' : '' }}">{{ __('navigation')['name']['0'] }}</a>
                        </li>
                        @for ($i = 1; $i < count(__('navigation')['name']); $i++)
                            @php
                                $enJsonData = json_decode(file_get_contents(base_path('lang/en.json')), true);
                                $npJsonData = json_decode(file_get_contents(base_path('lang/np.json')), true);
                                $enItem = [$enJsonData['navigation']['name'][$i]];
                                $npItem = [$npJsonData['navigation']['name'][$i]];
                                $mergedItems = array_merge($enItem, $npItem);
                                $decodedUri = trim(urldecode(Request::getRequestUri()), '/');
                                $isActive = in_array($decodedUri, $mergedItems);
                            @endphp

                            <li>
                                <a href="{{ url(__('navigation')['name'][$i]) }}"
                                    class="{{ $isActive ? 'active' : '' }}">{{ __('navigation')['name'][$i] }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="flex justify-content-end">
                <div class="time flex items-center justify-center rounded-full">
                    <a><i class="far fa-clock"></i></a>
                    <span class="time-tooltip">{{ __('time')['recently'] }} {{ __('time')['update'] }}</span>
                    @php
                        $recently = __('time')['recently'];
                        $update = __('time')['update'];
                    @endphp
                    {{-- <x-up-to-bottom-drawer name="{{ $recently }} {{ $update }}"> --}}
                        <div class="flex flex-wrap gap-4 justify-center max-h-[60vh] w-full overflow-y-auto">
                            <figure class="relative max-w-sm cursor-pointer">
                                <a href="#">
                                    <img class="rounded-lg h-[195px] max-w-[240px]"
                                        src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg"
                                        alt="image description">
                                </a>
                                <figcaption
                                    class="absolute px-4 text-lg text-gray-50 bottom-6 transition-all duration-300 hover:bg-gray-300 hover:text-blue-700 hover:underline">
                                    <small>Do you want to get notified when a new component is added to
                                        Flowbite?</small>
                                </figcaption>
                            </figure>
                        </div>
                    </x-up-to-bottom-drawer>
                </div>
                <div class="time notification flex items-center hover:text-[#70c9ff] justify-center relative rounded-full"
                    data-dropdown-toggle="dropdownNotification">
                    <i class='bx bx-bell bx-tada'></i>
                    <span
                        class="absolute top-3 right-4 z-1 inline-flex items-center justify-center w-3.5 h-3.5 ms-2 text-xs font-semibold text-blue-800 bg-red-500 rounded-full">12</span>
                    <span class="time-tooltip">{{ __('notification') }}</span>
                </div>
                <x-nav-menu />
                <form action="{{ route('lang') }}" accesskey="l" method="POST"
                    class="time lang flex items-center justify-center" onclick="this.submit();">
                    @csrf
                    <input type="text" name="lang" value="{{ __('page-lang') }}" class="hidden" hidden>
                    <i class="fas fa-language"></i>
                    <span class="time-tooltip">{{ __('language-change') }}</span>
                </form>
            </div>
            <x-notification-dropdown />
        </div>
        <x-navigation-drawer>
            <li>
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'active' : '' }}">{{ __('navigation')['name']['0'] }}</a>
            </li>
            @for ($i = 1; $i < count(__('navigation')['name']); $i++)
                <li class="">
                    <a href="{{ __('navigation')['name'][$i] }}">{{ __('navigation')['name'][$i] }}</a>
                </li>
            @endfor
        </x-navigation-drawer>
    </nav>
    <div class="trending-bar hide-tab hide-mobile flex relative">
        <div class="container flex">
            <div class="trending-item">
                <ul class="flex items-center justify-center">
                    @foreach (__('hype-topics') as $topic)
                        <li title="{{ __('trending') }}"><i class='bx bx-trending-up bx-burst'></i>
                            <a href="{{ url('hashtag/' . trim($topic)) }}" data-type='tag'>{{ $topic }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <hr>

    <main class="container relative">
        {{ $slot }}

        @auth
            @php
                $permissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
            @endphp
            @if (!empty($permissions))
                <a href="{{ route('chat.index') }}"
                    class="fixed right-5 bottom-10 w-10 h-10 border-2 rounded-full z-10 hover:bg-blue-400 text-blue-500 hover:text-gray-50 hover:border-none duration-75 flex justify-center items-center shadow-2xl">
                    <i class="fab fa-facebook-messenger text-3xl"></i>
                </a>
            @endif
        @endauth

        @if (!session('subscribed') && (!auth()->check() || !auth()->user()->subscribed()->exists()))
            @livewire('subscribers')
        @endif
    </main>

    <footer class="bg-blue-100">
        <div class="mx-auto">
            <div class="footer-menu flex justify-between items-center px-4">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div class="w-full px-3">
                            <div class="flex justify-between items-start flex-wrap gap-7">
                                @for ($i = 0; $i < count(__('footerNav')['name']); $i++)
                                    <ul class="flex flex-col gap-2">
                                        <h4 class="font-bold">{{ __('footerNav')['name'][$i] }}</h4>
                                        @foreach (__('footerNav')[$i] as $item)
                                            <a href="{{ url('content/' . trim($item)) }}" data-type='tag'>
                                                <li>{{ $item }}</li>
                                            </a>
                                        @endforeach
                                    </ul>
                                @endfor
                                <ul class="flex flex-col gap-2">
                                    <h4 class="font-bold">{{ __('site-name') }}</h4>
                                    <a href="{{ route('our.team') }}">
                                        <li>{{ __('aboutSiteLink')[0] }}</li>
                                    </a>
                                    <a href="about-us">
                                        <li>{{ __('aboutSiteLink')[1] }}</li>
                                    </a>
                                    <a href="{{ route('policy.show') }}">
                                        <li>{{ __('aboutSiteLink')[2] }}</li>
                                    </a>
                                    <a href="{{ route('terms.show') }}">
                                        <li>{{ __('aboutSiteLink')[3] }}</li>
                                    </a>
                                    <a href="">
                                        <li>{{ __('aboutSiteLink')[4] }}</li>
                                    </a>
                                    @if (!session('subscribed') && (!auth()->check() || !auth()->user()->subscribed))
                                        <a id="subscribe" class="cursor-pointer">
                                            <li>Subscribe</li>
                                        </a>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue-300 pt-8 px-4">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex-1 flex items-center justify-center max-w-max">
                        @foreach ($logoImageUrls as $imageUrl)
                            <img src="{{ $imageUrl }}" alt="{{ __('site-name') }} logo" class="h-12 mr-4">
                        @endforeach
                    </div>
                    <div class="flex-1 min-w-max p-3 flex flex-col items-center justify-center">
                        @for ($i = 0; $i < count(__('aboutSiteOwner')['title']); $i++)
                            <p class="text-gray-700 text-sm font-bold font-mono"><span
                                    class="font-bold">{{ __('aboutSiteOwner')['title'][$i] }}:</span>
                                {{ __('aboutSiteOwner')['data'][$i] }}</p>
                        @endfor
                    </div>
                    <div class="flex-1 flex justify-center items-center space-x-4">
                        <a href="{{ __('facebook') }}" class="text-gray-700 hover:text-blue-500"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ __('twitter') }}" class="text-gray-700 hover:text-blue-500"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ __('instagram') }}" class="text-gray-700 hover:text-blue-500"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ __('youtube') }}" class="text-gray-700 hover:text-blue-500"><i
                                class="fab fa-youtube"></i></a>
                        <p class="text-gray-700 text-sm">© {{ date('Y') }} {{ request()->getHost() }}
                            {{ __('copy-right') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <x-page-component.page-session-dspl />
    @livewireScripts
</body>

</html>
