<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * Show top site
     *
     * @return mixed
     */
    public function index()
    {
        return view('dota.top');
    }

    public function dotaHome()
    {
        return view('dota.top');
    }

    public function dotaListItem()
    {
        return view('dota.list_item');
    }

    public function dotaListSet()
    {
        return view('dota.list_set');
    }
}
