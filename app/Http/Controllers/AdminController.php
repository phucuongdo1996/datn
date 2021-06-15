<?php

namespace App\Http\Controllers;

use App\Http\Requests\SteamCodeRequest;
use App\Repositories\AdminRevenueEloquentRepository;
use App\Repositories\SteamCodeEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $adminRevenueEloquentRepository;
    private $steamCodeEloquentRepository;

    public function __construct(
        SteamCodeEloquentRepository $steamCodeEloquentRepository,
        AdminRevenueEloquentRepository $adminRevenueEloquentRepository
    ) {
        $this->steamCodeEloquentRepository = $steamCodeEloquentRepository;
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

    /**
     * Show màn hình [Quản lý Steam Code]
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addSteamCode(Request $request)
    {
        $params = $request->all();
        $data = $this->steamCodeEloquentRepository->getData($params);
        return view('admin.steam_code', compact('data', 'params'));
    }

    /**
     * Tạo mới thẻ [Quản lý Steam Code]
     *
     * @param SteamCodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSteamCode(SteamCodeRequest $request)
    {
        $data = $request->all();
        $data['status'] = STEAM_CODE_READY;
        if ($this->steamCodeEloquentRepository->create($data)) {
            Session::flash(STR_FLASH_SUCCESS, 'Thêm thẻ thành công !.');
            return response()->json([
                'status' => 201
            ]);
        }
        Session::flash(STR_FLASH_ERROR, 'Thêm thẻ thất bại !.');
        return response()->json([
            'status' => 400
        ]);

    }

    /**
     * Xóa thẻ [Quản lý Steam Code]
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteSteamCode($id)
    {
        if ($this->steamCodeEloquentRepository->deleteById($id)) {
            Session::flash(STR_FLASH_SUCCESS, 'Xóa thẻ thành công !.');
            return response()->json([
                'status' => 200
            ]);
        }
        Session::flash(STR_FLASH_ERROR, 'Xóa thẻ thất bại !.');
        return response()->json([
            'status' => 400
        ]);
    }
}
