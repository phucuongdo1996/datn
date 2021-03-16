<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
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
        return view('dota.list_set');
    }
}
