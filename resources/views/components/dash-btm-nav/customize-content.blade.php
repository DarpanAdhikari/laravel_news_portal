<x-dashboard-layout>
    {{$slot}}
    <x-page-component.bottom-navigation>
        <a href="{{route('customize.page_info')}}" data-tooltip-target="tooltip-english" class="inline-flex flex-col items-center justify-center w-full px-5 rounded-s-full hover:bg-gray-50 dark:hover:bg-gray-800 group {{ Route::is('customize.page_info') ? 'bg-gray-50 text-blue-500' : '' }}">
            <span class="w-5 h-5 mb-1 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"> 
                <i class='bx bxl-meta'></i>
            </span>
            <div id="tooltip-english" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Social Links
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
        <a href="{{route('customize.page_content')}}" data-tooltip-target="tooltip-trading" class="inline-flex flex-col items-center justify-center px-5 w-full hover:bg-gray-50 dark:hover:bg-gray-800 group rounded-e-full {{ Route::is('customize.page_content') ? 'bg-gray-50 text-blue-500' : '' }}">
            <span class="w-5 h-5 mb-1 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"> 
                <i class='bx bxs-book-content'></i>
              </span>
            <div id="tooltip-trading" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Page Content
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
    </x-page-component.bottom-navigation>
</x-dashboard-layout>