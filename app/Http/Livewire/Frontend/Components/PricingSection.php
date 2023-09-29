<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Http\Livewire\Frontend\Pages\Cart;
use App\Http\Livewire\Frontend\Pages\Checkout;
use App\Models\Package;
use Livewire\Component;

class PricingSection extends Component
{
    public function render()
    {
        $packages = Package::all();

        return view('livewire.frontend.components.pricing-section', compact('packages'));
    }
}
