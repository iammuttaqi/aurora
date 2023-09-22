<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CountrySeeder::class,
            CategorySeeder::class,
            CitySeeder::class,
            EmployeeRangeSeeder::class,

            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,

            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductProfileSeeder::class,

            CustomerSeeder::class,
            ProductCustomerSeeder::class,
            PackageSeeder::class,
        ]);
    }
}
