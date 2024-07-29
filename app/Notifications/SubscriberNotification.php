<?php

namespace App\Notifications;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $subscriber;
    /**
     * Create a new notification instance.
     */
    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if (!$this->subscriber['remember_token']) {
            return null;
        }
        $verificationUrl = url("/subscribe/{$this->subscriber['remember_token']}");
    
        return (new MailMessage)
            ->subject('Subscription verification')
            ->greeting('Hello Subscriber,')
            ->line('Thank you for subscribing to our application!')
            ->action('Verify', $verificationUrl)
            ->line('Thank you for using our application!');
    }
    
    public function toArray(object $notifiable): array
    {
        if ($this->subscriber['email_verified_at'] === null) {
            return null;
        }
        
        return [
            'u_id' => $this->subscriber['u_id'],
            'email' => $this->subscriber['email'],
        ];
    }
}
