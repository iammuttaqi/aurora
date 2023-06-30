<?php

use App\Http\Livewire\Auth\Pages\Notifications;
use App\Http\Livewire\Auth\Pages\Partners\Index as PartnersIndex;
use App\Http\Livewire\Auth\Pages\Profile;
use App\Http\Livewire\Auth\Pages\QrCode;
use App\Http\Livewire\Frontend\Pages\Index;
use App\Http\Livewire\Frontend\Pages\VerifyIdentity;
use App\Http\Middleware\SetLayoutMiddleware;
use App\Models\Profile as ModelsProfile;
use App\Notifications\User\ProfileApproveNotification;
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
    $profile = ModelsProfile::where('approved', 1)->first();

    return (new ProfileApproveNotification($profile))
        ->toMail($profile);

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

    Route::prefix('partners')->middleware('can:viewPartners,App\Models\User')->name('partners.')->group(function () {
        Route::get('/', PartnersIndex::class)->name('index');
        Route::get('qr-code/{username}', QrCode::class)->name('qr_code');
    });

    Route::get('profile', Profile::class)->name('profile')->can('viewAny', ModelsProfile::class);
    Route::get('qr-code', QrCode::class)->name('qr_code');
    // products route for shop
    // customers route for shop
    Route::get('notifications', Notifications::class)->name('notifications');
});
