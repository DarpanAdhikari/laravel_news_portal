@if (session('type') && session('title'))
    @if (session('type') === 'success')
        <div id="toastNotify"
            class="fixed z-50 bottom-0 right-0 w-full max-w-xs p-4 text-gray-500 bg-green-500 rounded-lg shadow-lg dark:text-gray-400"
            role="alert">
            <div class="flex">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                </div>
                <div class="ms-3 text-sm font-normal text-gray-100">
                    <span class="mb-1 text-sm font-semibold dark:text-white">{{ session('title') }}</span>
                    <div class="mb-2 text-sm font-normal">{{ session('message') }} <b class="cursor-pointer"
                            onclick="navigator.clipboard.writeText(this.textContent)" title="click to copy">
                            @if (session('loggedIn'))
                                {{ session('loggedIn') }}
                            @endif
                        </b></div>

                    @if (session('route'))
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <a href="{{ route(session('route')) }}"
                                    class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Update</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if (session('type') === 'error')
        <div id="toastNotify"
            class="fixed z-50 bottom-0 right-0 w-full max-w-xs p-4 text-gray-500 bg-red-500 rounded-lg shadow-lg dark:text-gray-400"
            role="alert">
            <div class="flex">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-blue-100 rounded-lg dark:text-blue-300">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                </div>
                <div class="ms-3 text-sm font-normal text-gray-100">
                    <span class="mb-1 text-sm font-semibold dark:text-white">{{ session('title') }}</span>
                    <div class="mb-2 text-sm font-normal">{{ session('message') }}</div>

                    @if (session('route'))
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <a href="{{ route(session('route')) }}"
                                    class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Update</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
