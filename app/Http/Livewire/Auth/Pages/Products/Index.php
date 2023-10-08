<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Package;
use App\Models\Product;
use App\Models\ProductProfile;
use App\Models\ProfilePackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::query()
            ->where('profile_id', auth()->user()->profile->id)
            ->doesnthave('product_customers')
            ->latest()
            ->paginate(100);

        $sold_products_count = Product::query()
            ->where('profile_id', '!=', auth()->user()->profile->id)
            ->whereHas('product_profiles', function ($query) {
                $query->where('profile_id', auth()->user()->profile->id);
            })
            ->latest()
            ->count();

        $free_package_count = Package::where('id', 1)->value('products_count');
        $profile_packages   = ProfilePackage::where('profile_id', auth()->user()->profile->id)
            ->with('package')
            ->get();

        $packages_count = $free_package_count;
        foreach ($profile_packages as $key => $profile_package) {
            $packages_count += $profile_package->package->products_count;
        }
        $products_count_left = ($packages_count - $sold_products_count);

        return view('livewire.auth.pages.products.index', compact('products', 'packages_count', 'products_count_left'));
    }

    public function destroy($serial_number)
    {
        Product::where('serial_number', $serial_number)->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'Product Deleted.',
        );
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

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'Product Deleted.',
        );
    }

    public $multi_duplicate_modal_open = false;

    public $multi_duplicate_count = 1;

    public $multi_duplicate_serial_number = null;

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
                $this->dispatch(
                    'banner-message',
                    style: 'success',
                    message: 'Product Duplicated.',
                );
            } else {
                $this->dispatch(
                    'banner-message',
                    style: 'danger',
                    message: 'No product selected to duplicate.',
                );
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

    public $sell_modal = false;

    public $check_all = false;

    public $checks = [];

    public function addToBox()
    {
        $this->validate([
            'checks'   => ['required', 'array', 'min:1'],
            'checks.*' => ['required', 'integer', Rule::exists('products', 'id')],
        ]);

        $product_ids = is_array(session('product_ids')) ? array_merge(session('product_ids'), $this->checks) : $this->checks;

        session()->put('product_ids', $product_ids);

        $this->reset('checks');
        $this->dispatch('sessionUpdated');
        $this->dispatch(
            'banner-message',
            style: 'success',
            message: 'Products added to the box.',
        );

        return $this->redirect(route('products.box'), navigate: true);
    }
}
