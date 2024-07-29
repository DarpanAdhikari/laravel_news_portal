<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Livewire\WithFileUploads;

class Inbox extends Component
{
    use WithFileUploads;
    public $textMessage, $receiver, $user_id;
    // public $msgImages = [];
    public $sender_id, $receiver_id;
    public $conversations, $totalMessageCount;
    public $currentPage = 1;
    public $lastPage;
    public $onlyPage;

    public function mount($id = null)
    {
       $this->user_id = $id;
        $this->dispatch('read-message', $id);
        $permissions = Permission::pluck('name')->all();
        $this->receiver = User::active()->where('id', '!=', auth()->id())
        ->whereHas('roles.permissions', function ($query) use ($permissions) {
            $query->whereIn('name', $permissions);
        })
            ->where('u_id', $id)->first();
        $this->sender_id = auth()->id();
        if ($this->receiver) {
            $this->receiver_id = $this->receiver->id;
        }
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $messagesPerPage = 10; // Change $messagePerPage to $messagesPerPage
        $offset = ($this->currentPage - 1) * $messagesPerPage; // Correct variable name
        if ($this->receiver) {
            $this->totalMessageCount = Message::where(function ($query) {
                $query->where('sender_id', $this->sender_id)
                    ->where('receiver_id', $this->receiver_id)
                    ->whereNull('sender_deleted_at');
            })->orWhere(function ($query) {
                $query->where('sender_id', $this->receiver_id)
                    ->where('receiver_id', $this->sender_id)
                    ->whereNull('receiver_deleted_at');
            })->count();
    
            $messages = Message::select('*')
                ->fromSub(function ($query) use ($offset, $messagesPerPage) {
                    $query->select('*')
                        ->from('messages')
                        ->where(function ($query) {
                            $query->where('sender_id', $this->sender_id)
                                ->where('receiver_id', $this->receiver_id)
                                ->whereNull('sender_deleted_at');
                        })->orWhere(function ($query) {
                            $query->where('sender_id', $this->receiver_id)
                                ->where('receiver_id', $this->sender_id)
                                ->whereNull('receiver_deleted_at');
                        })
                        ->orderBy('created_at', 'desc')
                        ->skip($offset) 
                        ->take($messagesPerPage);
                }, 'sub')
                ->orderBy('id', 'asc')
                ->get();
    
            $this->lastPage = $this->totalMessageCount <= ($messagesPerPage * $this->currentPage);
            $this->onlyPage = $this->totalMessageCount > $messagesPerPage;
        } else {
            $messages = collect();
        }
        $this->conversations = $messages;
    }
    
    public function loadMore()
    {
        if (!$this->lastPage && $this->allowAction()) {
            $this->currentPage++;
            $this->loadMessages();
        }
    }

    public function loadPrevious()
    {
        if ($this->currentPage > 1 && $this->allowAction()) {
            $this->currentPage--;
            $this->loadMessages();
        }
    }
    
   private function allowAction()
{
    $cacheKey = 'lastAction_' . $this->currentPage . '_' . $this->lastPage;
    $lastAction = Cache::get($cacheKey);

    if (!$lastAction || now()->diffInSeconds($lastAction) >= 5) {
        Cache::put($cacheKey, now(), 5);
        return true;
    } else {
        Cache::forget($cacheKey);
    }

    return false;
}

public function sendMessage()
{
    $message = new Message();
    $message->sender_id = $this->sender_id;
    $message->receiver_id = $this->receiver_id;
    $message->body = $this->textMessage;
    $message->save();
    // $this->msgImages = [];
    $this->mount($this->user_id);
}


    public function deleteMessage()
    {
        $auth = auth()->id();
        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })
            ->get();
        foreach ($messages as $message) {
           if(!$message->receiver_deleted_at && !$message->sender_deleted_at){
            if ($message->sender_id == $auth) {
                $message->update(['sender_deleted_at' => now()]);
            } else {
                $message->update(['receiver_deleted_at' => now()]);
            }
           }else{
            $message->delete();
           }
        }
        $this->mount();
        $this->loadMessages();
    }

    public function render()
    {
        $this->dispatch('get-recentMessage');
        $this->loadMessages();
        return view('livewire.chat.inbox');
    }
}
