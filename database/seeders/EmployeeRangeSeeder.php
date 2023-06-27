<?php

namespace Database\Seeders;

use App\Models\EmployeeRange;
use Illuminate\Database\Seeder;

class EmployeeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee_ranges = [
            '1-10',
            '11-50',
            '51-100',
            '101-500',
            '501-1000',
            '1001+',
        ];

        foreach ($employee_ranges as $key => $employee_range) {
            EmployeeRange::create(['title' => $employee_range]);
        }
    }
}
