<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPlanRequest;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\BusinessPlan\BusinessPlanRepositoryInterface;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BusinessPlanController extends Controller
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Property\PropertyEloquentRepository;
     */
    private $propertyRepository;

    /**
     * Variable user repository
     *
     * @var \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * Variable profile repository
     *
     * @var \App\Repositories\Profile\ProfileEloquentRepository;
     */
    private $profileRepository;

    /**
     * Variable business plan repository
     *
     * @var \App\Repositories\BusinessPlan\BusinessPlanEloquentRepository;
     */
    private $businessPlanRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * @var AnnualPerformanceRepositoryInterface
     */
    private $annualPerformanceRepository;

    /**
     * BusinessPlanController constructor.
     * @param PropertyRepositoryInterface $propertyRepository
     * @param UserRepositoryInterface $userRepository
     * @param ProfileRepositoryInterface $profileRepository
     * @param BusinessPlanRepositoryInterface $businessPlanRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     * @param AnnualPerformanceRepositoryInterface $annualPerformanceRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        UserRepositoryInterface $userRepository,
        ProfileRepositoryInterface $profileRepository,
        BusinessPlanRepositoryInterface $businessPlanRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository,
        AnnualPerformanceRepositoryInterface $annualPerformanceRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->businessPlanRepository = $businessPlanRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
        $this->annualPerformanceRepository = $annualPerformanceRepository;
    }

    /**
     * Redirect create business plan
     *
     * @param Request $request
     * @param $propertyId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, $propertyId)
    {
        $params = $request->all();
        abort_if($this->businessPlanRepository->checkDataExistsByPropertyId($propertyId), 404);
        $listAnnualPerformance = $this->annualPerformanceRepository->getListYearAnnualPerformance($propertyId);
        $annualPerformance = isset($listAnnualPerformance[$params['year']]) ? $listAnnualPerformance[$params['year']] : [];
        return view('backend.report.business_plan.add')->with([
            'property' => $this->propertyRepository->getObjectPropertyById($propertyId),
            'profile' => $this->profileRepository->findByAttribute('user_id', Auth::user()['id']),
            'optionUrl' => handlingParamUrl($params),
            'listAnnualPerformance' => $listAnnualPerformance,
            'annualPerformance' => $annualPerformance
        ]);
    }

    /**
     * Save data business plan
     *
     * @param BusinessPlanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BusinessPlanRequest $request)
    {
        $params = $request->all();
        $result = $this->businessPlanRepository->saveData($params);
        if ($result == false) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['save' => false]);
        } else {
            $pageIndex = displayNumberPage($this->propertyRepository->countRecordToPropertyId(
                targetUserId(),
                $params['property_id']
            ), (int)$params['option_paginate']);
            return response()->json(['save' => true, 'redirect' => getRedirectName($pageIndex, $request->all())]);
        }
    }

    /**
     *  Show the form for editing the business plan resource.
     *
     * @param Request $request
     * @param $propertyId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $propertyId)
    {
        $params = $request->all();
        $userCurrent = Auth::user();
        abort_if(!$this->businessPlanRepository->checkDataExistsByPropertyId($propertyId), 404);
        $businessPlan = $this->businessPlanRepository->getObjectBusinessPlanByPropertyId($propertyId);
        if (!isset($params['year'])) {
            $params['year'] = isset($businessPlan['year']) ? $businessPlan['year'] : null;
        }
        $listAnnualPerformance = $this->annualPerformanceRepository->getListYearAnnualPerformance($propertyId);
        $annualPerformance = isset($listAnnualPerformance[$params['year']]) ? $listAnnualPerformance[$params['year']] : [];

        return view('backend.report.business_plan.edit')->with([
            'property' => $this->propertyRepository->getObjectPropertyById($propertyId),
            'businessPlan' => $businessPlan,
            'profile' => $this->profileRepository->findByAttribute('user_id', $userCurrent['id']),
            'optionUrl' => handlingParamUrl($request->all()),
            'listAnnualPerformance' => $listAnnualPerformance,
            'annualPerformance' => $annualPerformance,
            'params' => $params
        ]);
    }

    /**
     * update data business plan
     *
     * @param BusinessPlanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BusinessPlanRequest $request)
    {
        $params = $request->all();
        if (
            strtotime($this->businessPlanRepository->getObjectBusinessPlanByPropertyId($params['property_id'])['updated_at'])
            > strtotime($params['time_open_page'])
        ) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['save' => false]);
        }

        if ($this->businessPlanRepository->saveData($params)) {
            $pageIndex = displayNumberPage($this->propertyRepository->countRecordToPropertyId(
                targetUserId(),
                $params['property_id']
            ), (int)$params['option_paginate']);
            return response()->json(['save' => true, 'redirect' => getRedirectName($pageIndex, $request->all())]);
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        return response()->json(['save' => false]);
    }
}
