<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_methods = [
            [
                'payment_type_id' => 1,
                'title'           => 'Bkash',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'payment_type_id' => 1,
                'title'           => 'Nagad',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'payment_type_id' => 1,
                'title'           => 'Rocket',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'payment_type_id' => 2,
                'title'           => 'Visa',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'payment_type_id' => 2,
                'title'           => 'MasterCard',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ];

        PaymentMethod::insert($payment_methods);
    }
}
