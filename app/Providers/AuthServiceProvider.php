<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Your Email Address - Complete Your Account Registration')
                ->greeting('Verify Your Email Address')
                ->lines([
                    'Dear ' . $notifiable->name . ',',
                    'Welcome to ' . config('app.name') . '! We\'re delighted to have you as a part of our community. To finalize your account registration and ensure the security of your information, we kindly ask you to verify your email address.',
                    'Verifying your email is a simple and important step. Please click on the link below to confirm your email:',
                ])
                ->action('Verify Email Address', $url)
                ->lines([
                    'By completing this verification process, you\'ll unlock the full potential of your ' . config('app.name') . ' account. Here\'s why it matters:',
                    '- ***Secure Your Account***: Verifying your email adds an extra layer of protection, preventing unauthorized access and keeping your personal data safe.',
                    '- ***Activate Your Account***: Once your email is verified, your account will be fully activated, granting you access to all our exciting features and functionalities.',
                    '- ***Stay Informed***: With a verified email address, you\'ll receive important updates, product announcements, and exclusive offers tailored specifically for you.',
                    'If you can\'t find the verification email in your inbox, please remember to check your spam or junk folder. Should you require any assistance, our dedicated support team is ready to assist you.',
                    'We\'re thrilled to have you as a valued member of the ' . config('app.name') . ' family! If you have any questions, feedback, or need further assistance, please feel free to reach out to us anytime.',
                    'Thank you for choosing ' . config('app.name') . '!',
                ]);
        });
    }
}
