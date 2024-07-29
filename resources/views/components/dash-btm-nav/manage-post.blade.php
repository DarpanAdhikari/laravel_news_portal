    <x-page-component.bottom-navigation>
        <a href="{{url('post/englishpost')}}" data-tooltip-target="tooltip-english" class="inline-flex flex-col items-center justify-center w-full px-5 rounded-s-full hover:bg-gray-50 dark:hover:bg-gray-800 group {{ request()->is('post/englishpost') ? 'bg-gray-50 text-blue-500' : '' }}">
            <span class="w-5 h-5 mb-1 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"> 
                <i class='fas fa-file-lines'></i>
            </span>
            <div id="tooltip-english" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                English Post
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
        <a href="{{url('post/nepalipost')}}" data-tooltip-target="tooltip-nepali" class="inline-flex flex-col items-center justify-center px-5 w-full hover:bg-gray-50 dark:hover:bg-gray-800 group rounded-e-full {{ request()->is('post/nepalipost') ? 'bg-gray-50 text-blue-500' : '' }}">
            <span class="w-5 h-5 mb-1 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"> 
                <i class='fas fa-file-lines'></i>
            </span>
            <div id="tooltip-nepali" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Nepali Post
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
    </x-page-component.bottom-navigation>