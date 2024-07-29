<?php

namespace App\Notifications;

use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostDatabaseNotify extends Notification implements ShouldQueue
{
    use Queueable;

    protected $postTitle;

    public function __construct(string $postTitle)
    {
        $this->postTitle = $postTitle;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $post = $this->getPost();

        if ($post === null) {
            return [];
        }

        return $this->buildNotificationData($post);
    }

    protected function getPost()
    {
        return EnglishPost::where('title', $this->postTitle)->first() ??
               NepaliPost::where('title', $this->postTitle)->first();
    }

    protected function buildNotificationData($post): array
    {
        $postType = $post instanceof EnglishPost ? 'English' : 'Nepali';
        if($post->status == '0'){
            return null;
        }
        $image = $post->feature_img ?? $post->post->feature_img;
        $slug = $post->slug ?? $post->post->slug;

        return [
            'postType' => $postType,
            'postTitle' => $this->postTitle,
            'image' => $image,
            'metaData' => $post->meta_description ?? '',
            'tags' => $post->tags ?? '',
            'keywords' => $post->keywords ?? '',
            'slug' => $slug,
        ];
    }
}
