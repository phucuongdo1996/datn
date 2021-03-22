<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SteamCodeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('steam_code.index');
    }
}
