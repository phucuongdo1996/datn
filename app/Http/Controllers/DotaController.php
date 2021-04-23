<?php

namespace App\Http\Controllers;

use App\Repositories\MarketEloquentRepository;
use App\Repositories\ProductEloquentRepository;

class DotaController extends Controller
{
    private $productEloquentRepository;
    private $marketEloquentRepository;

    /**
     * DotaController constructor.
     *
     * @param ProductEloquentRepository $productEloquentRepository
     * @param MarketEloquentRepository $marketEloquentRepository
     */
    public function __construct(
        ProductEloquentRepository $productEloquentRepository,
        MarketEloquentRepository $marketEloquentRepository
    ) {
        $this->productEloquentRepository = $productEloquentRepository;
        $this->marketEloquentRepository = $marketEloquentRepository;
    }

    /**
     * Show màn hình [Chi tiết sản phẩm]
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $market = $this->marketEloquentRepository->find($id);
        abort_if(empty($market) || $market->status != TRADE_SELLING, 404);
        $sameProducts = $this->marketEloquentRepository->getSameProducts($market['product']['product_base_id'], $market['product']['id']);
        return view('dota.detail', compact('market', 'sameProducts'));
    }
}
