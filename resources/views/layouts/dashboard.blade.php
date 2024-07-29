<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="view-transition" content="same-origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @foreach ($logoImageUrls as $imageUrl)
    <link rel="shortcut icon" href="{{$imageUrl}}" type="image/x-icon">
    @endforeach
    @stack('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    @livewireStyles
    <title>{{ __('Dashboard')}}-{{ Auth::user()->name }}</title>
</head>

<body>
    <x-page-component.page-session-dspl />

    <nav class="sidebar">
        <a href="{{route('home')}}" class="logo">
            <i class='bx bxs-tachometer'></i>
            <div class="logo-name" title="Link:Home"><span>Dash</span>board</div>
        </a>
        <ul class="side-menu first-menu">
            @php
                $permissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
            @endphp
            @if (!empty($permissions))
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class='bx bxs-dashboard'></i><span>Analysis</span>
                    </a>
                </li>
            @endif
            @canany(['add post', 'update post', 'add ads', 'changes on ads'])
                <li class="{{ Request::is('post/englishpost/create') || Request::is('post/nepalipost/create') ? 'active' : '' }}" data-dropdown-toggle="uploadDropdown"
                    data-dropdown-delay="200" data-dropdown-trigger="hover">
                    <a>
                        <i class="fas fa-file-circle-plus"></i><span>Upload</span>
                    </a>
                </li>
                <x-page-component.upload-dropdown />
            @endcanany
            @canany(['update post', 'view post', 'delete post', 'add post', 'add ads', 'changes on ads'])
                <li class="{{ Request::is('post/englishpost') || Request::is('post/nepalipost') || Route::is('get.image') || Request::is('post/englishpost/draft') || Request::is('post/nepalipost/draft') ? 'active' : '' }}" data-dropdown-toggle="changeDropdown"
                    data-dropdown-delay="200" data-dropdown-trigger="hover">
                    <a>
                        <i class='fas fa-file-pen'></i><span>Manage</span>
                    </a>
                </li>
                <x-page-component.change-dropdown />
            @endcanany
            @canany(['change role', 'block/unblock', 'view users'])
                <li class="{{ Route::is('user.table') ? 'active' : '' }}">
                    <a href="{{ route('user.table') }}">
                        <i class='bx bx-group'></i><span>Users</span>
                    </a>
                </li>
            @endcanany
            <li class="{{ Route::is('profile.show') ? 'active' : '' }}">
                <a href="{{ route('profile.show') }}">
                    <i class='fas fa-id-card'></i><span>Profile</span>
                </a>
            </li>

            <li class=" {{ Route::is('profile.security') ? 'active' : '' }}">
                <a href="{{ route('profile.security') }}">
                    <i class='bx bx-shield-quarter'></i><span>Security</span>
                </a>
            </li>
            @canany(['change on page', 'view page content', 'permission management', 'change role', 'delete role',
                'manage role'])
                <li class="{{ request()->is('dashboard/customize/*') ? 'active' : '' }}"
                    data-dropdown-toggle="customDropdown" data-dropdown-delay="200" data-dropdown-trigger="hover">
                    <a>
                        <i class="far fa-newspaper"></i><span>Customize</span>
                    </a>
                </li>
                <x-page-component.customize-dropdown />
            @endcanany
            @canany(['delete post'])
            <li class="{{ Request::is('post/entrash') || Request::is('post/nptrash') ? 'active' : '' }}" data-dropdown-toggle="trashDropdown"
                data-dropdown-delay="200" data-dropdown-trigger="hover">
                <a>
                    <i class='fas fa-trash'></i><span>Trash</span>
                </a>
            </li>
            <x-page-component.trash-dropdown />
        @endcanany
            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <li class="{{ Route::is('api-tokens.index') ? 'active' : '' }}">
                    <a href="{{ route('api-tokens.index') }}"><i class='bx bx-barcode'></i>Manage Api</a>
                </li>
            @endif
        </ul>
        <ul class="side-menu absolute bottom-0 left-0 w-full">
            <li class="logout">
                <form action="{{ route('logout') }}" method="POST" id="logout">
                    @csrf
                    <a class="logout" onclick="document.getElementById('logout').submit(); return false;"
                        title="Log Out">
                        <i class='bx bx-log-out-circle'></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <div class="content">
        <nav class="top-nav">
            <i class='bx bx-menu'></i>
            <div class="search-items">
                <div class="form-inputs">
                    <input type="search" placeholder="Search..." id="table-search">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
            <a href="{{ route('profile.show') }}"
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition profile">
                <div class="relative">
                    <img id="avatarButton" type="button" data-dropdown-placement="bottom-start"
                        class="rounded-full cursor-pointer shadow-lg ring-2"
                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    <span
                        class="top-0 start-7 absolute w-3.5 h-3.5 border-2 border-white dark:border-gray-800 rounded-full status"></span>
                </div>
            </a> 
            <a id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                class="notif relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400 cursor-pointer"
                type="button">
                <i class='bx bx-bell bx-tada'></i>
                <span class="count">12</span>
            </a>
            <div class="toggle">
                <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            </div>
           
            <x-notification-dropdown />
        </nav>
        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @stack('script')
</body>

</html>
