<?php

namespace App\Http\Controllers;

use App\Api\BaoKim\BaoKimApi;
use App\Http\Requests\GetUrlBaoKimRequest;
use App\Http\Requests\SellItemRequest;
use App\Repositories\CategoryEloquentRepository;
use App\Repositories\HeroEloquentRepository;
use App\Repositories\MarketEloquentRepository;
use App\Repositories\ProductEloquentRepository;
use App\Repositories\UserEloquentRepository;
use App\Repositories\UserHistoryEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $categoryEloquentRepository;
    private $heroEloquentRepository;
    private $productEloquentRepository;
    private $userEloquentRepository;
    private $marketEloquentRepository;
    private $userHistoryEloquentRepository;

    /**
     * UserController constructor.
     *
     * @param UserEloquentRepository $userEloquentRepository
     * @param ProductEloquentRepository $productEloquentRepository
     * @param CategoryEloquentRepository $categoryEloquentRepository
     * @param HeroEloquentRepository $heroEloquentRepository
     * @param MarketEloquentRepository $marketEloquentRepository
     */
    public function __construct(
        UserEloquentRepository $userEloquentRepository,
        ProductEloquentRepository $productEloquentRepository,
        CategoryEloquentRepository $categoryEloquentRepository,
        HeroEloquentRepository $heroEloquentRepository,
        MarketEloquentRepository $marketEloquentRepository,
        UserHistoryEloquentRepository $userHistoryEloquentRepository
    ) {
        $this->categoryEloquentRepository = $categoryEloquentRepository;
        $this->heroEloquentRepository = $heroEloquentRepository;
        $this->productEloquentRepository = $productEloquentRepository;
        $this->userEloquentRepository = $userEloquentRepository;
        $this->marketEloquentRepository = $marketEloquentRepository;
        $this->userHistoryEloquentRepository = $userHistoryEloquentRepository;
    }

    /**
     * Show màn hình [Kho sản phẩm]
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listItem(Request $request)
    {
        $params = $request->all();
        $listCategory = $this->categoryEloquentRepository->getAll()->toArray();
        $listHero = $this->heroEloquentRepository->getListHero();
        $products = $this->userEloquentRepository->getProductsByUser($params);
        return view('user.list_item', compact('products', 'listCategory', 'listHero', 'params'));
    }

    /**
     * Show màn hình [Sản phẩm đang bán]
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeProduct(Request $request)
    {
        $params = $request->all();
        $listCategory = $this->categoryEloquentRepository->getAll()->toArray();
        $listHero = $this->heroEloquentRepository->getListHero();
        $products = $this->userEloquentRepository->getProductsSellingByUser($params);
        return view('user.store_product', compact('listHero', 'listCategory', 'products', 'params'));
    }

    /**
     * Show màn hình [Lịch sử giao dịch]
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history()
    {
        $userHistory = Auth::user()->userHistory()->orderBy('id', 'DESC')->get();
        return view('user.history', compact('userHistory'));
    }

    /**
     * Show màn hình [Thông tin tài khoản]
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info()
    {
        return view('user.info');
    }

    /**
     * Show màn hình [Nạp tài khoản]
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rechargeMoney()
    {
        return view('user.recharge_money');
    }

    /**
     * Lấy Url chuyển trang thanh toán qua Bao Kim
     *
     * @param GetUrlBaoKimRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUrlBaoKim(GetUrlBaoKimRequest $request)
    {
        return response()->json([
            'url_redirect' => BaoKimApi::getUrlRedirect($request->all())
        ], 200);
    }

    /**
     * Xử lý Request [Rao bán sản phẩm]
     *
     * @param SellItemRequest $request
     */
    public function sellItem(SellItemRequest $request)
    {
        if ($this->marketEloquentRepository->sellItem($request->all())) {
            Session::flash(STR_FLASH_SUCCESS, 'Rao bán sản phẩm thành công!');
        } else {
            Session::flash(STR_FLASH_ERROR, 'Có lỗi trong quá trình xử lý, Rao bán sản phẩm thất bại!');
        }
    }

    /**
     * Xử lý Request [Validation form rao bán sản phẩm]
     *
     * @param SellItemRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateSellItem(SellItemRequest $request)
    {
        return response()->json(['check' => true]);
    }

    /**
     * Xử lý Request [Thu hồi sản phẩm]
     *
     * @param Request $request
     */
    public function withdrawItem(Request $request)
    {
        if ($this->marketEloquentRepository->withdrawItem($request->all())) {
            Session::flash(STR_FLASH_SUCCESS, 'Thu hồi sản phẩm thành công!');
        } else {
            Session::flash(STR_FLASH_ERROR, 'Có lỗi trong quá trình xử lý, Thu hồi sản phẩm thất bại!');
        }
    }

    /**
     * Xử lý Request [Mua sản phẩm]
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buyItem(Request $request)
    {
        if ($this->marketEloquentRepository->buyItem($request->all())) {
            Session::flash(STR_FLASH_SUCCESS, 'Mua sản phẩm thành công!');
            return response()->json([
                'save' => true
            ]);
        } else {
            Session::flash(STR_FLASH_ERROR, 'Có lỗi trong quá trình xử lý, Mua sản phẩm thất bại!');
            return response()->json([
                'save' => false
            ]);
        }
    }
}
