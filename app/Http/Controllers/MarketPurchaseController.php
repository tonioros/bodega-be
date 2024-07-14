<?php

namespace App\Http\Controllers;

use App\Models\MarketPurchase;
use Illuminate\Http\Request;

class MarketPurchaseController extends Controller
{
    public function index(Request $request)
    {
        return MarketPurchase::orderBy('request_date', 'desc')->get();
    }
}
