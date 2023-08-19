<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 100) as $key => $range) {
            $customers[] = [
                'profile_id' => fake()->randomElement(
                    Profile::whereHas('user.role', fn ($query) => $query->where('slug', 'shop'))
                        ->pluck('id')
                        ->toArray()
                ),
                'name'         => fake()->name,
                'email'        => fake()->unique()->safeEmail,
                'phone_number' => fake()->phoneNumber,
                'address'      => fake()->address,
                'city'         => fake()->city,
                'country_id'   => 18, //Bangladesh
                'age'          => fake()->numberBetween(18, 80),
                'gender'       => fake()->randomElement(['Male', 'Female', 'Other']),
                'notes'        => fake()->paragraph,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        collect($customers)->chunk(5000)->each(function ($customer) {
            Customer::insert($customer->toArray());
        });
    }
}
