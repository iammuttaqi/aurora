<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCustomer;
use Illuminate\Database\Seeder;

class ProductCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        $product_customers = [];
        foreach ($customers as $key => $customer) {
            $product_customers[] = [
                'product_id' => fake()->randomElement(
                    Product::doesnthave('product_customers')
                        ->pluck('id')
                        ->toArray()
                ),
                'customer_id' => $customer->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($product_customers)->chunk(5000)->each(function ($product_customer) {
            ProductCustomer::insert($product_customer->toArray());
        });
    }
}
