<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\City;
use App\Models\EmployeeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->randomElement(
                User::with('role')
                    ->whereHas('role', function ($query) {
                        $query->where('type', 'user');
                    })
                    ->pluck('id')
                    ->toArray()
            ),
            'name'                       => fake()->company,
            'contact_person'             => fake()->name,
            'address'                    => fake()->address,
            'city_id'                    => fake()->randomElement(City::pluck('id')->toArray()),
            'contact_number_1'           => fake()->phoneNumber,
            'contact_number_2'           => fake()->phoneNumber,
            'contact_number_3'           => fake()->phoneNumber,
            'email_1'                    => fake()->email,
            'email_2'                    => fake()->email,
            'email_3'                    => fake()->email,
            'website'                    => fake()->url,
            'about'                      => fake()->paragraph,
            'logo'                       => null,
            'map_link'                   => fake()->url,
            'facebook'                   => fake()->url,
            'instagram'                  => fake()->url,
            'twitter'                    => fake()->url,
            'linkedin'                   => fake()->url,
            'category_ids'               => array_map('strval', fake()->randomElements(Category::pluck('id')->toArray(), 3)),
            'employee_range_id'          => fake()->randomElement(EmployeeRange::pluck('id')->toArray()),
            'tax_number'                 => $this->ean13(),
            'business_license'           => null,
            'vat_number'                 => $this->ean13(),
            'payment_terms'              => fake()->word,
            'shipping_options'           => null,
            'additional_information'     => fake()->paragraph,
            'general_manager_name'       => fake()->name,
            'general_manager_email'      => fake()->email,
            'sales_manager_name'         => fake()->name,
            'sales_manager_email'        => fake()->email,
            'hr_manager_name'            => fake()->name,
            'hr_manager_email'           => fake()->email,
            'it_manager_name'            => fake()->name,
            'it_manager_email'           => fake()->email,
            'manufacturing_capabilities' => fake()->paragraph,
            'certifications'             => fake()->paragraph,
        ];
    }

    protected function ean13()
    {
        $code = '200'; // Replace with your desired code prefix
        for ($i = 0; $i < 9; $i++) {
            $code .= mt_rand(0, 9);
        }
        $sum = 0;
        for ($i = 0; $i < 12; $i += 2) {
            $sum += $code[$i];
        }
        for ($i = 1; $i < 12; $i += 2) {
            $sum += $code[$i] * 3;
        }
        $code .= (10 - ($sum % 10)) % 10;

        return $code;
    }
}
