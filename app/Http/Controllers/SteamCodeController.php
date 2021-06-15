<?php

namespace App\Http\Controllers;

use App\Repositories\SteamCodeEloquentRepository;
use Illuminate\Support\Facades\Session;

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
        $infoSteamCode = null;
        if (Session::has('steam_preview')) {
            $infoSteamCode = Session::pull('steam_preview');
        }
        $data = $this->steamCodeEloquentRepository->getStatusSteamCode();
        return view('steam_code.index', compact('data', 'infoSteamCode'));
    }
}
