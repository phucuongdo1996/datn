<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUserController extends Controller
{
    /**
     * @var \App\Repositories\Contact\ContactEloquentRepository
     */
    private $contactRepository;

    /**
     * ContactUserController constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        return view('backend.admin.contact_user')->with([
            'dataContact' => $this->contactRepository->getDataContactAdmin($params, FLAG_FIFTY),
            'params' => $params
        ]);
    }

    /**
     *  Update a record.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if ($this->contactRepository->updateContact($request->all())) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.manage_support_success'));
            return response()->json(['save' => true]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => false]);
    }
}
