<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonthlyBalanceRequest;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\MonthlyBalance\MonthlyBalanceRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MonthlyBalanceController extends Controller
{
    /**
     * Variable monthly balance repository
     *
     * @var \App\Repositories\MonthlyBalance\MonthlyBalanceEloquentRepository;
     */
    private $monthlyBalanceRepository;

    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository;
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
     * MonthlyBalanceController constructor.
     * @param  MonthlyBalanceRepositoryInterface  $monthlyBalanceRepository
     * @param  PropertyRepositoryInterface  $propertyRepository
     * @param  AnnualPerformanceRepositoryInterface  $annualPerformanceRepository
     * @param  SubUserPropertyRepositoryInterface  $subUserPropertyRepository
     */
    public function __construct(
        MonthlyBalanceRepositoryInterface $monthlyBalanceRepository,
        PropertyRepositoryInterface $propertyRepository,
        AnnualPerformanceRepositoryInterface $annualPerformanceRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository
    ) {
        $this->monthlyBalanceRepository = $monthlyBalanceRepository;
        $this->propertyRepository = $propertyRepository;
        $this->annualPerformanceRepository = $annualPerformanceRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
    }

    /**
     * Display a listing of the resource
     *
     * @param  $propertyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($propertyId)
    {
        $userId = targetUserId();
        $params = request()->except('show_print');
        $property = $this->propertyRepository->getDataByIdOfUser($propertyId, $userId);
        $listData = $this->monthlyBalanceRepository->getListByConditions($propertyId, $params);
        abort_if(empty($listData), 404);

        return view('backend.report.monthly_balance.index')->with([
            'listProperty' => $this->monthlyBalanceRepository->getListPropertyIdByUserId($userId),
            'listDateYear' => $this->monthlyBalanceRepository->getListDateYearByPropertyId($propertyId),
            'dateYear' => $this->monthlyBalanceRepository->getLatestYearHasRegistered($propertyId),
            'total' => $this->monthlyBalanceRepository->getCalculateTheTotalDataByYear($propertyId, $params)[FLAG_ZERO],
            'listData' => $listData,
            'property' => $property,
            'params' => $params,
            'dataPreview' => $this->monthlyBalanceRepository->setArrayDataPreview($listData),
            'dataByYear' => $this->annualPerformanceRepository->getDataByYear($propertyId, request()->has('date_year')
                ? request('date_year') : $this->monthlyBalanceRepository->getLatestYearHasRegistered($propertyId)),
        ]);
    }

    /**
     * graph
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function graph(Request $request)
    {
        return response()->json(['data' => $this->monthlyBalanceRepository->setArrayDataChart($request->all())]);
    }

    /**
     * Redirect create monthly balance
     *
     * @return mixed
     */
    public function create(Request $request, $propertyId)
    {
        $property = $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId());

        return view('backend.report.monthly_balance.add')->with([
            'propertyId' => $propertyId,
            'params' => $request->all(),
            'property' => $property,
            'dateYear' => $this->monthlyBalanceRepository->getListDateYearByPropertyId($propertyId),
        ]);
    }

    /**
     * Save data monthly balance
     *
     * @param MonthlyBalanceRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function store(MonthlyBalanceRequest $request)
    {
        $params = $request->all();
        $userId = targetUserId();
        $property = $this->propertyRepository
            ->getDataByIdOfUser(
                $params['data'][FLAG_ONE]['property_id'],
                $userId
            );
        if (!$params['data'][FLAG_ONE]['property_id'] || $userId != $property->user_id) {
            return abort(404);
        }

        if ($this->monthlyBalanceRepository->saveData($params)) {
            return response()->json(['save' => true]);
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        return response()->json(['save' => 'false']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param integer $propertyId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit(Request $request, $propertyId)
    {
        $params = $request->all();
        $property = $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId());
        abort_if(empty($params['date_year']), 404);
        $monthlyBalances = $this->monthlyBalanceRepository->getListByConditions($propertyId, $params);
        if (!$monthlyBalances) {
            return abort(404);
        }
        $monthlyBalances = array_merge(
            array_slice($monthlyBalances, $property['date_month_registration_revenue']),
            array_slice($monthlyBalances, FLAG_ZERO, $property['date_month_registration_revenue'])
        );

        return view('backend.report.monthly_balance.edit')->with([
            'propertyId' => $propertyId,
            'property' => $property,
            'monthlyBalances' => $monthlyBalances,
        ]);
    }

    /**
     * Update data monthly balance
     *
     * @param MonthlyBalanceRequest $request
     * @param int $propertyId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MonthlyBalanceRequest $request, $propertyId)
    {
        if ($this->monthlyBalanceRepository->updateData($propertyId, $request->data)) {
            return response()->json(['save' => true]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['save' => false]);
        }
    }
}
