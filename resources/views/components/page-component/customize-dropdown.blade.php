<div id="customDropdown"
    class="z-10 hidden bg-[#f6f6f9] divide-y divide-gray-100 rounded-lg shadow-lg w-full dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
        @canany(['change on page', 'view page content'])
            <li class="{{ request()->is('dashboard/customize/edit/*') ? 'active' : '' }}">
                <a href="{{ route('customize.page_info') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fab fa-pagelines"></i><span>Edit Page</span>
                </a>
            </li>
        @endcanany
        @canany(['delete role','manage role'])
            <li class="{{ request()->is('roles') ? 'active' : '' }}">
                <a href="{{ url('roles') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fas fa-user-check"></i><span>Roles</span>
                </a>
            </li>
        @endcanany
        @can('permission management')
        <li class="{{ request()->is('permissions') ? 'active' : '' }}">
            <a href="{{ url('permissions') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fas fa-user-check"></i><span>Permissions</span>
            </a>
        </li>
        @endcan
        @can('change css code')
            <li class="{{ Route::is('customize.style') ? 'active' : '' }}">
                <a href="{{route('customize.style')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fab fa-css3-alt"></i><span>Page Css</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
