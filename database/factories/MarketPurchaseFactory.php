<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MarketPurchase>
 */
class MarketPurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "request_date" => $this->faker->dateTimeBetween("-3 days"),
            "ingredient_id" => $this->faker->numberBetween(1, 10),
            "total_purchased" => $this->faker->numberBetween(1, 5),
        ];
    }
}
