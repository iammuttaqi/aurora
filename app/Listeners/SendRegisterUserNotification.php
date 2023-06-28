<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use App\Notifications\Admin\RegisterUserNotication as AdminRegisterUserNotication;
use App\Notifications\User\RegisterUserNotication as UserRegisterUserNotication;
use Illuminate\Support\Facades\Notification;

class SendRegisterUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $admins = User::with('role')
            ->has('role')
            ->whereHas('role', function ($query) {
                return $query->whereIn('slug', Role::slugsInArray('admin'));
            })
            ->get();

        $event->user->notify(new UserRegisterUserNotication);
        Notification::send($admins, new AdminRegisterUserNotication($event->user));
    }
}
