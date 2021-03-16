<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
}
