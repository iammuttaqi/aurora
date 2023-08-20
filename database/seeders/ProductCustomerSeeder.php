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
        foreach (range(1, 10) as $key => $range) {
            $product_customers[] = [
                'product_id' => fake()->randomElement(
                    Product::doesnthave('product_customers')
                        ->pluck('id')
                        ->toArray()
                ),
                'customer_id' => fake()->randomElement(
                    Customer::pluck('id')->toArray()
                ),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($product_customers)->chunk(5000)->each(function ($product_customer) {
            ProductCustomer::insert($product_customer->toArray());
        });
    }
}
