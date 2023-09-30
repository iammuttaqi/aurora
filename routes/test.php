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

Route::get('slrole/{role_id}', function ($role_id) {
    auth()->logout();
    $user_id = User::where('role_id', $role_id)->value('id');
    auth()->loginUsingId($user_id);

    return redirect()->route('dashboard');
});
