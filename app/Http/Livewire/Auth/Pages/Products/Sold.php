<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use App\Models\ProductProfile;
use Livewire\Component;

class Sold extends Component
{
    public function render()
    {
        $sold_products = Product::query()
            ->where('profile_id', '!=', auth()->user()->profile->id)
            ->whereHas('product_profiles', function ($query) {
                $query->where('profile_id', auth()->user()->profile->id);
            })
            ->latest()
            ->paginate(100);

        return view('livewire.auth.pages.products.sold', compact('sold_products'));
    }
}
