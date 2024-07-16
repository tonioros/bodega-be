<?php

namespace App\Http\Controllers;

use App\Models\IngredientWarehouse;
use App\Models\MarketPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IngredientWarehouseController extends Controller
{

    /**
     * Get available Ingredients
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $name = $request->get("name");
        $orderBy = $request->get("orderBy");
        $limit = $request->get("limit");
        $ingredients = IngredientWarehouse::query();
        if ($name) {
            $ingredients->where('name', $name);
        }
        if ($limit) {
            $ingredients->limit($limit);
        }
        if ($orderBy) {
            $ingredients->orderBy('id', $orderBy);
        }
        return $ingredients->get();
    }

    /**
     * Display a listing of ingredients and total available.
     * if not have enough available, consume marketplace API
     * and refresh the warehouse
     *
     * @param Request $request
     * @param string $names
     * @return \Illuminate\Support\Collection
     */
    public function ingredientsByName(Request $request, string $names)
    {
        $ingredientListReq = collect(explode(",", $names));
        $ingredientsToReturn = collect();

        $ingredientListReq->each(function ($ingredientItem) use (&$ingredientsToReturn) {
            $ingredientReq = explode(":", $ingredientItem);
            $ingredient = IngredientWarehouse::where('name', $ingredientReq[0])->first();
            if (!!$ingredient && $ingredient->total_available < intval($ingredientReq[1])) {
                $this->buyAIngredient($ingredient, $ingredientReq[1]);
                $ingredient = IngredientWarehouse::where('name', $ingredientReq[0])->first();
            }
            $ingredientsToReturn->push($ingredient);
        });
        return $ingredientsToReturn;
    }

    /**
     * Request to marketplace API an ingredient and get the quantitySold
     * to update the total available for the ingredient selected
     *
     * @param IngredientWarehouse $ingredientWarehouse
     * @param int $quantity
     * @return void
     */
    private function buyAIngredient(IngredientWarehouse $ingredientWarehouse, int $quantity)
    {
        $marketPlaceURL = env('MARKETPLACE_URL');
        $response = Http::get($marketPlaceURL . $ingredientWarehouse->name)
            ->json();
        MarketPurchase::create([
            "request_date" => Carbon::now()->toDateTimeString(),
            "ingredient_id" => $ingredientWarehouse->id,
            "total_purchased" => $response['quantitySold'],
        ]);

        $ingredientWarehouse->total_available += $response['quantitySold'];
        $ingredientWarehouse->save();
        if ($quantity > $ingredientWarehouse->total_available) {
            $this->buyAIngredient($ingredientWarehouse, $quantity);
        }
    }

    /**
     * Update total available for the ingredients selected
     *
     * @param string $names
     * @return array
     */
    public function ingredientsToUse(Request $request)
    {
        $ingredientListReq = collect($request->all());
        $returnList = [];
        foreach ($ingredientListReq as $ingredientName => $totalToUse) {
            $ingredient = IngredientWarehouse::where('name', $ingredientName)->first();
            $ingredient->total_available -= intval($totalToUse);
            $ingredient->save();
            $returnList[$ingredientName] = $ingredient->total_available;
        }
        return $returnList;
    }
}
