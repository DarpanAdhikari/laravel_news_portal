<div>
    @if (isset($receiver))
        <div class="card">
            <div class="card-header msg_head flex items-center gap-4">
                <div class="w-max cursor-pointer md:hidden" id="user-toggle">
                    <span class="font-bold text-3xl text-gray-50 hover:text-gray-200">&#9778;</span>
                </div>
                <div class="flex">
                    <div class="img_cont relative h-max">
                        <img src="{{ $receiver->profile_photo_url }}" class="rounded-full user_img object-cover">
                        <span
                        class="bottom-0 end-0 absolute w-3.5 h-3.5 border-2 border-white dark:border-gray-800 rounded-full {{ $receiver->isUserOnline() ? 'bg-green-500' : 'bg-red-500' }}"></span>
                    </div>
                    <div class="user_info capitalize">
                        <span>{{ $receiver->name }}</span>
                        <p>{{ Str::shortNumber($totalMessageCount) }} Messages</p>
                    </div>
                </div>
                <span id="action_menu_btn" data-dropdown-toggle="message-action" data-dropdown-delay="200"
                    data-dropdown-trigger="click" class="mr-3 relative"><i class="fas fa-ellipsis-v"></i></span>
                <div class="action_menu select-none hidden z-10 shadow-md" id="message-action" wire:ignore>
                    <ul>
                        <li><i class="fas fa-user-circle"></i> View profile</li>
                        @if ($totalMessageCount)
                        <li wire:click="deleteMessage()"><i class="fas fa-trash"></i> Delete Conversation</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card-body msg_card_body scroll-down" wire:poll>
                @if (!$lastPage)     
                <div class="w-full flex justify-center items-center">
                    <span class="px-2.5 py-2 rounded-full bg-gray-500 text-white hover:bg-gray-600 cursor-pointer hover:scale-90 duration-75 animate-bounce hover:animate-none" wire:click="loadMore">
                        <i class="fas fa-arrow-up"></i>
                    </span>
                </div>
                @endif
                @foreach ($conversations as $message)
                @if ($message->sender_id === auth()->id())
                <div class="flex justify-end mb-4">
                    <div class="msg_cotainer_send relative" title="{{ ($message->read_at) ? 'Seen: '. (\Carbon\Carbon::parse($message->read_at)->shortAbsoluteDiffForHumans() . ' ' . __('time')['ago']) : 'unseen' }}">
                        {{$message->body}}
                        <span class="text-[10px] text-blue-900 absolute bottom-0 right-3"> {!! ($message->read_at) ? '&#10003;&#10003;' : '&#10003;' !!}</span>
                        <span class="msg_time_send text-nowrap">{{ \Carbon\Carbon::parse($message->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                    </div>
                </div>
                @else 
                <div class="flex justify-start mb-4">
                    <div class="img_cont_msg">
                        <img src="{{ $receiver->profile_photo_url }}"
                            class="rounded-full user_img object-cover_msg">
                    </div>
                    <div class="msg_cotainer">
                        {{$message->body}}
                        <span class="msg_time text-nowrap w-full">{{ \Carbon\Carbon::parse($message->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                    </div>
                </div>
                @endif
                @endforeach
                @if (!($currentPage <= 1))     
                <div class="w-full flex justify-center items-center">
                    <span class="px-2.5 py-2 rounded-full bg-gray-500 text-white hover:bg-gray-600 cursor-pointer hover:scale-90 duration-75 animate-bounce hover:animate-none" wire:click="loadPrevious">
                        <i class="fas fa-arrow-down"></i>
                    </span>
                </div>
                @endif
            </div>
            <div class="card-footer relative">
               <form wire:submit.prevent="sendMessage()" id="messageForm">
                @csrf
                @if ($errors->any())
                <div class="text-red-500 fixed top-0 left-0 w-full z-20 text-center bg-[#333]">
                    @foreach ($errors->all() as $error)
                        <span class="w-fit font-bold">{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
                <div class="input-group" wire:ignore>
                    {{-- <div class="input-group-append">
                        <span class="input-group-text attach_btn" id="uploadBtn"><i class="fas fa-paperclip"></i></span>
                    </div>
                    <input type="file" id="fileInput" wire:model="msgImages" accept="image/*" multiple hidden>
                    <div class="selected-img" id="imageContainer"></div> --}}
                    <textarea class="form-control type_msg resizable-textarea" placeholder="Type your message..." wire:model="textMessage" name="textMessage"></textarea>
                    <div class="input-group-append" onclick="document.querySelector('.type_msg').value = ''">
                        <button type="submit" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                    </div>
                </div>
               </form>
            </div>
        </div>
    @else
        <div class="choose-alert w-full h-screen">
            <span class="font-bold">You haven't chosen a conversation yet; pick one first.</span>
        </div>
    @endif
</div>
