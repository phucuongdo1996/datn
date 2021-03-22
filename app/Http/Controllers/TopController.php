<?php

namespace App\Http\Controllers;

use App\Repositories\Hero\HeroRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * @var \App\Repositories\Hero\HeroEloquentRepository
     */
    protected $heroRepository;

    public function __construct(
        HeroRepositoryInterface $heroRepository
    ) {
        $this->heroRepository = $heroRepository;
    }

    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        return view('dota.index');
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
