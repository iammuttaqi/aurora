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
        $this->call([
            CategorySeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            EmployeeRangeSeeder::class,
            PackageSeeder::class,
            ProductCategorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,

            PaymentTypeSeeder::class,
            PaymentMethodSeeder::class,

            ProfileSeeder::class,
            ProductSeeder::class,

            ProductProfileSeeder::class,

            // CustomerSeeder::class,
            // ProductCustomerSeeder::class,
            // ProfilePackageSeeder::class,
        ]);
    }
}
