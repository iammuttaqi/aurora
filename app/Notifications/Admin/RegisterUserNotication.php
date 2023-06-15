<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterUserNotication extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
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
            ->subject('New User Registration: Action Required')
            ->greeting('New User Registration')
            ->lines([
                'Dear Admin,',
                'We are excited to inform you that a new user has registered on our platform, and we wanted to provide you with the details for your records. Please review the information below and take any necessary actions.',
                'User Details:',
                '- ***Name***: ' . $this->user->name,
                '- ***Email Address***: ' . $this->user->email,
                '- ***Date of Registration***: ' . $this->user->created_at->format('d F, Y - h:i A'),
                'To ensure a seamless user experience and maintain the security of our platform, we kindly request your attention to the following:',
                '- Review the user\'s registration details for accuracy and completeness.',
                '- If any additional verification or approval processes are required, please follow your standard procedures.',
                '- If the registration seems suspicious or requires further investigation, take appropriate actions, such as contacting the user or performing additional checks.',
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
        return $this->user->toArray();
    }
}
