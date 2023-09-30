<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Http\Livewire\Frontend\Pages\Checkout;
use App\Models\Package;
use Livewire\Component;

class PricingCard extends Component
{
    public $package_id;

    public $purchaseable = true;

    public function render()
    {
        $package = Package::where('id', $this->package_id)->first();

        return view('livewire.frontend.components.pricing-card', compact('package'));
    }

    public function purchase($package_id)
    {
        session()->put('package_id', $package_id);

        $this->redirect(Checkout::class, navigate: true);
    }
}
