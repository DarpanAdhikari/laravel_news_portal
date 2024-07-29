<x-dash-btm-nav.customize-content>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8 h-fit">
                <h2 class="text-xl font-bold dark:text-white">Social links</h2>
                <hr class="mb-4">
                <form action="{{route('customize.page_social')}}" method="POST">
                    @csrf
                    <div class="mb-4 flex flex-col gap-5">
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="h-4 w-4" viewBox="0 0 16 16" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path fill="#444"
                                        d="M7.2 16v-7.5h-2v-2.7h2c0 0 0-1.1 0-2.3 0-1.8 1.2-3.5 3.9-3.5 1.1 0 1.9 0.1 1.9 0.1l-0.1 2.5c0 0-0.8 0-1.7 0-1 0-1.1 0.4-1.1 1.2 0 0.6 0-1.3 0 2h2.9l-0.1 2.7h-2.8v7.5h-2.9z">
                                    </path>
                                </svg>
                            </span>
                            <input type="url" id="website-admin"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{__('facebook')}}" name="facebook"
                                placeholder="https://facebook.com" >
                        </div>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 11C3 7.22876 3 5.34315 4.17157 4.17157C5.34315 3 7.22876 3 11 3H13C16.7712 3 18.6569 3 19.8284 4.17157C21 5.34315 21 7.22876 21 11V13C21 16.7712 21 18.6569 19.8284 19.8284C18.6569 21 16.7712 21 13 21H11C7.22876 21 5.34315 21 4.17157 19.8284C3 18.6569 3 16.7712 3 13V11Z"
                                        stroke="#33363F" stroke-width="2" />
                                    <circle cx="16.5" cy="7.5" r="1.5" fill="#33363F" />
                                    <circle cx="12" cy="12" r="3" stroke="#33363F" stroke-width="2" />
                                </svg>
                            </span>
                            <input type="url" id="website-admin"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{__('instagram')}}" name="instagram"
                                placeholder="https://instagram.com" >
                        </div>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    version="1.1">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </span>
                            <input type="url" id="website-admin"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{__('twitter')}}" name="twitter"
                                placeholder="https://twitter.com" >
                        </div>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg fill="#000000" class="h-4 w-4" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                                    <path
                                        d="M23,9.71a8.5,8.5,0,0,0-.91-4.13,2.92,2.92,0,0,0-1.72-1A78.36,78.36,0,0,0,12,4.27a78.45,78.45,0,0,0-8.34.3,2.87,2.87,0,0,0-1.46.74c-.9.83-1,2.25-1.1,3.45a48.29,48.29,0,0,0,0,6.48,9.55,9.55,0,0,0,.3,2,3.14,3.14,0,0,0,.71,1.36,2.86,2.86,0,0,0,1.49.78,45.18,45.18,0,0,0,6.5.33c3.5.05,6.57,0,10.2-.28a2.88,2.88,0,0,0,1.53-.78,2.49,2.49,0,0,0,.61-1,10.58,10.58,0,0,0,.52-3.4C23,13.69,23,10.31,23,9.71ZM9.74,14.85V8.66l5.92,3.11C14,12.69,11.81,13.73,9.74,14.85Z" />
                                </svg>
                            </span>
                            <input type="url" id="website-admin"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{__('youtube')}}" name="youtube"
                                placeholder="https://youtube.com" >
                        </div>
                        @can('change on page')
                            <div class="flex">
                                <input type="submit"
                                    class="rounded-lg cursor-pointer bg-blue-500 border text-gray-200 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:text-gray-50 font-extrabold"
                                    value="save">
                            </div>
                        @endcan
                    </div>
                </form>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8 h-fit">
                <h2 class="text-xl font-bold dark:text-white">Logo Upload</h2>
                <hr class="mb-4">
                <form action="{{route('customize.page_logo')}}" method="Post" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-col">
                        <label class="block mb-2 text-sm font-bold dark:text-white uppercase  @error('logo_name') text-red-700 @enderror"
                            for="file_input">Logo With Site name</label>
                            @error('logo_name') 
                            <span class="text-red-500"></span>
                            @enderror
                            @foreach($logoNameImageUrls  as $image)
                        <img class="image-preview h-auto max-h-[200px] max-w-lg transition-all duration-300 rounded-lg  hover:blur-none"
                            src="{{ $image }}">
                            @endforeach
                        @can('change on page')
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" type="file"  name="logo_name" >
                        @endcan
                    </div>
                    <hr><br>
                    <hr>
                    <div class="flex flex-col">
                        <label class="block mb-2 text-sm dark:text-white font-bold uppercase @error('logo_only') text-red-700 @enderror"
                            for="file_input">Only Logo without site name</label>
                            @error('logo_only') 
                            <span class="text-red-500"></span>
                            @enderror
                            @foreach($logoImageUrls  as $image)
                            <img class="image-preview h-auto max-h-[200px] max-w-lg transition-all duration-300 rounded-lg  hover:blur-none"
                            src="{{ $image }}">
                            @endforeach
                        @can('change on page')
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" type="file" name="logo_only" >
                        @endcan
                    </div>
                    @can('change on page')
                        <div class="flex">
                            <input type="submit"
                                class="rounded-lg cursor-pointer bg-blue-500 border text-gray-200 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:text-gray-50 font-extrabold"
                                value="save">
                        </div>
                    @endcan
            </div>
            </form>
        </div>
    </div>
</x-dash-btm-nav.customize-content>
