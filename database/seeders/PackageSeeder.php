<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'popular'        => false,
                'title'          => 'Free',
                'price'          => 0,
                'products_count' => 100,
                'details'        => 'Free Plan',
                'features'       => json_encode([
                    ['title' => '100 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'popular'        => true,
                'title'          => 'Startup',
                'price'          => 5000,
                'products_count' => 1000,
                'details'        => 'For new business',
                'features'       => json_encode([
                    ['title' => '1000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'popular'        => false,
                'title'          => 'Growing',
                'price'          => 20000,
                'products_count' => 5000,
                'details'        => 'For growing business',
                'features'       => json_encode([
                    ['title' => '5000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => false],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'popular'        => false,
                'title'          => 'Enterprise',
                'price'          => 40000,
                'products_count' => 10000,
                'details'        => 'Advanced features',
                'features'       => json_encode([
                    ['title' => '10000 Products', 'active' => true],
                    ['title' => 'Technical Support', 'active' => true],
                    ['title' => 'Instant Approval', 'active' => true],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Package::insert($packages);
    }
}
