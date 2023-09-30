<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 100) as $key => $range) {
            $name  = fake()->name();
            $email = uniqid() . fake()->unique()->safeEmail();

            if ($range == 1) {
                $role_id = fake()->randomElement(Role::where('slug', 'admin')->pluck('id')->toArray());
                $name    = 'Admin';
                $email   = config('mail.from.address');
            } elseif ($range > 1 && $range <= 10) {
                $role_id = fake()->randomElement(Role::where('type', 'admin')->where('slug', '!=', 'admin')->pluck('id')->toArray());
            } elseif ($range >= 11 && $range <= 60) {
                $role_id = fake()->randomElement(Role::where('slug', 'manufacturer')->pluck('id')->toArray());
            } elseif ($range >= 61 && $range <= 100) {
                $role_id = fake()->randomElement(Role::where('slug', 'shop')->pluck('id')->toArray());
            }

            $users[] = [
                'role_id'                   => $role_id,
                'name'                      => $name,
                'email'                     => $email,
                'email_verified_at'         => now(),
                'password'                  => '$2y$10$zeIVfQDopmzIyEMvv8Mh7OOfRMwqPZYPPHRjlpe0L96hRYZCOZvCS', //password
                'two_factor_secret'         => null,
                'two_factor_recovery_codes' => null,
                'remember_token'            => str()->random(10),
                'profile_photo_path'        => null,
                'current_team_id'           => null,
                'created_at'                => now(),
                'updated_at'                => now(),
            ];
        }

        User::insert($users);
    }
}
