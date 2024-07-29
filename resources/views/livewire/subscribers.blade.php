<div id="subscribe-modal" class="@if(!$errors->any(['email', 'mailed'])) hidden @endif overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-[#878686ba] select-none">
    <div class="container flex justify-center items-center h-screen">
        <div id="subscribe-box" class="card bg-white shadow-lg rounded-lg p-8 max-w-md">
            <h2 class="text-green-600 text-2xl font-bold mb-4 text-center">
                Subscribe to {{__('site-name')}}
            </h2>
            <p class="text-gray-600 mb-4">
                Be Updated with Post notification to your email.
            </p>
            <form id="thanks" wire:submit.prevent="subscribe" method="POST" class="flex flex-col items-center relative">
              @guest
              <input type="email" name="email" wire:model='email' placeholder="Enter your email" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 select-auto" autocomplete="on" required>
              @error('email') 
               <span class="text-red-500 text-sm">{{$message}}</span>
               @enderror
               @error('mailed') 
               <span class="text-green-500 text-sm">{{$message}}</span>
               @enderror
              @endguest
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-3 py-2 rounded-md transition duration-300 ease-in-out mb-4 animate-bounce hover:animate-none @guest absolute top-0 right-0 @endguest">
                    <svg fill="#000000" width="20px" height="25px" viewBox="0 0 24 24" id="mail" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
                        <rect id="primary" x="2" y="4" width="20" height="16" rx="2" style="fill: rgb(0, 0, 0);"></rect>
                        <path id="secondary" d="M20,4H4A2,2,0,0,0,2,6V8a1,1,0,0,0,.51.87l9,5a1,1,0,0,0,1,0l9-5A1,1,0,0,0,22,8V6A2,2,0,0,0,20,4Z" style="fill: rgb(44, 169, 188);"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>