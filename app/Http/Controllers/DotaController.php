<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DotaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail()
    {
        return view('dota.detail');
    }
}
