<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\Tax\TaxRepositoryInterface;
use App\Repositories\TaxProperty\TaxPropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaxRequest;
use Illuminate\Support\Facades\Session;

class TaxController extends Controller
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Tax\TaxEloquentRepository;
     */
    private $taxRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\Property\PropertyEloquentRepository;
     */
    private $propertyRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\TaxProperty\TaxPropertyEloquentRepository;
     */
    private $taxPropertyRepository;

    /**
     * TaxController constructor.
     *
     * @param PropertyRepositoryInterface $propertyRepository
     * @param TaxRepositoryInterface $taxRepository
     * @param TaxPropertyRepositoryInterface $taxPropertyRepository
     */

    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        TaxRepositoryInterface $taxRepository,
        TaxPropertyRepositoryInterface $taxPropertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->taxRepository = $taxRepository;
        $this->taxPropertyRepository = $taxPropertyRepository;
    }

    /**
     * function index show list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->except('page');
        $params = isset($params['option_paginate']) && in_array($params['option_paginate'], array_keys(LIST_OPTION_PAGINATE)) ? $params['option_paginate'] : LIMIT_RECORD_DEFAULT;
        $taxes = $this->taxRepository->getByMonthAndYear($params);
        $countTaxes = $this->taxRepository->countTaxes();

        return view('backend.property.confirm_final.list', [
            'taxes' => $taxes,
            'params' => $params,
            'optionPaginate' => $params,
            'totalPage' => ceil($countTaxes / $params),
            'style' => ($taxes->count() == 0 && Auth::user()->role == INVESTOR) ? CLASS_NO_DATA_FIRST : CLASS_NO_DATA_SECOND]);
    }

    /**
     * function create
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $listProperty = $this->propertyRepository->getDataCreateTax();
        return view('backend.property.confirm_final.add', ['listProperty' => $listProperty, 'perPage' => isset($request->option_paginate) && in_array($request->option_paginate, array_keys(LIST_OPTION_PAGINATE))
            ? $request->option_paginate : LIMIT_RECORD_DEFAULT]);
    }

    /**
     * function store
     *
     * @param TaxRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaxRequest $request)
    {
        $result = $this->taxRepository->create($request->all());
        if (empty($result)) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['result' => false]);
        } else {
            $arrayProperty = $request->property_id;
            if (!empty($arrayProperty)) {
                $result->property()->attach($arrayProperty);
            }
            $optionPage = isset($request->option_paginate) && in_array($request->option_paginate, array_keys(LIST_OPTION_PAGINATE))
                ? $request->option_paginate : LIMIT_RECORD_DEFAULT;
            $redirect = 'document/confirm-final/list?option_paginate=' . $optionPage . '&page=' . $this->taxRepository->getPageNumber(Auth::user()->id, $result->id, $optionPage);
            return response()->json(['result' => true, 'redirect' => $redirect]);
        }
    }

    /**
     * function edit
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $data = $this->taxRepository->getDataWithProperty($id, $userId);
        abort_if(!$data, 404);

        $listProperty = $this->propertyRepository->getDataCreateTax($data->toArray());
        return view('backend.property.confirm_final.edit', [
            'data' => $data,
            'dataProperty' => $this->propertyRepository->getDataExample($data['property']->pluck('id')->toArray(), $data->year),
            'listProperty' => $listProperty,
            'perPage' => isset($request->option_paginate) && in_array($request->option_paginate, array_keys(LIST_OPTION_PAGINATE))
            ? $request->option_paginate : LIMIT_RECORD_DEFAULT,
            'propertyOwner' => $listProperty->firstWhere('proprietor', '!=', null),
            'propertyChecked' => $listProperty,
        ]);
    }

    /**
     * public function update data
     *
     * @param TaxRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaxRequest $request, $id)
    {
        $data = $this->taxRepository->find($id);

        if (date_format($data->updated_at, 'Y/m/d H:i:s') > $request->time_open_page) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['result' => false]);
        }

        $result = $this->taxRepository->update($id, $request->all());
        if (empty($result)) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['result' => false]);
        } else {
            $result->property()->detach();
            $arrayProperty = $request->property_id;
            if (!empty($arrayProperty)) {
                $result->property()->attach($arrayProperty);
            }
            $optionPage = isset($request->option_paginate) && in_array($request->option_paginate, array_keys(LIST_OPTION_PAGINATE))
                ? $request->option_paginate : LIMIT_RECORD_DEFAULT;
            $redirect = 'document/confirm-final/list?option_paginate=' . $optionPage . '&page=' . $this->taxRepository->getPageNumber(Auth::user()->id, $result->id, $optionPage);
            return response()->json(['result' => true, 'redirect' => $redirect]);
        }
    }

    /**
     * function delete tax
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $request = $request->all();
        if ($this->taxRepository->deleteRecordById($id)) {
            return redirect(route(USER_TAX_INDEX, ['option_paginate' => $request['option_paginate'], 'page' => $this->taxRepository->getPageNumberWhenDelete($request)]));
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return redirect(route(USER_TAX_INDEX));
    }

    /**
     * function get data preview
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataPreview(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['data' => $this->taxRepository->getDataPreview($request->all())]);
        }
    }

    /**
     * Get data proprietor
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataProprietor(Request $request)
    {
        $userProxy = Auth::user()->isMainUser() ? Auth::user() : Auth::user()->getParentUser();
        if ($request->ajax()) {
            return response()->json(['data' => $this->propertyRepository->getDataProprietor($userProxy->id, $request->year, $request->month)]);
        }
    }
}
