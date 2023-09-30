<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_types = [
            ['title' => 'Mobile Banking', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Card Payment', 'created_at' => now(), 'updated_at' => now()],
        ];

        PaymentType::insert($payment_types);
    }
}
