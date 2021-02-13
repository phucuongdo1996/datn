<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Property\PropertyRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    protected $propertyRepository;

    /**
     * ReportController constructor.
     *
     * @param PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $numericalOrder = 0;
        $userCurrent = Auth::user();
        $request = request()->all();
        if (!isset($request['status'])) {
            $request['status'] = !isset($request['check_all']) ? [FLAG_ONE, FLAG_TWO, FLAG_THREE, FLAG_FOUR] : [];
        }
        $perPage = isset($request['option_paginate']) && in_array($request['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
            ? $request['option_paginate'] : LIMIT_RECORD_DEFAULT;
        if (isset($request['option_paginate']) && isset($request['page'])) {
            $numericalOrder = ($request['page'] - 1) * $request['option_paginate'];
        }

        return view('backend.report.index')->with([
            'property' =>  $this->propertyRepository->getListReports($userCurrent->id, $perPage, $request),
            'proprietors' => $this->propertyRepository->getListProprietorsByUserId($userCurrent->id),
            'optionPaginate' => $perPage,
            'totalPage' => ceil($this->propertyRepository->countDataForUser($userCurrent->id) / $perPage),
            'numericalOrder' => $numericalOrder,
            'params' => $request
        ]);
    }
}
