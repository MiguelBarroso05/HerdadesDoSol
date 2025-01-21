<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WrongLoginAttempt extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Security Alert: Unauthorized Login Attempt')
            ->line('We have detected an unauthorized attempt to access your account.
            For your security, your account has been temporarily locked for 15 minutes to prevent any potential
             unauthorized activity.')
            ->line('If this was you, please try logging in again after 15 minutes. If you suspect your account
             has been compromised, we recommend resetting your password immediately.')
            ->line('Thank you for your understanding,');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'Security Alert!',
            'body' => 'We have detected an unauthorized attempt to access your account.'
        ];
    }
}
