<div id="uploadDropdown" class="z-10 hidden bg-[#f6f6f9] divide-y divide-gray-100 rounded-lg shadow-lg w-full dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
        @canany(['add post','update post'])
        <li class="{{ Request::is('post/englishpost/create') || Request::is('post/nepalipost/create') ? 'active' : '' }}">
            <a href="{{url('post/englishpost/create')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white active">
                <i class="fas fa-file-import"></i><span>Post</span>
            </a>
        </li>
        @endcanany
        @canany(['add ads','changes on ads'])
        <li>
            <a href="#"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class='bx bx-spreadsheet' ></i><span>Ads</span>
            </a>
        </li>
        @endcanany
    </ul>
</div>