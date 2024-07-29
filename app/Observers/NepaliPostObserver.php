<?php

namespace App\Observers;

use App\Models\User;
use App\Models\NepaliPost;
use App\Models\Subscriber;
use App\Notifications\PostMailNotify;
use App\Notifications\PostDatabaseNotify;

class NepaliPostObserver
{
    public function created(NepaliPost $nepaliPost): void
    {
        if ($nepaliPost->wasRecentlyCreated) {
            $this->sendNotifications($nepaliPost);
        }
    }

    public function updated(NepaliPost $nepaliPost): void
    {
        if (!$nepaliPost->wasRecentlyCreated) {
            $this->sendNotifications($nepaliPost);
        }
    }
    protected function sendNotifications(NepaliPost $nepaliPost): void
    {
        $requiredPermissions = ['view post', 'delete post', 'update post', 'add post'];
        $usersWithPermissions = User::whereHas('roles.permissions', function ($query) use ($requiredPermissions) {
            $query->whereIn('name', $requiredPermissions);
        })->whereHas('subscribed')->get();
        
        foreach ($usersWithPermissions as $recipient) {
            $authorization = 'authorize'; 
            $recipient->notify(new PostMailNotify($nepaliPost->title, $authorization, $recipient->email));
        }
        $subscribers = Subscriber::whereNotNull('email_verified_at')->get();
        
        foreach ($subscribers as $subscriber) {
            if (!$usersWithPermissions->contains('email', $subscriber->email)) {
                $authorization = '';
                $subscriber->notify(new PostMailNotify($nepaliPost->title, $authorization, $subscriber->email));
            }
        }
           
        $nepaliPost->notify(new PostDatabaseNotify($nepaliPost));
    }
}
