<?php

namespace App\Http\Controllers;

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
}
