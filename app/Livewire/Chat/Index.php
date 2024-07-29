<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Permission;
#[Layout('layouts.blank')]

class Index extends Component
{
    public $id;
    public function render()
    {
        $permissions = Permission::pluck('name')->all();
        $user = auth()->user()->hasAnyPermission($permissions);
        if(!$user){
            abort(401);
        }
        
        return view('livewire.chat.index',['id'=>$this->id]);
    }
    public function updated()
    {
        $this->emit('refreshComponent');
    }
}
