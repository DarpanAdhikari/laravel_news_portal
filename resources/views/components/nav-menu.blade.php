@auth
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="user d-flex align-items-center justify-content-center" id="avatarButton"
            data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
            class="w-8 h-8 rounded-full cursor-pointer">
            <img class="w-8 min-w-8 h-8 min-h-6 rounded-full ring-2 dark:ring-gray-500" src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}">
            <span class="bottom-3 end-5 absolute w-2.5 h-2.5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full status"></span>
        </div>
    @else
        <div class="user d-flex align-items-center justify-content-center" id="avatarButton"
            data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
            class="w-8 h-8 rounded-full cursor-pointer">
            <i class="far fa-user-circle"></i>
        </div>
    @endif
    <x-dropdown />
@else
    <div class="user d-flex align-items-center justify-content-center" id="avatarButton" data-dropdown-toggle="userDropdown"
        data-dropdown-placement="bottom-start" class="w-8 h-8 rounded-full cursor-pointer">
        <i class="far fa-user-circle"></i>
    </div>
    <x-dropdown />
@endauth
