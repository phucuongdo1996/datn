<?php

namespace App\Http\Controllers;

use App\Repositories\Hero\HeroRepositoryInterface;
use App\Repositories\Product\ProductEloquentRepository;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * @var \App\Repositories\Hero\HeroEloquentRepository
     */
    protected $heroRepository;
    protected $productEloquentRepository;

    public function __construct(
        ProductEloquentRepository $productEloquentRepository,
        HeroRepositoryInterface $heroRepository
    ) {
        $this->heroRepository = $heroRepository;
        $this->productEloquentRepository = $productEloquentRepository;
    }

    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        $listItemDota = $this->productEloquentRepository->getNewItems();
        $listSetDota = $this->productEloquentRepository->getNewItems();
        return view('dota.index', compact('listItemDota', 'listSetDota'));
    }

    public function dotaHome()
    {
        return view('dota.index');
    }

    public function dotaListItem()
    {
        return view('dota.list_item');
    }

    public function dotaListSet()
    {
        $listHero = $this->heroRepository->getListHero();
        return view('dota.list_set', compact('listHero'));
    }
}
