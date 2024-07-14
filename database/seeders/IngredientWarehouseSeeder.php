<?php

namespace Database\Seeders;

use App\Models\IngredientWarehouse;
use Illuminate\Database\Seeder;

class IngredientWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factories = IngredientWarehouse::factory(15)->make();
        foreach ($factories as $factory) {
            $alReadyexist = IngredientWarehouse::where("name", $factory->name)->count() > 0;
            if (!$alReadyexist) {
                $factory->save();
            }
        }
    }
}
