<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Support\SupportEloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupportUserController extends Controller
{
    /**
     * @var SupportEloquentRepository
     */
    private $supportRegisterRepository;

    /**
     * SupportEloquentRepository constructor.
     * @param SupportEloquentRepository $supportRegisterRepository
     */
    public function __construct(SupportEloquentRepository $supportRegisterRepository)
    {
        $this->supportRegisterRepository = $supportRegisterRepository;
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
        return view('backend.admin.support_user')->with([
            'dataSupports' => $this->supportRegisterRepository->getDataForSupport($params, FLAG_FIFTY),
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
        if ($this->supportRegisterRepository->updateSupport($request->all())) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.manage_support_success'));
            return response()->json(['save' => true]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => false]);
    }
}
