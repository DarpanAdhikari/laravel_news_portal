<div id="changeDropdown" class="z-10 hidden bg-[#f6f6f9] divide-y divide-gray-100 rounded-lg shadow-lg w-full dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
        @canany(['update post','view post','delete post','add post'])
        <li class="{{ Request::is('post/englishpost') || Request::is('post/nepalipost') ? 'active' : '' }}">
            <a href="{{ url('post/englishpost')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fas fa-rectangle-list"></i><span>Post</span>
            </a>
        </li>
        @endcanany
        @canany(['update post','view post','delete post','add post'])
        <li class="{{ Request::is('post/englishpost/draft') || Request::is('post/nepalipost/draft') ? 'active' : '' }}">
            <a href="{{ url('post/englishpost/draft')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fas fa-file-pen"></i><span>Draft</span>
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
        <li class="{{Route::is('get.image') ? 'active' : ''}}">
            <a href="{{route('get.image')}}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <i class='bx bx-images' ></i><span>Body Images</span>
            </a>
        </li>
    </ul>
</div>