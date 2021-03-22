<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show dota site
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.index');
    }

    public function editProduct()
    {
        return view('admin.edit_product');
    }

    public function addSteamCode()
    {
        return view('admin.steam_code');
    }
}
