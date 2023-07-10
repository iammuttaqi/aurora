<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 500) as $key => $range) {
            $products[] = [
                'manufacturer_id' => fake()->randomElement(
                    Profile::whereHas('user.role', function ($query) {
                        // $query->whereHas('role', function ($query) {
                        $query->where('slug', 'manufacturer');
                        // });
                    })
                        ->pluck('id')
                        ->toArray()
                ),
                'product_category_id'  => fake()->randomElement(ProductCategory::pluck('id')->toArray()),
                'name'                 => fake()->sentence,
                'slug'                 => str()->slug(fake()->sentence),
                'description'          => fake()->paragraph,
                'price'                => fake()->randomFloat(2, 0, 1000),
                'image'                => null,
                'serial_number'        => fake()->unique()->numerify('SN-########'),
                'qr_code'              => null,
                'warranty_period'      => fake()->numberBetween(1, 10),
                'warranty_period_unit' => fake()->randomElement(['days', 'weeks', 'months', 'years']),
                'created_at'           => now(),
                'updated_at'           => now(),
            ];
        }

        collect($products)->chunk(5000)->each(function ($product) {
            Product::insert($product->toArray());
        });
    }
}
