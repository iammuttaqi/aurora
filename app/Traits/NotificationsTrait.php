<?php

namespace App\Traits;

trait NotificationsTrait
{
    public function getMessage($notification)
    {
        return match ($notification->type) {
            'App\Notifications\Admin\RegisterUserNotication'    => 'New User: ' . $notification->data['name'],
            'App\Notifications\User\RegisterUserNotication'     => 'Welcome to ' . config('app.name') . ': ' . $notification->data['name'],
            'App\Notifications\Admin\ProfileUpdateNotification' => 'Profile Update: ' . $notification->data['name'],
            'App\Notifications\User\ProfileApproveNotification' => 'Congratulations! Your Profile Has Been Approved: ' . $notification->data['name'],
            default                                             => $notification->type,
        };
    }
}
