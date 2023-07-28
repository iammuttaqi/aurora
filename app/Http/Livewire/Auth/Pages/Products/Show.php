<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    private $serial_number = null;

    public function mount($serial_number)
    {
        $this->serial_number = $serial_number;
    }

    public function render()
    {
        $product = Product::where('serial_number', $this->serial_number)->first();

        return view('livewire.auth.pages.products.show', compact('product'));
    }
}
