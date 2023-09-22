<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Livewire\Component;

class QrCode extends Component
{
    public $serial_number = null;

    public function mount($serial_number)
    {
        $this->serial_number = $serial_number;
    }

    public function render()
    {
        $product = Product::where('serial_number', $this->serial_number)->first();

        return view('livewire.auth.pages.products.qr-code', compact('product'));
    }

    public function download($serial_number)
    {
        $product = Product::where('serial_number', $serial_number)->first();

        return response()
            ->stream(function () use ($product) {
                echo $product->qr_code;
            }, 200, [
                'Content-Type' => 'image/svg+xml',
                'Content-Disposition' => 'attachment; filename="' . $serial_number . '.svg"'
            ]);
    }
}
