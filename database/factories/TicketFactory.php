<?php

namespace Database\Factories;

use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'visitor_name' => $this->faker->name(),
            'visit_date' => $this->faker->dateTimeThisYear,
            'status' => $this->faker->randomElement(['active', 'used', 'expired']),
        ];
    }
}
