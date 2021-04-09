<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryEloquentRepository;
use App\Repositories\HeroEloquentRepository;
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

    public function __construct(
        ProductEloquentRepository $productEloquentRepository,
        HeroEloquentRepository $heroRepository,
        ProductNewEloquentRepository $productNewEloquentRepository,
        CategoryEloquentRepository $categoryEloquentRepository
    ) {
        $this->heroRepository = $heroRepository;
        $this->productEloquentRepository = $productEloquentRepository;
        $this->productNewEloquentRepository = $productNewEloquentRepository;
        $this->categoryEloquentRepository = $categoryEloquentRepository;
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
        $productBestseller = $this->productEloquentRepository->getProductBestseller();
        $productRemarkable = $this->productEloquentRepository->getProductRemarkable();
        return view('dota.index', compact('newItems', 'newSets', 'productNews', 'productBestseller', 'productRemarkable'));
    }

    public function dotaListItem(Request $request)
    {
        $params = $request->all();
        $listCategory = $this->categoryEloquentRepository->getAll()->toArray();
        $listHero = $this->heroRepository->getListHero();
        $listItems = $this->productEloquentRepository->getListItems($params);
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
