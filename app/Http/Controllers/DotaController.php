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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $productId = $this->marketEloquentRepository->getProductDetailSelling($id);
        abort_if(!$productId, 404);
        $product = $this->productEloquentRepository->find($productId);
        abort_if(!$product, 404);
        return view('dota.detail', compact('product'));
    }
}
