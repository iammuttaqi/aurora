<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Dhaka',
            'Chattogram',
            'Feni',
            'Noakhali',
        ];

        $bangladesh_id = Country::where('iso', 'bd')->value('id');

        foreach ($cities as $key => $city) {
            City::create([
                'name'       => $city,
                'country_id' => $bangladesh_id,
            ]);
        }
    }
}
