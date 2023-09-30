<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::where('approved', 1)->get();

        $products = [];
        foreach ($profiles as $key => $profile) {
            foreach (range(1, 3) as $key => $range) {
                $serial_number = fake()->unique()->numerify('SN-########');
                $url           = URL::signedRoute('verify_identity_product', $serial_number);
                $qr_code       = QrCode::size(500)->generate($url);

                $products[] = [
                    'profile_id'           => $profile->id,
                    'product_category_id'  => fake()->randomElement(ProductCategory::pluck('id')->toArray()),
                    'title'                => fake()->sentence,
                    'description'          => fake()->paragraph,
                    'price'                => fake()->randomFloat(2, 0, 1000),
                    'image'                => fake()->imageUrl,
                    'serial_number'        => $serial_number,
                    'qr_code'              => $qr_code,
                    'warranty_period'      => fake()->numberBetween(1, 10),
                    'warranty_period_unit' => fake()->randomElement(['days', 'weeks', 'months', 'years']),
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ];
            }
        }

        collect($products)->chunk(5000)->each(function ($product) {
            Product::insert($product->toArray());
        });
    }
}
