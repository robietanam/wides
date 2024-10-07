<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'noTelp' => $this->faker->phoneNumber,
            'payment_method' => $this->faker->randomElement(['Bayar Ditempat', 'DANA', 'E-Wallet']),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['pending', 'processing', 'invoice', 'completed', 'rejected', 'refunded']),
            'transaction_date' => $this->faker->dateTimeThisYear,
            'visit_date' => $this->faker->dateTimeThisYear,
            'transaction_code' => (new Transaction())->generateTransactionCode(true),
        ];
    }
}
