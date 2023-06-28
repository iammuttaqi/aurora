<?php

use App\Http\Livewire\Auth\Pages\Notifications;
use App\Http\Livewire\Auth\Pages\Profile;
use App\Http\Livewire\Auth\Pages\QrCode;
use App\Http\Livewire\Frontend\Pages\Index;
use App\Http\Livewire\Frontend\Pages\VerifyCompany;
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
    // return redirect()->signedRoute('verify_company', 'bahringer-watsica-and-monahan');
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
        Route::get('verify-company/{username}', VerifyCompany::class)->name('verify_company');
        // verify product url
    });
});

// -------------------------------------- //

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('profile', Profile::class)->name('profile');
    Route::get('qr-code', QrCode::class)->name('qr_code');
    Route::get('notifications', Notifications::class)->name('notifications');
});
