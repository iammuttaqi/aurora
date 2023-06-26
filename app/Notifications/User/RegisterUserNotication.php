<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterUserNotication extends Notification
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
            ->subject('Welcome to ' . config('app.name') . '! Thank you for Registering')
            ->greeting('Welcome to ' . config('app.name') . '!')
            ->lines([
                'Dear ' . $notifiable->name . ',',

                'Thank you for registering with ' . config('app.name') . '! We are excited to have you as a new member of our community. Your registration details are as follows:',

                '- **Name**: ' . $notifiable->name,
                '- **Email Address**: ' . $notifiable->email,
                '- **Date of Registration**: ' . $notifiable->created_at->format('d F, Y - h:i A'),
                '- **Role**: ' . $notifiable->role->title,

                'With your registration, you now have access to a wide range of features and benefits. Here\'s what you can expect:',

                '- ***Explore our platform***: Discover a wealth of resources, services, and tools designed to [describe the purpose or value of your platform].',
                '- ***Connect with others***: Engage with like-minded individuals, participate in discussions, and foster meaningful connections within our community.',
                '- ***Stay up to date***: Receive updates, news, and relevant information about ' . config('app.name') . ' and the industry.',
                '- ***Personalize your experience***: Customize your profile, set preferences, and tailor your interaction with the platform to suit your needs.',

                'If you have any questions or concerns regarding this registration, please don\'t hesitate to reach out to the user directly or contact our support team at developers@aurora.com.',

                'Thank you for your prompt attention to this matter.',
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $notifiable->toArray();
    }
}
