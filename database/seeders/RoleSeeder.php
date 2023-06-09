<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'title'      => 'Admin',
                'slug'       => 'admin',
                'type'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Owner',
                'slug'       => 'owner',
                'type'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Editor',
                'slug'       => 'editor',
                'type'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Role::insert($roles);
    }
}
