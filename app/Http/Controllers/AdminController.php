<?php

namespace App\Http\Controllers;

use App\Http\Requests\SteamCodeRequest;
use App\Repositories\AdminRevenueEloquentRepository;
use App\Repositories\ProductBaseEloquentRepository;
use App\Repositories\ProductBestsellerEloquentRepository;
use App\Repositories\ProductNewEloquentRepository;
use App\Repositories\ProductRemarkableEloquentRepository;
use App\Repositories\SteamCodeEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $adminRevenueEloquentRepository;
    private $steamCodeEloquentRepository;
    private $productNewEloquentRepository;
    private $productBestsellerEloquentRepository;
    private $productRemarkableEloquentRepository;
    private $productBaseEloquentRepository;

    /**
     * AdminController constructor.
     *
     * @param SteamCodeEloquentRepository $steamCodeEloquentRepository
     * @param ProductNewEloquentRepository $productNewEloquentRepository
     * @param ProductBaseEloquentRepository $productBaseEloquentRepository
     * @param ProductBestsellerEloquentRepository $productBestsellerEloquentRepository
     * @param ProductRemarkableEloquentRepository $productRemarkableEloquentRepository
     * @param AdminRevenueEloquentRepository $adminRevenueEloquentRepository
     */
    public function __construct(
        SteamCodeEloquentRepository $steamCodeEloquentRepository,
        ProductNewEloquentRepository $productNewEloquentRepository,
        ProductBaseEloquentRepository $productBaseEloquentRepository,
        ProductBestsellerEloquentRepository $productBestsellerEloquentRepository,
        ProductRemarkableEloquentRepository $productRemarkableEloquentRepository,
        AdminRevenueEloquentRepository $adminRevenueEloquentRepository
    ) {
        $this->steamCodeEloquentRepository = $steamCodeEloquentRepository;
        $this->adminRevenueEloquentRepository = $adminRevenueEloquentRepository;
        $this->productNewEloquentRepository = $productNewEloquentRepository;
        $this->productBestsellerEloquentRepository = $productBestsellerEloquentRepository;
        $this->productRemarkableEloquentRepository = $productRemarkableEloquentRepository;
        $this->productBaseEloquentRepository = $productBaseEloquentRepository;
    }

    /**
     * Show màn hình [Thống kê doanh số]
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Lấy thông tin doanh số [Thống kê doanh số]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataRevenue()
    {
        $data = $this->adminRevenueEloquentRepository->getDataRevenue();
        $indexMonth = date("m-Y", time());
        $lastMonth = date("m-Y", strtotime("-1 month"));
        $revenueLastMonth = $data->filter(function ($value, $key) use ($lastMonth) {
            return $value->month_year == $lastMonth;
        })->first();
        $revenueIndexMonth = $data->filter(function ($value, $key) use ($indexMonth) {
            return $value->month_year == $indexMonth;
        })->first();
        $dataReturn = [
            'categories' => $data->pluck('month_year')->toArray(),
            'revenue_agency' => $data->pluck('revenue_agency')->toArray(),
            'revenue_steam_code' => $data->pluck('revenue_steam_code')->toArray(),
            'revenue_recharge_money' => $data->pluck('revenue_recharge_money')->toArray(),
            'revenue_last_month' => $revenueLastMonth,
            'revenue_index_month' => $revenueIndexMonth,
        ];
        return response()->json(['data' => $dataReturn]);
    }

    /**
     * Show màn hình [Quản lý sản phẩm]
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct()
    {
        $productNew = $this->productNewEloquentRepository->orderBy('product_base_id', 'DESC')->get();
        $productBestSeller = $this->productBestsellerEloquentRepository->orderBy('product_base_id', 'DESC')->get();
        $productRemarkable = $this->productRemarkableEloquentRepository->orderBy('product_base_id', 'DESC')->get();
        $productBase = $this->productBaseEloquentRepository->orderBy('name')->get()->pluck('name', 'id')->toArray();
        return view('admin.edit_product', compact('productNew', 'productBestSeller', 'productRemarkable', 'productBase'));
    }

    /**
     * Thêm sản phẩm mới cập nhật.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProductNew(Request $request)
    {
        if ( $this->productNewEloquentRepository->addRecord($request->product_id)) {
            Session::flash(STR_FLASH_SUCCESS, 'Thêm thành công !.');
        } else {
            Session::flash(STR_FLASH_ERROR, 'Thêm thất bại !.');
        }
        return redirect()->back();
    }

    /**
     * Thêm sản phẩm bán chạy nhất.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProductBestSeller(Request $request)
    {
        if ( $this->productBestsellerEloquentRepository->addRecord($request->product_id)) {
            Session::flash(STR_FLASH_SUCCESS, 'Thêm thành công !.');
        } else {
            Session::flash(STR_FLASH_ERROR, 'Thêm thất bại !.');
        }
        return redirect()->back();
    }

    /**
     * Thêm sản phẩm đáng chú ý.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProductRemarkable(Request $request)
    {
        if ( $this->productRemarkableEloquentRepository->addRecord($request->product_id)) {
            Session::flash(STR_FLASH_SUCCESS, 'Thêm thành công !.');
        } else {
            Session::flash(STR_FLASH_ERROR, 'Thêm thất bại !.');
        }
        return redirect()->back();
    }

    /**
     * Show màn hình [Quản lý Steam Code]
     *
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
