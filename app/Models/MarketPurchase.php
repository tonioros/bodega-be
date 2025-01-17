<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPurchase extends Model
{
    use HasFactory;

    protected $table = 'market_purchases';
    protected $fillable = [
        "request_date",
        "ingredient_id",
        "total_purchased",
    ];

    /**
     * Return Ingredient bought in Market Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredient()
    {
        return $this->belongsTo(IngredientWarehouse::class);
    }

}
