<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use App\Notifications\SubscriberNotification;

class Subscribers extends Component
{
    public $email;
    public function render()
    {
        return view('livewire.subscribers');
    }

    public function subscribe()
    {
        $token = Str::random(40);
        if (auth()->check() && !$this->email) {
            $email = auth()->user()->email;
            $subscribe = Subscriber::where('email', $email)->first();

            if ($subscribe) {
                $subscribe->update(['u_id' => auth()->id()]);
            } else {
                $subscribe = Subscriber::create([
                    'u_id' => auth()->id(),
                    'email' => $email,
                    'remember_token' => $token
                ]);
                $subscribe->notify(new SubscriberNotification($subscribe));
            }
        } else {
            $this->validate([
                'email' => 'required|email|unique:subscribers,email',
            ]);
            $subscribe = Subscriber::create([
                'email' => $this->email,
                'remember_token' => $token
            ]);
            $subscribe->notify(new SubscriberNotification($subscribe));
            $this->email = '';
        }
        if ($subscribe) {
            return with(['mailed' => 'We have sent a verification email. Please verify.']);
        }
    }
}
