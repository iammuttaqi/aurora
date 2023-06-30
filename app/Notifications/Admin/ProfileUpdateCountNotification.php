<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileUpdateCountNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $count;

    public function __construct($count)
    {
        $this->count = $count;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Action Required: Unread Notifications')
            ->greeting('Unread Notifications')
            ->line('Dear ' . $notifiable->name . ',')
            ->line('You have **' . $this->count . '** unread notifications on ***' . config('app.name') . '*** today that require your attention. Please take a moment to review and respond to them.')
            ->line('To ensure a smooth user experience and maintain the security of our platform, we kindly request your prompt action. Here are the details:')
            ->line('- Log in to ***' . config('app.name') . '*** to access the notification center and view the unread notifications.')
            ->line('- Review each notification carefully and take appropriate actions based on their importance and urgency.')
            ->line('- If any notifications require further investigation or response, please prioritize them accordingly.')
            ->line('If you have any questions or concerns regarding the notifications, feel free to reach out to developer team.')
            ->salutation('Thank you for your dedication to providing excellent user support and maintaining the integrity of our platform.');
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
