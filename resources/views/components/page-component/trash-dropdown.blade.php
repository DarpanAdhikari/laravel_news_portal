<div id="trashDropdown" class="z-10 hidden bg-[#f6f6f9] divide-y divide-gray-100 rounded-lg shadow-lg w-full dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
        @canany(['delete post'])
        <li class="{{ Request::is('post/entrash') ? 'active' : '' }}">
            <a href="{{ url('post/entrash')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fas fa-trash"></i><span>EnglishPost</span>
            </a>
        </li>
        @endcanany
        @canany(['delete post'])
        <li class="{{ Request::is('post/nptrash') ? 'active' : '' }}">
            <a href="{{ url('post/nptrash')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fas fa-trash"></i><span>NepaliPost</span>
            </a>
        </li>
        @endcanany
    </ul>
</div>