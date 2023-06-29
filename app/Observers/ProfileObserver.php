<?php

namespace App\Observers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Notifications\Admin\ProfileUpdateNotification;
use Illuminate\Support\Facades\Notification;

class ProfileObserver
{
    public $afterCommit = true;

    /**
     * Handle the Profile "created" event.
     */
    private function profileUpdateNotification()
    {
        $admins = User::with('role')
            ->has('role')
            ->whereHas('role', function ($query) {
                return $query->whereIn('slug', Role::slugsInArray('admin'));
            })
            ->get();

        Notification::send($admins, new ProfileUpdateNotification());
    }

    public function created(Profile $profile): void
    {
        $this->profileUpdateNotification();
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        $this->profileUpdateNotification();
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
