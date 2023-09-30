<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProfile;
use Illuminate\Database\Seeder;

class ProductProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::has('profile')->with('profile')->get();

        $profile_products = [];
        foreach ($products as $key => $product) {
            $profile_products[] = [
                'product_id' => $product->id,
                'profile_id' => $product->profile->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($profile_products)->chunk(5000)->each(function ($profile_product) {
            ProductProfile::insert($profile_product->toArray());
        });
    }
}
