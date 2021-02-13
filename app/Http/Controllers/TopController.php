<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\Contact\ContactEloquentRepository;
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
        return view('top');
    }

    /**
     * Show privacy site
     *
     * @return mixed
     */
    public function privacy()
    {
        return view('user.privacy');
    }

    /**
     * Show legal site
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function legal()
    {
        return view('user.legal');
    }

    /**
     * Show terms site
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('user.terms');
    }

    /**
     * Show Contact Screen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactCreate()
    {
        if (Auth::check()) {
            return view('backend.contact.contact_me');
        }
        return view('contact');
    }

    /**
     * Store contact
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactStore(ContactRequest $request)
    {
        if ((new ContactEloquentRepository())->create($request->all())) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('attributes.support.send_mail_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }
}
