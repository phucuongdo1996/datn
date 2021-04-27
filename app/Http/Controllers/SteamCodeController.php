<?php

namespace App\Http\Controllers;

use App\Repositories\SteamCodeEloquentRepository;

class SteamCodeController extends Controller
{
    private $steamCodeEloquentRepository;

    public function __construct(
        SteamCodeEloquentRepository $steamCodeEloquentRepository
    ) {
        $this->steamCodeEloquentRepository = $steamCodeEloquentRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->steamCodeEloquentRepository->getStatusSteamCode();
        return view('steam_code.index', compact('data'));
    }
}
