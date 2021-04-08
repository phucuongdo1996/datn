<?php

namespace App\Http\Controllers;

use App\Repositories\ProductEloquentRepository;
use Illuminate\Support\Facades\Auth;

class DotaController extends Controller
{
    private $productEloquentRepository;

    public function __construct(
        ProductEloquentRepository $productEloquentRepository
    ) {
        $this->productEloquentRepository = $productEloquentRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $product = $this->productEloquentRepository->find($id);
        abort_if(!$product, 404);
        return view('dota.detail', compact('product'));
    }
}
