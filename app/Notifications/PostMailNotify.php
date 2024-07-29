<?php

namespace App\Notifications;

use App\Models\EnglishPost;
use App\Models\NepaliPost;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostMailNotify extends Notification implements ShouldQueue
{
    use Queueable;

    protected $postTitle, $authorized, $email;

    public function __construct(string $postTitle, $auth, $email)
    {
        $this->postTitle = $postTitle;
        $this->authorized = $auth;
        $this->email = $email;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $post = $this->getPost();

        if (!$post || $post->status == '0') {
            return null;
        }

        $postType = $post instanceof EnglishPost ? 'English' : 'Nepali';

        return (new MailMessage)
            ->subject('Post Notification')
            ->markdown('emails.post_mail', $this->buildNotificationData($post));
    }

    protected function getPost()
    {
        return EnglishPost::where('title', $this->postTitle)->first() ??
            NepaliPost::where('title', $this->postTitle)->first();
    }

    protected function buildNotificationData($post): array
    {
        $postType = $post instanceof EnglishPost ? 'English' : 'Nepali';
        $image = $post->feature_img ?? $post->post->feature_img;
        $slug = $post->slug ?? $post->post->slug;

        return [
            'email' => $this->email,
            'postType' => $postType,
            'postTitle' => $this->postTitle,
            'image' => $image,
            'metaData' => $post->meta_description ?? '',
            'tags' => $post->tags ?? '',
            'keywords' => $post->keywords ?? '',
            'slug' => $slug,
            'auth' => $this->authorized ?: null,
        ];
    }
}
