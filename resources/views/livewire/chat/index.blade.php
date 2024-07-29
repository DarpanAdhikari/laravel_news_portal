<x-blank-layout>
    <div class="conversation-container">
        <div class="grid grid-cols-12 gap-2 w-full">
            <div class="col-span-3 h-screen max-md:fixed max-md:left-0 max-md:top-0 max-md:z-10 chat contacts-container max-md:bg-gray-400 @if(Route::currentRouteName() !== 'chat.index') max-md:hidden @endif" id="userNav">
            @livewire('chat.users')
            </div>
            <div class="chat w-full h-screen col-span-9 max-md:col-span-12">
             @livewire('chat.inbox',['id'=>$id])
            </div>
        </div>
    </div>
</x-blank-layout>