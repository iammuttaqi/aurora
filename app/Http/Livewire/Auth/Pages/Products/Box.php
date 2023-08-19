<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Box extends Component
{
    public $listeners = ['sessionUpdated' => 'render'];

    public function render()
    {
        $product_ids = session('product_ids');

        $products = Product::where('profile_id', auth()->user()->profile->id)
            ->whereIn('id', $product_ids ?? [])
            ->doesnthave('product_customers')
            ->get();
        $buyer_types = [
            ['title' => 'Customer', 'slug' => 'customer'],
            ['title' => 'Shop', 'slug' => 'shop'],
        ];

        $buyer_type_default = 'shop';
        if (Gate::allows('canSellToBoth', Product::class)) {
            $buyer_type_default = 'customer';
        }

        return view('livewire.auth.pages.products.box', compact('products', 'buyer_types', 'buyer_type_default'));
    }

    public function removeAll()
    {
        session()->forget('product_ids');
        $this->emit('sessionUpdated');
        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'All Product Removed from Product Box.',
        ]);
    }

    public function remove($product_id)
    {
        $product_ids     = session('product_ids');
        $new_product_ids = in_array($product_id, $product_ids) ? array_diff($product_ids, [$product_id]) : $product_ids;

        session()->put('product_ids', $new_product_ids);
        $this->emit('sessionUpdated');
    }
}
