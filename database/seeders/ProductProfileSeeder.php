<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProfile;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProductProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 1000) as $key => $range) {
            $profile_products[] = [
                'product_id' => fake()->randomElement(Product::whereBetween('id', [1, 200])->pluck('id')->toArray()),
                'profile_id' => fake()->randomElement(
                    Profile::whereHas('user.role', function ($query) {
                        $query->where('slug', 'manufacturer');
                    })
                        ->pluck('id')
                        ->toArray()
                ),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($profile_products)->chunk(5000)->each(function ($profile_product) {
            ProductProfile::insert($profile_product->toArray());
        });
    }
}
