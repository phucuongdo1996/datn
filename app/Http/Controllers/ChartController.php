<?php

namespace App\Http\Controllers;

use App\Repositories\MarketEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    private $marketEloquentRepository;

    public function __construct(
        MarketEloquentRepository $marketEloquentRepository
    ) {
        $this->marketEloquentRepository = $marketEloquentRepository;
    }

    public function getDataChartDetail(Request $request)
    {
        $data = $this->marketEloquentRepository->getDataChartProductDetail($request->product_base_id);
        $date = array_map(function ($value) {
            return date('d/m', strtotime($value));
        }, array_column($data, 'date'));
        $price = array_map(function ($value) {
            return (float)$value;
        }, array_column($data, 'avg_price'));
        return response()->json([
            'date' => $date,
            'price' => $price
        ]);
    }
}
