<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Test routes

Route::get('go', function () {
    return abort(404);
});

Route::get('artisan/{command}', function ($command) {
    Artisan::call($command);

    return $command;
});

Route::get('sl/{user_id}', function ($user_id) {
    auth()->logout();
    auth()->loginUsingId($user_id);

    return redirect()->route('dashboard');
});

Route::get('slrole/{role_id}/{approved?}', function ($role_id, $approved = false) {
    auth()->logout();

    $user_id = User::where('role_id', $role_id)
        ->when(in_array($role_id, [3, 4]), function ($query) use ($approved) {
            $query->whereHas('profile', function ($query) use ($approved) {
                $query->where('approved', $approved);
            });
        })
        ->value('id');

    auth()->loginUsingId($user_id);

    return redirect()->route('dashboard');
});
