<?php

use App\Http\Livewire\Auth\Pages\Customer\Index as CustomerIndex;
use App\Http\Livewire\Auth\Pages\Customer\Products;
use App\Http\Livewire\Auth\Pages\Notifications\Index as NotificationsIndex;
use App\Http\Livewire\Auth\Pages\Notifications\Show as NotificationsShow;
use App\Http\Livewire\Auth\Pages\Partners\Index as PartnersIndex;
use App\Http\Livewire\Auth\Pages\Products\Box as ProductsBox;
use App\Http\Livewire\Auth\Pages\Products\Create;
use App\Http\Livewire\Auth\Pages\Products\Edit;
use App\Http\Livewire\Auth\Pages\Products\Index as ProductsIndex;
use App\Http\Livewire\Auth\Pages\Products\QrCode;
use App\Http\Livewire\Auth\Pages\Products\Show;
use App\Http\Livewire\Auth\Pages\Products\Sold as ProductsSold;
use App\Http\Livewire\Auth\Pages\Profile\Index as ProfileIndex;
use App\Http\Livewire\Auth\Pages\QrCode\Index as QrCodeIndex;
use App\Http\Livewire\Frontend\Components\ThankYou;
use App\Http\Livewire\Frontend\Pages\Checkout;
use App\Http\Livewire\Frontend\Pages\Index;
use App\Http\Livewire\Frontend\Pages\VerifyIdentity;
use App\Http\Livewire\Frontend\Pages\VerifyIdentityProduct;
use App\Http\Middleware\SetLayoutMiddleware;
use App\Models\Profile as ModelsProfile;
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

require 'test.php';

// ------------------------------------------------------------------------------------------------------------------ //

Route::middleware(SetLayoutMiddleware::class)->group(function () {
    Route::get('/', Index::class)->name('index');
    Route::middleware(['auth'])->group(function () {
        Route::get('checkout', Checkout::class)->name('checkout');
        Route::get('thank-you', ThankYou::class)->name('thank_you')->middleware('signed');
    });

    Route::middleware('signed')->group(function () {
        Route::get('verify-identity/{username}', VerifyIdentity::class)->name('verify_identity');
        Route::get('verify-product/{serial_number}', VerifyIdentityProduct::class)->name('verify_identity_product');
    });
});

// ------------------------------------------------------------------------------------------------------------------ //

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('partners')->middleware('can:viewPartners,App\Models\User')->name('partners.')->group(function () {
        Route::get('/', PartnersIndex::class)->name('index')->lazy();
        Route::get('{username}', ProfileIndex::class)->name('show');
        Route::get('qr-code/{username}', QrCodeIndex::class)->name('qr_code');
    });

    Route::get('profile', ProfileIndex::class)->name('profile')->can('viewAny', ModelsProfile::class);
    Route::get('qr-code', QrCodeIndex::class)->name('qr_code');

    // products route for shop and manufacturers
    Route::prefix('products')->name('products.')->middleware('can:viewAny,App\Models\Product')->group(function () {
        Route::get('/', ProductsIndex::class)->name('index');
        Route::get('create', Create::class)->name('create')->middleware('can:create,App\Models\Product');
        Route::get('edit/{serial_number}', Edit::class)->name('edit');
        Route::get('show/{serial_number}', Show::class)->name('show');
        Route::get('qr-code/{serial_number}', QrCode::class)->name('qr_code');
        Route::get('box', ProductsBox::class)->name('box');

        Route::get('sold', ProductsSold::class)->name('sold');
    });

    // customers route for shop
    Route::prefix('customers')->name('customers.')->middleware('can:viewAny,App\Models\Customer')->group(function () {
        Route::get('/', CustomerIndex::class)->name('index');
        Route::get('products/{customer_id}', Products::class)->name('products');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', NotificationsIndex::class)->name('index');
        Route::get('{notification_id}', NotificationsShow::class)->name('show');
    });
});
