<?php

namespace App\Http\Livewire\Auth\Pages\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $products = Product::where('manufacturer_id', auth()->user()->profile->id)->latest()->paginate(50);

        return view('livewire.auth.pages.products.index', compact('products'));
    }

    public function destroy($serial_number)
    {
        Product::where('serial_number', $serial_number)->delete();
        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }

    public function duplicate($serial_number)
    {
        $product = Product::where('serial_number', $serial_number)->first();
        $new_product = $product->replicate();
        $new_product->image = null;
        $new_product->serial_number = null;
        $new_product->qr_code = null;
        $new_product->save();

        $this->dispatchBrowserEvent('banner-message', [
            'style'   => 'success',
            'message' => 'Product Deleted.',
        ]);
    }
}
