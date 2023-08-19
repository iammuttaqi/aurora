<?php

namespace App\Http\Livewire\Auth\Components;

use App\Models\Product;
use App\Models\ProductProfile;
use App\Models\Profile;
use App\Notifications\User\BuyerProductSoldNotification;
use App\Notifications\User\SellerProductSoldNotification;
use Illuminate\Support\Facades\DB;
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

    public $shop_id = null;

    public function sell()
    {
        $this->validate([
            'shop_id' => ['required', 'integer', Rule::exists('profiles', 'id')],
        ]);

        DB::beginTransaction();
        try {
            $product_ids = session('product_ids');
            $profile     = Profile::where('id', $this->shop_id)->with('user')->first();

            if ($profile && is_array($product_ids) && count($product_ids)) {
                $product_shops = [];
                foreach ($product_ids as $key => $product_id) {
                    $product_shops[$key]['product_id'] = $product_id;
                    $product_shops[$key]['profile_id'] = $this->shop_id;
                    $product_shops[$key]['created_at'] = now();
                    $product_shops[$key]['updated_at'] = now();
                }

                Product::whereIn('id', $product_ids)->update([
                    'profile_id' => $this->shop_id,
                ]);
                ProductProfile::insert($product_shops);

                $profile->user->notify(new BuyerProductSoldNotification(request()->user()->profile));
                request()->user()->notify(new SellerProductSoldNotification($profile));

                DB::commit();
                $this->reset();
                session()->forget('product_ids');
                $this->emit('notificationsUpdated');
                $this->emit('sessionUpdated');
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'Product Sold to the Selected Shop.',
                ]);
            } else {
                DB::rollBack();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'danger',
                    'message' => 'No products on the box.',
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'danger',
                'message' => 'Failed.',
            ]);
            throw $th;
        }
    }
}
