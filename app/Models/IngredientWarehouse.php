<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientWarehouse extends Model
{
    use HasFactory;

    protected $table = "ingredient_warehouse";

    protected $fillable = [
        "name",
        "total_available"
    ];
}
