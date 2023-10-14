<?php

namespace App\Http\Livewire\Auth\Pages\Customer;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $customer_id = null;

    public function mount($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function render()
    {
        $customer = Customer::where('id', $this->customer_id)->first();
        $products = Product::query()
            ->whereHas('product_customers', function ($query) {
                $query->where('customer_id', $this->customer_id);
            })
            ->paginate(100);

        return view('livewire.auth.pages.customer.products', compact('customer', 'products'));
    }
}
