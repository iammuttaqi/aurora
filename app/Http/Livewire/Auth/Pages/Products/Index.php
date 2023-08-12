<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use App\Models\ProductProfile;
use App\Models\ProductShop;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $products = Product::query()
            ->where('profile_id', auth()->user()->profile->id)
            ->with('profile', 'product_profiles')
            ->latest()
            ->paginate(10);
        $shops = Profile::has('user')
            ->with('user')
            ->whereHas('user.role', function ($query) {
                $query->where('slug', 'shop');
            })
            ->where('id', '!=', auth()->user()->profile->id)
            ->get();

        return view('livewire.auth.pages.products.index', compact('products', 'shops'));
    }

    public function destroy($serial_number)
    {
        Product::where('serial_number', $serial_number)->delete();

        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }

    public function duplicateProduct($serial_number)
    {
        $product                    = Product::where('serial_number', $serial_number)->first();
        $new_product                = $product->replicate();
        $new_product->image         = null;
        $new_product->serial_number = null;
        $new_product->qr_code       = null;
        $new_product->save();

        ProductProfile::create([
            'product_id' => $new_product->id,
            'profile_id' => $new_product->profile_id,
        ]);

        return $new_product;
    }

    public function duplicate($serial_number)
    {
        $this->duplicateProduct($serial_number);

        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }

    public $multi_duplicate_modal_open = false;

    public $multi_duplicate_count = 1;

    public $multi_duplicate_serial_number = null;

    public $check_all = false;

    public $checks = [];

    public $shop_id = null;

    public function duplicateMultiple()
    {
        DB::beginTransaction();
        try {
            if ($this->multi_duplicate_count && $this->multi_duplicate_serial_number) {
                foreach (range(1, $this->multi_duplicate_count) as $key => $range) {
                    $this->duplicateProduct($this->multi_duplicate_serial_number);
                }

                DB::commit();
                $this->reset();
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'success',
                    'message' => 'Product Duplicated.',
                ]);
            } else {
                $this->dispatchBrowserEvent('banner-message', [
                    'style'   => 'danger',
                    'message' => 'No product selected to duplicate.',
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

    public $sell_modal = false;

    // public function sell()
    // {
    //     $this->validate([
    //         'checks'   => ['required', 'array', 'min:1'],
    //         'checks.*' => ['required', 'integer', Rule::exists('products', 'id')],
    //         'shop_id'  => ['required', 'integer', Rule::exists('profiles', 'id')],
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         $product_shops = [];
    //         foreach ($this->checks as $key => $product_id) {
    //             $product_shops[$key]['shop_id']    = $this->shop_id;
    //             $product_shops[$key]['product_id'] = $product_id;
    //             $product_shops[$key]['created_at'] = now();
    //             $product_shops[$key]['updated_at'] = now();
    //         }

    //         ProductShop::insert($product_shops);

    //         DB::commit();
    //         $this->reset();
    //         $this->dispatchBrowserEvent('banner-message', [
    //             'style'   => 'success',
    //             'message' => 'Product Sold.',
    //         ]);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         logger(__METHOD__, [$th]);
    //         $this->dispatchBrowserEvent('banner-message', [
    //             'style'   => 'danger',
    //             'message' => 'Failed.',
    //         ]);
    //         throw $th;
    //     }
    // }
}
