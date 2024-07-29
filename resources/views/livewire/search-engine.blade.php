<div id="searchInput" class="">
    <div>
        <div class="input-field bg-gray-200 px-2 py-1 max-[700px]:min-w-[100vw]">
            <input type="search" placeholder="Search..." id="searchInp" wire:model="search"
                wire:input="searchEngine($event.target.value)"
                class="outline-none focus:outline-none focus:border-none shadow-none border-none bg-transparent w-96 px-4 relative" accesskey="s" alt="search" autocomplete="off">
        </div>
    </div>
    <div id="searchItems">
        @if (!empty($postSearch))
            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 absolute top-16 right-1 max-[700px]:right-0 max-[700px]:left-0 max-[700px]:w-full max-[700px]:mx-auto max-[700px]:my-0 max-[700px]:top-10 max-[700px]:max-h-[600px] bg-gray-50 w-full p-3 rounded-md shadow-2xl max-h-[420px] z-[99] overflow-hidden">
                @foreach ($postSearch as $post)
                    <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                        <li class="pb-3 sm:pb-4 relative mb-2 hover:shadow-md p-2 rounded-full">
                            <div class="h-full flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full"
                                        src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $post->title }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $post->user->name }}
                                    </p>
                                </div>
                                <div
                                    class="text-[10px] text-gray-400 absolute top-0 right-0 w-max h-full bg-gray-50 flex items-center justify-center gap-1">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }}
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
                <div class="absolute bottom-0 right-0 w-full flex justify-center items-center bg-none border-none">
                    <span id="viewAllSearches" class="relative px-5 py-1.5 transition-all ease-in duration-75 dark:bg-gray-900 rounded-md group-hover:bg-opacity-0 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl hover:ring-4 hover:ring-red-100 cursor-pointer text-white font-bold" onclick="viewAll()">View All</span>
                </div>
            </ul>
        @endif
    </div>
</div>
