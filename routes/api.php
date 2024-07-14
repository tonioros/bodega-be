<?php

use App\Http\Controllers\IngredientWarehouseController;
use App\Http\Controllers\MarketPurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get("/ingredients/{names}", [IngredientWarehouseController::class, 'index']);
Route::post("/ingredients-to-use", [IngredientWarehouseController::class, 'ingredientsToUse']);
Route::get("/market-purchase", [MarketPurchaseController::class, 'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
