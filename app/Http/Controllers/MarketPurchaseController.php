<?php

namespace App\Http\Controllers;

use App\Models\MarketPurchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MarketPurchaseController extends Controller
{
    /**
     * Get History of calls to MarketPlace API
     * showing request date and time, ingredient id and total returned by API
     *
     * @param Request $request
     * @return Builder[]|Collection
     */
    public function index(Request $request)
    {
        $request_date = $request->get("request_date");
        $limit = $request->get("limit");
        $orderBy = $request->get("orderBy");
        $marketPurchase = MarketPurchase::query();

        if ($request_date) {
            $marketPurchase->whereDate('request_date', $request_date);
        }
        if ($limit) {
            $marketPurchase->limit($limit);
        }
        if ($orderBy) {
            $marketPurchase->orderBy('id', $orderBy);
        }
        return $marketPurchase->get();
    }
}
