<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryEloquentRepository;
use App\Repositories\HeroEloquentRepository;
use App\Repositories\ProductEloquentRepository;
use App\Repositories\UserEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $categoryEloquentRepository;
    private $heroEloquentRepository;
    private $productEloquentRepository;
    private $userEloquentRepository;

    public function __construct(
        UserEloquentRepository $userEloquentRepository,
        ProductEloquentRepository $productEloquentRepository,
        CategoryEloquentRepository $categoryEloquentRepository,
        HeroEloquentRepository $heroEloquentRepository
    ) {
        $this->categoryEloquentRepository = $categoryEloquentRepository;
        $this->heroEloquentRepository = $heroEloquentRepository;
        $this->productEloquentRepository = $productEloquentRepository;
        $this->userEloquentRepository = $userEloquentRepository;
    }

    /**
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

    public function storeProduct(Request $request)
    {
        $params = $request->all();
        $listCategory = $this->categoryEloquentRepository->getAll()->toArray();
        $listHero = $this->heroEloquentRepository->getListHero();
        $products = $this->userEloquentRepository->getProductsSellingByUser($params);
        return view('user.store_product', compact('listHero', 'listCategory', 'products', 'params'));
    }

    public function history()
    {
        return view('user.history');
    }

    public function info()
    {
        return view('user.info');
    }

    public function rechargeMoney()
    {
        return view('user.recharge_money');
    }
}
