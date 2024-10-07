<?php

namespace Database\Factories;

use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourPackage>
 */
class TourPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'price' => rand(100000, 10000000),
            'description' => fake()->paragraph(),
            'is_visible' => fake()->boolean(),
            'image_icon' => fake()->imageUrl(640, 480, 'travel'),
            'discount' => rand(0, 10),
            'tour_package_code' => (new TourPackage())->generateTourPackageCode(),
        ];
    }
}
