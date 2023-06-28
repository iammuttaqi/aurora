<?php

use App\Http\Livewire\Auth\Pages\Notifications;
use App\Http\Livewire\Auth\Pages\Profile;
use App\Http\Livewire\Auth\Pages\QrCode;
use App\Http\Livewire\Frontend\Pages\Index;
use App\Http\Livewire\Frontend\Pages\VerifyIdentity;
use App\Http\Middleware\SetLayoutMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('go', function () {
    // $username = ModelsProfile::value('username');
    // return redirect()->signedRoute('verify_identity', $username);
    return abort(404);
});

Route::get('sl/{user_id}', function ($user_id) {
    auth()->loginUsingId($user_id);

    return redirect()->route('dashboard');
});

// -------------------------------------- //

Route::middleware(SetLayoutMiddleware::class)->group(function () {
    Route::get('/', Index::class)->name('index');

    Route::middleware('signed')->group(function () {
        Route::get('verify-identity/{username}', VerifyIdentity::class)->name('verify_identity');
        // verify product url
    });
});

// -------------------------------------- //

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('profile', Profile::class)->name('profile')->middleware('can:viewAny,App\Models\Profile');
    Route::get('qr-code', QrCode::class)->name('qr_code')->middleware('can:viewAny,App\Models\Profile');
    // products route for shop
    // customers route for shop
    Route::get('notifications', Notifications::class)->name('notifications');
});
