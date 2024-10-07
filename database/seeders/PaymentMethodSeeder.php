<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'type' => 'Cash',
            'payment_name' => 'Bayar Ditempat',
            'account_holder' => '',
            'account_number' => '',
            'isActivated' => true
        ]);

        PaymentMethod::create([
            'type' => 'Transfer Bank',
            'payment_name' => 'BRI',
            'account_holder' => 'John Doe',
            'account_number' => '123456789',
            'isActivated' => true
        ]);

        PaymentMethod::create([
            'type' => 'E-Wallet',
            'payment_name' => 'DANA',
            'account_holder' => 'Jane Doe',
            'account_number' => '081234567890',
            'isActivated' => true
        ]);
    }
}
