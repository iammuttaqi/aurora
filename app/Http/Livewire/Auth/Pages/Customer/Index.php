<?php

namespace App\Http\Livewire\Auth\Pages\Customer;

use App\Models\Customer;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $customers = Customer::where('profile_id', auth()->user()->profile->id)->latest()->paginate(50);

        return view('livewire.auth.pages.customer.index', compact('customers'));
    }
}
