<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductShop;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 1000) as $key => $range) {
            $shop_products[] = [
                'product_id' => fake()->randomElement(Product::whereBetween('id', [1, 200])->pluck('id')->toArray()),
                'shop_id'    => fake()->randomElement(
                    Profile::whereHas('user.role', function ($query) {
                        $query->where('slug', 'shop');
                    })
                        ->pluck('id')
                        ->toArray()
                ),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($shop_products)->chunk(5000)->each(function ($shop_product) {
            ProductShop::insert($shop_product->toArray());
        });
    }
}
