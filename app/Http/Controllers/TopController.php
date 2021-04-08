<?php

namespace App\Http\Controllers;

use App\Repositories\HeroEloquentRepository;
use App\Repositories\ProductEloquentRepository;
use App\Repositories\ProductNewEloquentRepository;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * @var \App\Repositories\Hero\HeroEloquentRepository
     */
    protected $heroRepository;
    protected $productEloquentRepository;
    protected $productNewEloquentRepository;

    public function __construct(
        ProductEloquentRepository $productEloquentRepository,
        HeroEloquentRepository $heroRepository,
        ProductNewEloquentRepository $productNewEloquentRepository
    ) {
        $this->heroRepository = $heroRepository;
        $this->productEloquentRepository = $productEloquentRepository;
        $this->productNewEloquentRepository = $productNewEloquentRepository;
    }

    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        $newItems = $this->productEloquentRepository->getNewItems();
        $newSets = $this->productEloquentRepository->getNewSets();
        $productNews = $this->productEloquentRepository->getProductNew();
        return view('dota.index', compact('newItems', 'newSets', 'productNews'));
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
