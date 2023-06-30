<?php

use App\Models\Role;
use App\Models\User;
use App\Notifications\Admin\ProfileUpdateCountNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:profile-update-count-notification', function () {
    try {
        $admins = User::with('role')
            ->has('role')
            ->whereHas('role', function ($query) {
                return $query->whereIn('slug', Role::slugsInArray('admin'));
            })
            ->get();

        $this->withProgressBar($admins, function ($admin) {
            $notificationCount = $admin->notifications()
                ->where('read_at', null)
                ->whereDate('created_at', today())
                ->count();

            if ($notificationCount) {
                $this->comment(' sending...');
                $admin->notify((new ProfileUpdateCountNotification($notificationCount)));
                $this->info(' sent!');
            }
            sleep(10);
        });
    } catch (\Throwable $th) {
        logger('admin:profile-update-count-notification', [$th]);
        throw $th;
    }
})->purpose('Admin Profile Update Count Notification');
