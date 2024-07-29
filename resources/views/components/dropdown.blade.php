    <!-- Dropdown menu -->
    <div id="userDropdown"
        class="z-50 hidden divide-y rounded-lg  shadow-lg w-44 bg-[#2260bf] dark:bg-gray-700 dark:divide-gray-600 mt-0">
        @auth
            <ul class="py-2 text-sm text-gray-200 dark:text-gray-200" aria-labelledby="avatarButton">
                @php
                    $permissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
                @endphp
                @if (!empty($permissions))
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                        <li class="{{ route('dashboard') == url()->current() ? 'active' : '' }}">
                            <i class='bx bxs-dashboard'></i>Dashboard
                        </li>
                    </a>
                @endif


                <a href="{{ route('profile.show') }}"
                    class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                    <li>
                        <i class="fa-solid fa-id-card"></i> {{ __('Profile') }}
                    </li>
                </a>


                <a href="{{ route('profile.security') }}"
                    class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                    <li>
                        <i class='fas fa-shield-virus'></i> {{ __('Security') }}
                    </li>
                </a>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <a href="{{ route('api-tokens.index') }}"
                        class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                        <li><i class="fa-sharp fa-solid fa-code-pull-request"></i>Manage Api</li>
                    </a>
                @endif
            </ul>
            <div class="py-1">
                <form action="{{ route('logout') }}" method="POST" id="logout" class="block cursor-pointer px-4 py-2 text-sm dark:text-gray-200 font-black hover:text-[#70c9ff] text-gray-200 rounded-md ease-in duration-300">
                    @csrf
                    <span
                        onclick="document.getElementById('logout').submit(); return false;">
                        <i class="fa-solid fa-right-from-bracket rotate-180"></i>
                        Logout
                    </span>
                </form>
            </div>
        @else
            <ul class="py-2 text-sm text-gray-200 dark:text-gray-200" aria-labelledby="avatarButton">

                <a href="{{ route('login') }}"
                    class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                    <li><i class="fa-solid fa-right-to-bracket"></i> {{ __('Log In') }}</li>
                </a>


                <a href="{{ route('register') }}"
                    class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white font-black rounded-md ease-in duration-300">
                    <li><i class="fas fa-user-plus"></i> {{ __('Register') }}</li>
                </a>

            </ul>
        @endauth
    </div>
