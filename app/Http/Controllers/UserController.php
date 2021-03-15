<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listItem()
    {
        return view('user.list_item');
    }

    public function storeProduct()
    {
        return view('user.store_product');
    }

    public function history()
    {
        return view('user.history');
    }

    public function info()
    {
        return view('user.info');
    }

    public function rechargeMoney()
    {
        return view('user.recharge_money');
    }
}
