<div>
    <div class="card contacts_card">
        <div class="card-header flex justify-between items-center gap-3">
            <a href="/">
                <span class="cursor-pointer text-gray-50 hover:text-gray-200 duration-75"><i
                        class="fas fa-home"></i></span>
            </a>
            <div class="input-group">
                <input type="text" placeholder="Search..." id="userSearch" class="form-control search">
                <div class="input-group-prepend">
                    <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <nav class="card-body contacts_body" wire:ignore>
            <ul class="contacts">
                @foreach ($users as $user)
                <a href="{{ url('chat/'.$user->u_id) }}" wire:click="selectUser('{{ $user->u_id }}')" class="user-item">
                    <li class="{{Request::is('chat/'.$user->u_id) ? 'active' : ''}} shadow-sm">
                        <div class="flex items-center capitalize">
                            <div class="img_cont relative h-max w-max">
                                <img src="{{ asset($user->profile_photo_url) }}" class="rounded-full user_img object-cover ">
                                <span class="bottom-0 end-0 absolute w-3.5 h-3.5 border-2 border-white dark:border-gray-800 rounded-full {{ $user->isUserOnline() ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            </div>
                            <div class="user_info my-auto w-full">
                                <span>{{ $user->name }} </span>
                                @if (!empty($user->getRoleNames()))
                                <div class="flex gap-1">
                                @foreach ($user->getRoleNames() as $item)
                                    <p class="shadow-md w-max rounded-xl p-0.5">{{$item}}</p>
                                    @endforeach                               
                                </div>
                                @endif
                            </div>
                        </div>
                    </li>
                </a>
            @endforeach     
            </ul>
        </nav>
        <div class="card-footer"></div>
    </div>
</div>
