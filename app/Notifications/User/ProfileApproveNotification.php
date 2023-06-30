<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileApproveNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $profile;

    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Congratulations! Your Account Has Been Approved!')
            ->greeting('Congratulations!')
            ->line('Dear ' . $notifiable->name . ',')
            ->line('We are pleased to inform you that your request for partnership on our platform has been approved.')
            ->line('As an approved partner, you now have access to exclusive features and resources.')
            ->line('To verify your existence on our platform, we have assigned you a unique QR code.')
            ->line('**Please find below your assigned QR code:**')
            ->action('QR Code', route('qr_code'))
            ->line('Use this QR code to validate your presence and affiliation with our platform.')
            ->line('***IMPORTANT: To access your QR code and other partner features, please make sure to log in to your account.***')
            ->line('If you have any questions or need assistance, feel free to reach out to our support team.')
            ->line('Thank you for partnering with us. We look forward to a successful collaboration.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->profile->toArray();
    }
}
