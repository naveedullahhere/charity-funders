<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class GoogleAuthenticatorNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $google2faUrl;

    public function __construct($google2faUrl)
    {
        $this->google2faUrl = $google2faUrl;
    }

   
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Scan the QR code below using the Google Authenticator app:')
            ->line($this->google2faUrl)
            ->line('This code will expire in 10 minutes.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
