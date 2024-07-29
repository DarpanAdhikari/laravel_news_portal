<section class="w-full max-w-full mx-auto py-8 pt-1">
    {{-- post like and author information --}}
    <section class="flex justify-between mb-8">
        <span wire:click="likePost"
            class="border border-blue-700 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center {{ $this->isPostLiked() ? 'bg-blue-700 text-white liked' : 'text-blue-700 bg-white' }} cursor-pointer relative"
            id="post_like">
            <span
                class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full absolute -top-2 right-0">{{ Str::shortNumber($likes) }}</span>
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 18 18">
                <path
                    d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z" />
            </svg>
            <span class="sr-only">Icon description</span>
        </span>
        @if (!empty($author))
            <div class="relative me-4" data-popover-target="popover-user-profile">
                <img class="w-10 h-10 rounded-full" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}">
                <span
                    class="top-0 start-7 absolute w-3.5 h-3.5 {{ $author->isUserOnline() ? 'bg-green-500' : 'bg-red-500' }}  border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>

            <div data-popover id="popover-user-profile" role="tooltip"
                class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                <div class="p-3">
                    <div class="flex items-center justify-between mb-2">
                        <a href="user/{{ $author->u_id }}">
                            <img class="w-10 h-10 rounded-full" src="{{ $author->profile_photo_url }}"
                                alt="{{ $author->name }}">
                        </a>
                        <picture>
                            @foreach ($logoImageUrls as $imageUrl)
                                <img src="{{ $imageUrl }}" alt="{{ __('site-name') }} logo"
                                    class="h-12 mr-4 bg-none">
                            @endforeach
                        </picture>
                    </div>
                    <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                        <a href="user/{{ $author->u_id }}">{{ $author->name }}</a>
                    </p>
                    @if (!empty($author->getRoleNames()))
                        @foreach ($author->getRoleNames() as $item)
                            <p class="mb-4 text-sm">{{ $item }} <a href="{{ route('home') }}"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">{{ __('site-name') }}</a>.
                            </p>
                        @endforeach
                    @endif

                    <div class="flex justify-around text-lg">
                        <a href="{{ $author->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $author->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $author->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div data-popper-arrow></div>
            </div>
        @endif
    </section>
    <!-- Comments part -->
    @php
        $n = 1;
        $i = 1;
    @endphp
    @foreach ($comments as $comment)
        <div class="bg-white rounded-xl mb-3">
            <div class="p-4 flex justify-between items-center shadow-md rounded-lg mb-1 relative">
                <div class="flex justify-start items-center">
                    <div class="relative me-4">
                        <img class="w-10 h-10 rounded-full" src="{{ $comment->user->profile_photo_url }}"
                            alt="{{ $comment->user->name }}">
                        <span
                            class="top-0 start-7 absolute w-3.5 h-3.5 {{ $comment->user->isUserOnline() ? 'bg-green-500' : 'bg-red-500' }}  border-2 border-white dark:border-gray-800 rounded-full"></span>
                    </div>
                    <div class="ml-4">
                        <div class="flex items-center">
                            <p class="font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-gray-500 text-[12px] ml-2">
                                {{ \Carbon\Carbon::parse($comment->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}
                            </p>
                        </div>
                        <p class="text-gray-600">{{ $comment->body }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="flex gap-1 justify-center items-center">
                        @auth
                            @if ($comment->u_id !== Auth::user()->id)
                                <span wire:click="like({{ $comment->id }})"
                                    class="border border-blue-700 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center  {{ $this->isLiked($comment->id) ? 'bg-blue-700 text-white' : 'text-blue-700 bg-white' }} cursor-pointer relative">
                                    <span
                                        class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full absolute -top-2 right-0">{{ Str::shortNumber($comment->likes_count) }}</span>
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 18 18">
                                        <path
                                            d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z" />
                                    </svg>
                                    <span class="sr-only">Icon description</span>
                                </span>
                            @endif
                        @else
                            <span
                                class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{ Str::shortNumber($comment->likes_count) }}</span>
                        @endauth
                    </div>
                    @auth
                        <button data-dropdown-toggle="comment{{ $i }}" data-dropdown-placement="bottom-start"
                            class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg focus:outline-none focus:ring-transparent"
                            type="button">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                <path
                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                        </button>
                    @endauth
                </div>
            </div>

            @auth
                <x-page-component.chat-bubble id='comment{{ $i }}'>
                    <li>
                        <span
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white  comment-reply cursor-pointer">Reply</span>
                    </li>
                    @if ($comment->u_id == Auth::user()->id)
                        <li>
                            <span wire:click="delete({{ $comment->id }})"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">Delete</span>
                        </li>
                    @else
                    <li>
                        <span wire:click="abuse({{$comment->id}})"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white  comment-reply cursor-pointer">Report
                            Abuse</span>
                    </li>
                    @endif
                </x-page-component.chat-bubble>
            @endauth

            <!-- Reply -->
            @foreach ($comment->replies as $reply)
                <div class="bg-gray-100 p-3 ml-12 rounded-full shadow-sm mb-2 reply-background flex justify-between">
                    <div class="flex justify-start items-center relative">
                        <span class="absolute -top-3 left-3 z-0 text-gray-300 opacity-70 select-none">Reply</span>
                        <div class="relative me-4">
                            <img class="w-10 h-10 rounded-full" src="{{ $reply->user->profile_photo_url }}"
                                alt="{{ $reply->user->name }}">
                            <span
                                class="top-0 start-7 absolute w-3.5 h-3.5 {{ $reply->user->isUserOnline() ? 'bg-green-500' : 'bg-red-500' }}  border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <p class="font-semibold">{{ $reply->user->name }}</p>
                                <p class="text-gray-500 ml-2 time-check text-[12px]">
                                    {{ \Carbon\Carbon::parse($reply->created_at)->shortAbsoluteDiffForHumans() }}
                                </p>
                            </div>
                            <p class="text-gray-600">{{ $reply->body }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex gap-1 justify-center items-center">
                            @auth
                                @if ($reply->u_id !== Auth::user()->id)
                                    <button wire:click="like({{ $reply->id }})" type="button"
                                        class="border border-blue-700 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center  {{ $this->isLiked($reply->id) ? 'bg-blue-700 text-white' : 'text-blue-700 bg-white' }} cursor-pointer relative">
                                        <span
                                            class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full absolute -top-2 right-0">{{ Str::shortNumber($reply->likes_count) }}</span>
                                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 18 18">
                                            <path
                                                d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                @endif
                            @else
                                <span
                                    class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{ Str::shortNumber($reply->likes_count) }}</span>
                            @endauth
                        </div>
                        @auth
                            <button data-dropdown-toggle="reply{{ $n }}"
                                data-dropdown-placement="bottom-start"
                                class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg focus:outline-none focus:ring-transparent"
                                type="button">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>
                        @endauth
                    </div>
                </div>
                @auth
                    <x-page-component.chat-bubble id='reply{{ $n }}'>
                        @if ($reply->u_id == Auth::user()->id)
                            <li>
                                <span wire:click="delete({{ $reply->id }})"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</span>
                            </li>
                        @else
                            <li>
                                <span wire:click="abuse({{$reply->id}})"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white  comment-reply cursor-pointer">Report
                                    Abuse</span>
                            </li>
                        @endif
                        @php
                            $n += 1;
                        @endphp
                    </x-page-component.chat-bubble>
                @endauth
            @endforeach
            @auth
                <div
                    class="bg-gray-100 p-3 ml-12 rounded-lg shadow-sm mb-2 reply-background reply-field relative @if (!$errors->has("replies.{$comment->id}.reply") && !$errors->has("replies.{$comment->id}.reply_no")) hidden @endif duration-300">
                    <form wire:submit.prevent="submitReply({{ $comment->id }})" class="w-full">
                        <div class="flex gap-2 justify-start items-center">
                            <span class="absolute -top-0 left-3 text-gray-300 opacity-70 select-none">Reply</span>
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full">
                            <input type="hidden" name="reply_no[{{ $comment->id }}]"
                                wire:model="replies.{{ $comment->id }}.reply_no" value="{{ $comment->id }}" hidden>
                            <textarea
                                class="form-textarea w-full resize-none border-none max-h-[150px] overflow-y-hidden resizable-textarea rounded-md outline-none focus:outline-none focus-within:border-none pr-5 focus-visible:border-none focus-visible:outline-none focus:shadow-none focus-within:shadow-none focus-visible:shadow-none focus:border-blue-500 bg-gray-50 h-[60px] @if ($errors->has("replies.{$comment->id}.reply") || $errors->has("replies.{$comment->id}.reply_no")) placeholder:text-red-500 @endif"
                                placeholder="leave reply here.." name="reply[{{ $comment->id }}]"
                                wire:model="replies.{{ $comment->id }}.reply"></textarea>
                        </div>
                        <div class="flex justify-end items-center absolute top-0 right-3 h-full">
                            <button type="submit"
                                class="bg-blue-500 text-white py-2 px-3 rounded-full focus:ring-transparent"><i
                                    class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
        @php
            $i += 1;
        @endphp
    @endforeach
    {{-- pagination --}}
    @if ($onlyPage)
        <div class="flex w-full justify-between">
            <!-- Previous Button -->
            <button wire:click="loadPrevious()" {{ $currentPage <= 1 ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg {{ $currentPage <= 1 ? '' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                Previous
            </button>
            <button wire:click="loadMore()" {{ $lastPage ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg {{ $lastPage ? '' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                Next
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
        </div>
    @endif
    <!-- new comment -->
    @auth
        <div class="bg-white rounded-lg shadow-md mb-4 p-2 relative">
            <form wire:submit.prevent="submitComment" class="w-full">
                @csrf
                <div class="flex gap-2 justify-start items-center">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                        class="w-10 h-10 rounded-full">
                    <textarea
                        class="form-textarea w-full resize-none border-none max-h-[150px] overflow-y-hidden resizable-textarea rounded-md outline-none focus:outline-none focus-within:border-none pr-5 focus-visible:border-none focus-visible:outline-none focus:shadow-none focus-within:shadow-none focus-visible:shadow-none focus:border-blue-500 bg-gray-50 @error('comment') placeholder:text-red-500 @enderror"
                        placeholder="leave comment here.." wire:model="comment"></textarea>
                </div>
                <div class="flex justify-end items-center absolute top-0 right-3 h-full focus:ring-transparent">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-3 rounded-full"><i
                            class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    @endauth
</section>
