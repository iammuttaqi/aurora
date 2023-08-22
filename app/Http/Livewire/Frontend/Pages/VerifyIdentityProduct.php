<?php

namespace App\Http\Livewire\Frontend\Pages;

use App\Models\Product;
use Livewire\Component;

class VerifyIdentityProduct extends Component
{
    public $serial_number;

    public function mount($serial_number)
    {
        $this->serial_number = $serial_number;
    }

    public function render()
    {
        $product = Product::where('serial_number', $this->serial_number)
            ->with('product_profiles.profile.user', 'product_customers.customer')
            ->first();

        return view('livewire.frontend.pages.verify-identity-product', compact('product'));
    }
}
