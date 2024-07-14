<?php

namespace Database\Seeders;

use App\Models\IngredientWarehouse;
use App\Models\MarketPurchase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MarketPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketPurchase::factory(15)
            ->state(new Sequence(
                fn(Sequence $sequence) => ['ingredient_id' => IngredientWarehouse::all()->random()],
            ))->create();
    }
}
