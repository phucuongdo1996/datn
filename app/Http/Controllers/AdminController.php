<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRevenueEloquentRepository;

class AdminController extends Controller
{
    private $adminRevenueEloquentRepository;

    public function __construct(
        AdminRevenueEloquentRepository $adminRevenueEloquentRepository
    ) {
        $this->adminRevenueEloquentRepository = $adminRevenueEloquentRepository;
    }

    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.index');
    }

    public function getDataRevenue()
    {
        $data = $this->adminRevenueEloquentRepository->getDataRevenue();
        $indexMonth = date("m-Y", time());
        $lastMonth = date("m-Y", strtotime("-1 month"));
        $revenueLastMonth = $data->filter(function ($value, $key) use ($lastMonth) {
            return $key == $lastMonth;
        });
        $revenueIndexMonth = $data->filter(function ($value, $key) use ($indexMonth) {
            return $key == $indexMonth;
        });
        $dataReturn = [
            'categories' => $data->pluck('month_year')->toArray(),
            'revenue_agency' => $data->pluck('revenue_agency')->toArray(),
            'revenue_steam_code' => $data->pluck('revenue_steam_code')->toArray(),
            'revenue_recharge_money' => $data->pluck('revenue_recharge_money')->toArray(),
            'revenue_last_month' => $revenueLastMonth->toArray(),
            'revenue_index_month' => $revenueIndexMonth->toArray(),
        ];
        return response()->json(['data' => $dataReturn]);
    }

    public function editProduct()
    {
        return view('admin.edit_product');
    }

    public function addSteamCode()
    {
        return view('admin.steam_code');
    }
}
