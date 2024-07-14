<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IngredientWarehouse>
 */
class IngredientWarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->getIngredientName(),
            "total_available" => $this->faker->numberBetween(1, 5),
        ];
    }

    private function getIngredientName()
    {
        return collect([
            "tomato",
            "lemon",
            "potato",
            "rice",
            "ketchup",
            "lettuce",
            "onion",
            "cheese",
            "meat",
            "chicken",
        ])->random();
    }
}
