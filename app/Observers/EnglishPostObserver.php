<?php

namespace App\Observers;

use App\Models\User;
use App\Models\EnglishPost;
use App\Models\Subscriber;
use App\Notifications\PostDatabaseNotify;
use App\Notifications\PostMailNotify;

class EnglishPostObserver
{
    public function created(EnglishPost $englishPost): void
    {
        if ($englishPost->wasRecentlyCreated) {
            $this->sendNotifications($englishPost);
        }
    }

    public function updated(EnglishPost $englishPost): void
    {
        if (!$englishPost->wasRecentlyCreated) {
            $this->sendNotifications($englishPost);
        }
    }

    protected function sendNotifications(EnglishPost $englishPost): void
    {
        $requiredPermissions = ['view post', 'delete post', 'update post', 'add post'];
        $usersWithPermissions = User::whereHas('roles.permissions', function ($query) use ($requiredPermissions) {
            $query->whereIn('name', $requiredPermissions);
        })->whereHas('subscribed')->get();
        
        foreach ($usersWithPermissions as $recipient) {
            $authorization = 'authorize';
            $recipient->notify(new PostMailNotify($englishPost->title, $authorization, $recipient->email));
        }
        $subscribers = Subscriber::whereNotNull('email_verified_at')->get();
        
        foreach ($subscribers as $subscriber) {
            if (!$usersWithPermissions->contains('email', $subscriber->email)) {
                $authorization = ''; 
                $subscriber->notify(new PostMailNotify($englishPost->title, $authorization, $subscriber->email));
            }
        }
        
        $englishPost->notify(new PostDatabaseNotify($englishPost));
    }
}
