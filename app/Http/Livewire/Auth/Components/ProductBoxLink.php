<?php

namespace App\Http\Livewire\Auth\Components;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ProductBoxLink extends Component
{
    protected $listeners = ['sessionUpdated' => 'mount'];

    public $product_box = false;

    public function mount()
    {
        $product_ids = session('product_ids');
        if (Gate::allows('viewProductBox', Product::class) && $product_ids && is_array($product_ids)) {
            $this->product_box = true;
        } else {
            $this->product_box = false;
        }
    }

    public function render()
    {
        return view('livewire.auth.components.product-box-link');
    }
}
