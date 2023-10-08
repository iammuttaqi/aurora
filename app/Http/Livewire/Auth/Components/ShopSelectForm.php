<?php

namespace App\Http\Livewire\Auth\Components;

use App\Models\Product;
use App\Models\ProductCustomer;
use App\Models\ProductProfile;
use App\Models\Profile;
use App\Notifications\User\BuyerProductSoldNotification;
use App\Notifications\User\SellerProductSoldNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ShopSelectForm extends Component
{
    public function render()
    {
        $shops = Profile::query()
            ->where('id', '!=', auth()->user()->profile->id)
            ->with('user.role')
            ->whereHas('user.role', function ($query) {
                $query->where('slug', 'shop');
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.auth.components.shop-select-form', compact('shops'));
    }

    public $username = null;

    public function sell()
    {
        $this->validate([
            'username' => ['required', 'string', Rule::exists('profiles', 'username')
                ->where(function ($query) {
                    $query->where('username', '!=', auth()->user()->profile->username)
                        ->where('approved', true);
                })],
        ]);

        DB::beginTransaction();
        try {
            $product_ids = session('product_ids');
            $profile     = Profile::where('username', $this->username)
                ->with('user')
                ->first();

            if (Gate::denies('canSell', Profile::class)) {
                DB::rollBack();
                $this->dispatch(
                    'banner-message',
                    style: 'danger',
                    message: 'Sorry! Your products count ended. Please Buy A Package.',
                );
            } elseif ($profile->user->role_id != 4) {
                DB::rollBack();
                $this->dispatch(
                    'banner-message',
                    style: 'danger',
                    message: 'Please select a valid username of a shop/reseller.',
                );
            } else {
                if ($profile && is_array($product_ids) && count($product_ids)) {
                    $product_shops = [];
                    foreach ($product_ids as $key => $product_id) {
                        $product_customer_exists = ProductCustomer::where('product_id', $product_id)->exists();

                        if (!$product_customer_exists) {
                            $product_shops[$key]['product_id'] = $product_id;
                            $product_shops[$key]['profile_id'] = $profile->id;
                            $product_shops[$key]['created_at'] = now();
                            $product_shops[$key]['updated_at'] = now();
                        }
                    }

                    Product::whereIn('id', $product_ids)->update([
                        'profile_id' => $profile->id,
                    ]);
                    ProductProfile::insert($product_shops);

                    $profile->user->notify(new BuyerProductSoldNotification(request()->user()->profile));
                    request()->user()->notify(new SellerProductSoldNotification($profile));

                    DB::commit();
                    $this->reset();
                    session()->forget('product_ids');
                    $this->dispatch('notificationsUpdated');
                    $this->dispatch('sessionUpdated');
                    $this->dispatch(
                        'banner-message',
                        style: 'success',
                        message: 'Product Sold to the Selected Shop/Reseller.',
                    );
                } else {
                    DB::rollBack();
                    $this->dispatch(
                        'banner-message',
                        style: 'danger',
                        message: 'No products on the box.',
                    );
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatch(
                'banner-message',
                style: 'danger',
                message: 'Failed.',
            );
            throw $th;
        }
    }
}
