<?php

use App\Http\Livewire\Auth\Pages\Notifications\Index as NotificationsIndex;
use App\Http\Livewire\Auth\Pages\Notifications\Show as NotificationsShow;
use App\Http\Livewire\Auth\Pages\Partners\Index as PartnersIndex;
use App\Http\Livewire\Auth\Pages\Products\Create;
use App\Http\Livewire\Auth\Pages\Products\Index as ProductsIndex;
use App\Http\Livewire\Auth\Pages\Products\QrCode;
use App\Http\Livewire\Auth\Pages\Products\Show;
use App\Http\Livewire\Auth\Pages\Profile\Index as ProfileIndex;
use App\Http\Livewire\Auth\Pages\QrCode\Index as QrCodeIndex;
use App\Http\Livewire\Frontend\Pages\Index;
use App\Http\Livewire\Frontend\Pages\VerifyIdentity;
use App\Http\Livewire\Frontend\Pages\VerifyIdentityProduct;
use App\Http\Middleware\SetLayoutMiddleware;
use App\Models\Product;
use App\Models\Profile as ModelsProfile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;

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
    // $product = Product::with('manufacturer', 'shops')->first();

    // $shops = '';
    // foreach ($product->shops as $key => $shop) {
    //     $shops .= $shop->name . '-' . $shop->pivot->created_at . '<br>';
    // }

    // return new HtmlString('Manufacturer: ' . $product->manufacturer->name . '-' . $product->created_at . '<br><br> Shops: ' . $shops);

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
        Route::get('verify-product/{slug}', VerifyIdentityProduct::class)->name('verify_identity_product');
    });
});

// -------------------------------------- //

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('partners')->middleware('can:viewPartners,App\Models\User')->name('partners.')->group(function () {
        Route::get('/', PartnersIndex::class)->name('index');
        Route::get('{username}', ProfileIndex::class)->name('show');
        Route::get('qr-code/{username}', QrCodeIndex::class)->name('qr_code');
    });

    Route::get('profile', ProfileIndex::class)->name('profile')->can('viewAny', ModelsProfile::class);
    Route::get('qr-code', QrCodeIndex::class)->name('qr_code');

    // products route for shop and manufacturers
    Route::prefix('products')->middleware('can:viewProducts,App\Models\User')->name('products.')->group(function () {
        Route::get('/', ProductsIndex::class)->name('index');
        Route::get('create', Create::class)->name('create')->middleware('can:createProducts,App\Models\User');
        Route::get('/{serial_number}', Show::class)->name('show');
        Route::get('qr-code/{serial_number}', QrCode::class)->name('qr_code');
    });

    // customers route for shop

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', NotificationsIndex::class)->name('index');
        Route::get('{notification_id}', NotificationsShow::class)->name('show');
    });
});
