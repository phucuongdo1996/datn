<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnualPerformanceRequest;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnualPerformanceController extends Controller
{
    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    private $propertyRepository;

    /**
     * @var \App\Repositories\AnnualPerformance\AnnualPerformanceEloquentRepository
     */
    private $annualPerformanceRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * AnnualPerformanceController constructor.
     *
     * @param PropertyRepositoryInterface $propertyRepository
     * @param AnnualPerformanceRepositoryInterface $annualPerformanceRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        AnnualPerformanceRepositoryInterface $annualPerformanceRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->annualPerformanceRepository = $annualPerformanceRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
    }

    /**
     * function index annual performance
     *
     * @param int $propertyId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($propertyId)
    {
        $params = request()->all();
        $property = $this->propertyRepository->find($propertyId);
        $annualPerformances = $this->annualPerformanceRepository->getListData($propertyId);
        return view('backend.report.annual_performance.index')->with([
            'annualPerformances' => $annualPerformances,
            'dataLatestYear' => $this->annualPerformanceRepository->getDataLatestYear($propertyId),
            'dataPreview' => $this->annualPerformanceRepository->setArrayDataPreview($annualPerformances->toArray()['data']),
            'property' => $this->annualPerformanceRepository->getProperty($property),
            'optionPaginate' => isset($request['option_paginate']) && in_array($params['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
                ? $params['option_paginate'] : LIMIT_RECORD_DEFAULT
        ]);
    }

    /**
     * Show Create Screen
     *
     * @param int $propertyId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($propertyId)
    {
        $property = $this->propertyRepository->find($propertyId);
        $listYear = $this->propertyRepository->getAllMonthAnnulPerformance($property);
        $property = $property->toArray();
        $property['amount_paid_annually'] = countAmountPaidAnnually(
            $property['loan'],
            $property['contract_loan_period'],
            $property['interest_rate']
        );
        return view('backend.report.annual_performance.add', compact('property', 'listYear'));
    }

    /**
     * Create new record
     *
     * @param int $propertyId
     * @param AnnualPerformanceRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($propertyId, AnnualPerformanceRequest $request)
    {
        $params = $request->all();
        if ($this->annualPerformanceRepository->createRecord($propertyId, $params)) {
            $record = $this->annualPerformanceRepository->countRecordByYear($propertyId, $params['year']);
            if ($record == FLAG_ZERO) {
                return response()->json([
                    'save' => true, 'redirect' => getRedirectName(FLAG_ONE, $params)
                ]);
            }
            $pageIndex = displayNumberPage($record, LIMIT_RECORD_DEFAULT);
            return response()->json([
                'save' => true, 'redirect' => getRedirectName($pageIndex, $params)
            ]);
        }
    }

    /**
     * Show edit screen
     *
     * @param int $propertyId
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($propertyId, $id)
    {
        $property = $this->propertyRepository->find($propertyId);
        $annualPer = $this->annualPerformanceRepository->find($id);
        if (!$annualPer || $annualPer->property_id != $propertyId) {
            abort(404);
        }
        $property['amount_paid_annually'] = countAmountPaidAnnually($property['loan'], $property['contract_loan_period'], $property['interest_rate']);
        $property = $property->toArray();
        $annualPer = $annualPer->toArray();
        return view('backend.report.annual_performance.edit', compact('property', 'annualPer'));
    }

    /**
     * Update record
     *
     * @param $propertyId
     * @param $id
     * @param AnnualPerformanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($propertyId, $id, AnnualPerformanceRequest $request)
    {
        $params = $request->all();
        $annualPerformance = $this->annualPerformanceRepository->find($id);
        if (date_format($annualPerformance['updated_at'], 'Y/m/d H:i:s') > $params['time_open_page']) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
        if ($this->annualPerformanceRepository->updateRecord($propertyId, $id, $params)) {
            return response()->json([
                'save' => true, 'redirect' => '/annual-performance?option_paginate=' . $params['option_paginate'] . '&page=' . $params['page']
            ]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
    }

    /**
     * Build spiderweb chart
     *
     * @param $propertyId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buildSpiderWebChart($propertyId, Request $request)
    {
        return response()->json(
            $this->annualPerformanceRepository->getDataSpiderWebChart(
                $propertyId,
                $request->all()['year']
            )
        );
    }

    /**
     * Data for graph below
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function graphBelow(Request $request)
    {
        return response()->json(['data' => $this->annualPerformanceRepository->setArrayDataChart($request->all())]);
    }

    /**
     * Delete data
     *
     * @param int $propertyId
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(int $propertyId, Request $request)
    {
        if (!$this->subUserPropertyRepository->handleCheckPermission($propertyId, REPORT_SCREEN)) {
            return redirect()->route(USER_REPORT)->with(STR_ERROR_FLASH, trans('messages.sub_user.report_permission_denied'));
        }
        if ($this->annualPerformanceRepository->destroy($propertyId, $request->get('annual_performance_id'))) {
            if ($this->propertyRepository->hasAnnualPerformance($propertyId)) {
                return redirect()->route(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX, [
                    'propertyId' => $propertyId,
                    'page' => $this->annualPerformanceRepository->getPageNumber($propertyId, FLAG_ELEVEN, request('page'))
                ]);
            }
            return redirect()->route(USER_REPORT);
        }

        return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.something_wrong'));
    }
}
