<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Users extends Component
{
    public $users, $newMsg = [];
    public $recentMessages;

    public function mount()
    {
        $permissions = Permission::pluck('name')->all();
        $this->users = User::active()
        ->where('id', '!=', auth()->id())
        ->whereHas('roles.permissions', function ($query) use ($permissions) {
            $query->whereIn('name', $permissions);
        })
        ->with(['sentMessage' => function ($query) {
            $query->where('sender_id', auth()->id())->latest()->limit(1); 
        }, 'receiveMessage' => function ($query) {
            $query->where('sender_id', auth()->id())->latest()->limit(1);
        }])
        ->orderByDesc(function ($query) {
            $query->selectRaw('COALESCE((SELECT MAX(created_at) FROM messages WHERE sender_id = users.id), (SELECT MAX(created_at) FROM messages WHERE receiver_id = users.id))');
        })
        ->get();
    }

    #[On('read-message')]
    public function selectUser($user){
        $sender = User::where('u_id',$user)->first();
        $receiver = auth()->id();
        if($sender){
            $messages = Message::where('sender_id',$sender->id)
                           ->where('receiver_id',$receiver)
                           ->get();
            foreach($messages as $message){
                if(!$message->read_at){
                    $message->update(['read_at'=>now()]);
                }
            }
        }
    }
    #[On('get-recentMessage')]
    public function render()
    {
        $this->mount();
        return view('livewire.chat.users');
    }
}