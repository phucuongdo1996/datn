<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryEloquentRepository;
use App\Repositories\HeroEloquentRepository;
use App\Repositories\MarketEloquentRepository;
use App\Repositories\ProductEloquentRepository;
use App\Repositories\ProductNewEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    protected $heroRepository;
    protected $productEloquentRepository;
    protected $productNewEloquentRepository;
    protected $categoryEloquentRepository;
    protected $marketEloquentRepository;

    public function __construct(
        ProductEloquentRepository $productEloquentRepository,
        HeroEloquentRepository $heroRepository,
        ProductNewEloquentRepository $productNewEloquentRepository,
        CategoryEloquentRepository $categoryEloquentRepository,
        MarketEloquentRepository $marketEloquentRepository
    ) {
        $this->heroRepository = $heroRepository;
        $this->productEloquentRepository = $productEloquentRepository;
        $this->productNewEloquentRepository = $productNewEloquentRepository;
        $this->categoryEloquentRepository = $categoryEloquentRepository;
        $this->marketEloquentRepository = $marketEloquentRepository;
    }

    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        $newItems = $this->marketEloquentRepository->getNewItems();
        $newSets = $this->marketEloquentRepository->getNewSets();
        $productNews = $this->marketEloquentRepository->getProductNew();
        $productBestseller = $this->marketEloquentRepository->getProductBestseller();
        $productRemarkable = $this->marketEloquentRepository->getProductRemarkable();
        return view('dota.index', compact('newItems', 'newSets', 'productNews', 'productBestseller', 'productRemarkable'));
    }

    public function dotaListItem(Request $request)
    {
        $params = $request->all();
        $listCategory = $this->categoryEloquentRepository->getAll()->toArray();
        $listHero = $this->heroRepository->getListHero();
        $listItems = $this->productEloquentRepository->getListItems($params);
        dd($listItems);
        return view('dota.list_item', compact('listItems', 'listHero', 'listCategory', 'params'));
    }

    public function dotaListSet(Request $request)
    {
        $params = $request->all();
        $listHero = $this->heroRepository->getListHero();
        $listSet = $this->productEloquentRepository->getListSet($params);
        return view('dota.list_set', compact('listHero', 'listSet', 'params'));
    }
}
