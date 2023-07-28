<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Livewire\Component;

class QrCode extends Component
{
    public $product = null;

    public function mount($serial_number)
    {
        $this->product = Product::where('serial_number', $serial_number)->first();
    }

    public function render()
    {
        return view('livewire.auth.pages.products.qr-code');
    }
}
