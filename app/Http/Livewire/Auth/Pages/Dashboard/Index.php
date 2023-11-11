<?php

namespace App\Http\Livewire\Auth\Pages\Dashboard;

use App\Models\Customer;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductCustomer;
use App\Models\Profile;
use App\Models\ProfilePackage;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $items = [];

        if (auth()->user()->role->type == 'admin') {
            $items = [
                [
                    'title' => 'Partners',
                    'details' => Profile::count(),
                ],
                [
                    'title' => 'Products',
                    'details' => Product::count(),
                ],
                [
                    'title' => 'Customers',
                    'details' => Customer::count(),
                ],
            ];
        } else if (auth()->user()->role->type == 'user') {
            $sold_products_count = Product::query()
                ->where('profile_id', '!=', auth()->user()->profile->id)
                ->whereHas('product_profiles', function ($query) {
                    $query->where('profile_id', auth()->user()->profile->id);
                })
                ->orWhereHas('product_customers', function ($query) {
                    $query->where('profile_id', auth()->user()->profile->id);
                })
                ->latest()
                ->count();

            $free_package_count = Package::where('id', 1)->value('products_count');
            $profile_packages   = ProfilePackage::where('profile_id', auth()->user()->profile->id)
                ->with('package')
                ->get();

            $packages_count = $free_package_count;
            foreach ($profile_packages as $key => $profile_package) {
                $packages_count += $profile_package->package->products_count;
            }
            $products_count_left = ($packages_count - $sold_products_count);

            $items = [
                [
                    'title' => 'Products',
                    'details' => Product::where('profile_id', auth()->user()->profile->id)->count(),
                ],
                [
                    'title' => 'Sold Products',
                    'details' => $sold_products_count,
                ],
                [
                    'title' => 'In Stock To Sell',
                    'details' => $products_count_left,
                ],
            ];
        }

        if (auth()->user()->role->slug == 'shop') {
            $items[] = [
                'title' => 'Customers',
                'details' => Customer::where('profile_id', auth()->user()->profile->id)->count(),
            ];
        }

        return view('livewire.auth.pages.dashboard.index', compact('items'));
    }
}
