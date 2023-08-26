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

    public function warrantyTill($date_from, $warranty_period, $warranty_period_unit)
    {
        // 'days', 'weeks', 'months', 'years'

        if ($warranty_period_unit == 'days') {
            return $date_from->addDays($warranty_period);
        } elseif ($warranty_period_unit == 'weeks') {
            return $date_from->addWeeks($warranty_period);
        } elseif ($warranty_period_unit == 'months') {
            return $date_from->addMonths($warranty_period);
        } elseif ($warranty_period_unit == 'years') {
            return $date_from->addYears($warranty_period);
        }

        return null;
    }

    public function warrantyExpired($date)
    {
        return $date < now();
    }
}
