<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\EmployeeRange;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('type', 'user');
            })
            ->whereDoesntHave('profile')
            ->get();

        $profiles = [];
        foreach ($users as $key => $user) {
            $profiles[] = [
                'user_id' => $user->id,
                'name'              => $user->name,
                'username'          => fake()->slug() . uniqid(),
                'contact_person'    => fake()->name,
                'address'           => fake()->address,
                'city_id'           => fake()->randomElement(City::pluck('id')->toArray()),
                'contact_number_1'  => fake()->phoneNumber,
                'contact_number_2'  => fake()->phoneNumber,
                'contact_number_3'  => fake()->phoneNumber,
                'email_1'           => fake()->email,
                'email_2'           => fake()->email,
                'email_3'           => fake()->email,
                'website'           => fake()->url,
                'about'             => fake()->paragraph,
                'logo'              => fake()->imageUrl(),
                'map_link'          => fake()->regexify('https://goo\.gl/maps/[a-z]{10}[0-9]{5}'),
                'facebook'          => fake()->regexify('https://www\.facebook\.com/[a-z]{6}[0-9]{4}'),
                'instagram'         => fake()->regexify('https://www\.instagram\.com/[a-z]{6}[0-9]{4}'),
                'twitter'           => fake()->regexify('https://www\.twitter\.com/[a-z]{6}[0-9]{4}'),
                'linkedin'          => fake()->regexify('https://www\.linkedin\.com/in/[a-z]{6}[0-9]{4}'),
                'category_ids'      => json_encode(array_map('strval', fake()->randomElements(Category::pluck('id')->toArray(), 3))),
                'employee_range_id' => fake()->randomElement(EmployeeRange::pluck('id')->toArray()),
                'tax_number'        => fake()->regexify('[A-Z]{2}[0-9]{8}'),
                'business_license'  => fake()->regexify('[A-Z]{3}[0-9]{6}'),
                'vat_number'        => fake()->regexify('[A-Z]{2}[0-9]{9}'),
                'payment_terms'     => implode(
                    ', ',
                    fake()->randomElements([
                        'Net 30 Days',
                        'Net 60 Days',
                        'Net 90 Days',
                        'Pay Upon Receipt',
                        'Cash On Delivery',
                    ])
                ),
                'shipping_options' => implode(
                    ', ',
                    fake()->randomElements([
                        'Standard Delivery',
                        'Express Shipping',
                        'Next-Day Delivery',
                        'Free Shipping',
                        'International Shipping',
                        'Local Pickup Only',
                        'Curbside Delivery',
                        'Two-Day Shipping',
                        'Priority Shipping',
                        'Same-Day Delivery',
                    ])
                ),
                'additional_information'     => fake()->paragraph(10),
                'general_manager_name'       => fake()->name,
                'general_manager_email'      => fake()->email,
                'sales_manager_name'         => fake()->name,
                'sales_manager_email'        => fake()->email,
                'hr_manager_name'            => fake()->name,
                'hr_manager_email'           => fake()->email,
                'it_manager_name'            => fake()->name,
                'it_manager_email'           => fake()->email,
                'manufacturing_capabilities' => fake()->sentence,
                'certifications'             => fake()->words(3, true),
                'created_at'                 => now(),
                'updated_at'                 => now(),
            ];
        }

        collect($profiles)->chunk(5000)->each(function ($profile) {
            Profile::insert($profile->toArray());
        });
    }
}
