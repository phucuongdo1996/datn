<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Repositories\Areas\AreaRepositoryInterface;
use App\Repositories\BuildingRight\BuildingRightRepositoryInterface;
use App\Repositories\DetailRealEstateType\DetailRealEstateTypeRepositoryInterface;
use App\Repositories\HouseMaterial\HouseMaterialRepositoryInterface;
use App\Repositories\HouseRoofType\HouseRoofTypeRepositoryInterface;
use App\Repositories\IndexFormulas\IndexFormulasRepositoryInterface;
use App\Repositories\LandRight\LandRightRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\RealEstateType\RealEstateTypeRepositoryInterface;
use App\Repositories\RepairHistory\RepairHistoryRepositoryInterface;
use App\Repositories\SimpleAssessment\SimpleAssessmentRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use App\Repositories\TypeRental\TypeRentalRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateNetProfitRequest;
use Illuminate\Support\Facades\Session;
use App\Api\AddressApi;

class PropertyController extends Controller
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Property\PropertyEloquentRepository;
     */
    private $propertyRepository;

    /**
     * Variable real estate type repository
     *
     * @var \App\Repositories\RealEstateType\RealEstateTypeEloquentRepository
     */
    private $realEstateTypeRepository;

    /**
     * Variable detail real estate type repository
     *
     * @var \App\Repositories\DetailRealEstateType\DetailRealEstateTypeEloquentRepository
     */
    private $detailRealEstateTypeRepository;

    /**
     * Variable building right repository
     *
     * @var \App\Repositories\BuildingRight\BuildingRightEloquentRepository
     */
    private $buildingRightRepository;

    /**
     * Variable land right repository
     *
     * @var \App\Repositories\LandRight\LandRightEloquentRepository
     */
    private $landRightRepository;

    /**
     * Variable house roof type repository
     *
     * @var \App\Repositories\HouseRoofType\HouseRoofTypeEloquentRepository
     */
    private $houseRoofTypeRepository;

    /**
     * Variable house material repository
     *
     * @var \App\Repositories\HouseMaterial\HouseMaterialEloquentRepository
     */
    private $houseMaterialRepository;

    /**
     * Variable type rental repository
     *
     * @var \App\Repositories\TypeRental\TypeRentalEloquentRepository
     */
    private $typeRentalRepository;

    /**
     * Variable user repository
     *
     * @var \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\Areas\AreaEloquentRepository
     */
    private $aresRepository;

    /**
     * @var \App\Repositories\IndexFormulas\IndexFormulasEloquentRepository
     */
    private $indexFormulasRepository;

    /**
     * @var RepairHistoryRepositoryInterface
     */
    private $repairHistoryRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * @var SimpleAssessmentRepositoryInterface | \App\Repositories\SimpleAssessment\SimpleAssessmentEloquentRepository
     */
    private $simpleAssessmentRepository;

    /**
     * PropertyController constructor.
     * @param PropertyRepositoryInterface $propertyRepository
     * @param RealEstateTypeRepositoryInterface $realEstateTypeRepository
     * @param DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository
     * @param BuildingRightRepositoryInterface $buildingRightRepository
     * @param LandRightRepositoryInterface $landRightRepository
     * @param HouseRoofTypeRepositoryInterface $houseRoofTypeRepository
     * @param HouseMaterialRepositoryInterface $houseMaterialRepository
     * @param TypeRentalRepositoryInterface $typeRentalRepository
     * @param UserRepositoryInterface $userRepository
     * @param AreaRepositoryInterface $aresRepository
     * @param IndexFormulasRepositoryInterface $indexFormulasRepository
     * @param RepairHistoryRepositoryInterface $repairHistoryRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     * @param SimpleAssessmentRepositoryInterface $simpleAssessmentRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        RealEstateTypeRepositoryInterface $realEstateTypeRepository,
        DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository,
        BuildingRightRepositoryInterface $buildingRightRepository,
        LandRightRepositoryInterface $landRightRepository,
        HouseRoofTypeRepositoryInterface $houseRoofTypeRepository,
        HouseMaterialRepositoryInterface $houseMaterialRepository,
        TypeRentalRepositoryInterface $typeRentalRepository,
        UserRepositoryInterface $userRepository,
        AreaRepositoryInterface $aresRepository,
        IndexFormulasRepositoryInterface $indexFormulasRepository,
        RepairHistoryRepositoryInterface $repairHistoryRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository,
        SimpleAssessmentRepositoryInterface $simpleAssessmentRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->realEstateTypeRepository = $realEstateTypeRepository;
        $this->detailRealEstateTypeRepository = $detailRealEstateTypeRepository;
        $this->buildingRightRepository = $buildingRightRepository;
        $this->landRightRepository = $landRightRepository;
        $this->houseRoofTypeRepository = $houseRoofTypeRepository;
        $this->houseMaterialRepository = $houseMaterialRepository;
        $this->typeRentalRepository = $typeRentalRepository;
        $this->userRepository = $userRepository;
        $this->aresRepository = $aresRepository;
        $this->indexFormulasRepository = $indexFormulasRepository;
        $this->repairHistoryRepository = $repairHistoryRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
        $this->simpleAssessmentRepository = $simpleAssessmentRepository;
    }

    /**
     * Index singleAnalysis
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function indexSingleAnalysis()
    {
        $userProxy = Auth::user()->isSubUser() ? Auth::user()->getParentUser() : Auth::user();
        $property = $this->propertyRepository->getLastPropertyByUser($userProxy->id);
        return $property ? redirect()->route(USER_SINGLE_ANALYSIS, ['propertyId' => $property->id]) : redirect()->route(USER_PROPERTY_INDEX);
    }

    /**
     * Function index property
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $params['subuser_id'] = Auth::user()->isSubUser() ? null : ($params['subuser_id'] ?? null);
        $params['proprietor'] = Auth::user()->isInvestor() ? null : ($params['proprietor'] ?? null);
        $properties = $this->propertyRepository->getListDataAfterConvert($params);
        $countProperty = $properties->count();
        $listSubUser = Auth::user()->isMainUser() ? $this->userRepository->getListSubUserByParentId(Auth::user()->id) : [];
        return view('backend.property.index', [
            'properties' => $properties,
            'countProperty' => $countProperty,
            'proprietors' => $this->propertyRepository->getListProprietorsByUserId(Auth::user()->id),
            'params' => $params,
            'listSubUser' => $listSubUser,
        ]);
    }

    /**
     * Redirect create property
     *
     * @param AddressApi $addressApi
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(AddressApi $addressApi)
    {
        return view('backend.property.register_info')->with([
            'listProperty' => $this->propertyRepository->getListNameByUserId(Auth::user()->id),
            'listReadEstateType' => $this->realEstateTypeRepository->getAll(),
            'listDetailReadEstateType' => $this->detailRealEstateTypeRepository->getAll(),
            'listBuildingRight' => $this->buildingRightRepository->getAll(),
            'listLandRight' => $this->landRightRepository->getAll(),
            'listHouseRoofType' => $this->houseRoofTypeRepository->getAll(),
            'listHouseMaterial' => $this->houseMaterialRepository->getAll(),
            'listTypeRental' => $this->typeRentalRepository->getAll(),
            'prefectures' => $addressApi->getDataPrefecture(),
            'districts' => $addressApi->getDataDistrict(),
        ]);
    }

    /**
     * Save data property
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PropertyRequest $request)
    {
        $user = Auth::user()->userProxy(CHANGE_PROPERTY);
        if ($this->propertyRepository->saveData($request, $user['id'], $this->userRepository->getByUserCode($user['id']))) {
            return response()->json(['save' => displayNumberPage(
                $this->propertyRepository->countRecord(),
                MAX_RECORD_LIST_PROPERTY
            )]);
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => 'false']);
    }

    /**
     * function  update net profit
     *
     * @param UpdateNetProfitRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateNetProfit(UpdateNetProfitRequest $request, $id)
    {
        $params = $request->all();
        $property = $this->propertyRepository->find($id);
        try {
            if ($property) {
                $amountAssessedTaxing = (int)round(divisionNumber(($property->operating_revenue_expenditure * 100), $params['net_profit']), FLAG_ZERO);
                $params['amount_assessed_taxing'] = excelRound($amountAssessedTaxing, FLAG_FIVE - strlen((string)$amountAssessedTaxing));
                $this->simpleAssessmentRepository->updateOrCreate(['property_id' => $id], $params);
                return response()->json([
                    'save' => true,
                    'amount_assessed_taxing' => $params['amount_assessed_taxing']
                ]);
            }
            return response()->json(['save' => false]);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['save' => false]);
        }
    }

    /**
     * function delete house
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->subUserPropertyRepository->handleCheckPermission($id, DELETE_SCREEN)) {
            Session::flash(STR_ERROR_FLASH, trans('messages.sub_user.delete_property_permission_denied'));
            return redirect(route(USER_PROPERTY_INDEX, ['page' => $request->page]));
        }

        if ($this->propertyRepository->deleteByIdOfUser($id)) {
            return redirect()->route(USER_PROPERTY_INDEX, [
                'page' => $this->propertyRepository->getPageNumberRedirect(LIMIT_RECORD_LIST_HOUSE_DEFAULT, $request->page)
            ]);
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return redirect()->back();
    }

    /**
     * Show the form for editing the property resource.
     *
     * @param int $propertyId
     * @param AddressApi $addressApi
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($propertyId, AddressApi $addressApi)
    {
        $request = request()->all();
        if (!$this->subUserPropertyRepository->handleCheckPermission($propertyId, EDIT_SCREEN)) {
            Session::flash(STR_ERROR_FLASH, trans('messages.sub_user.edit_property_permission_denied'));
            return $this->propertyRepository->getRedirectRouteName($request);
        }

        return view('backend.property.edit')->with([
            'listProperty' => $this->propertyRepository->getListNameByUserId(Auth::user()->id, $propertyId),
            'propertyData' => $this->propertyRepository->getObjectPropertyById($propertyId),
            'listReadEstateType' => $this->realEstateTypeRepository->getAll(),
            'listDetailReadEstateType' => $this->detailRealEstateTypeRepository->getAll(),
            'listHouseMaterial' => $this->houseMaterialRepository->getAll(),
            'listHouseRoofType' => $this->houseRoofTypeRepository->getAll(),
            'listBuildingRight' => $this->buildingRightRepository->getAll(),
            'listLandRight' => $this->landRightRepository->getAll(),
            'listTypeRental' => $this->typeRentalRepository->getAll(),
            'prefectures' => $addressApi->getDataPrefecture(),
            'districts' => $addressApi->getDataDistrict(),
        ]);
    }

    /**
     * Update the property resource in storage.
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PropertyRequest $request)
    {
        $propertyData = $request->all();
        $propertyData['rental_percentage'] = preg_replace('[%]', '', $propertyData['rental_percentage']);
        if (!$this->subUserPropertyRepository->handleCheckPermission($propertyData['property_id'], EDIT_SCREEN)) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['updated' => false]);
        }
        $pageNumber = $this->propertyRepository->getPageNumber($propertyData['property_id'], FLAG_SEVEN);
        $updatedAt = $this->propertyRepository->find($propertyData['property_id']);

        if (date_format($updatedAt['updated_at'], 'Y/m/d H:i:s') > $propertyData['time_open_page']) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['updated' => false]);
        }

        if ($this->propertyRepository->updateRecord($updatedAt, $propertyData)) {
            return response()->json(['updated' => true, 'pageNumber' => $pageNumber]);
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['message' => 'Update data fail.']);
    }

    /**
     * Function get list borrowing
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listBorrowing(Request $request)
    {
        $params = $request->except('page');
        if (isset($params['paginate'])) {
            is_numeric($params['paginate']) ? $params['paginate'] : $params['paginate'] = 10;
        }
        $listData = $this->propertyRepository->getListDataBorrowing($params);
        $dataChart = $this->propertyRepository->getDataChartBorrowing();
        return view('backend.property.borrowing', [
            'params' => $params,
            'listData' => $listData,
            'dataChart' => $dataChart,
            'proprietors' => $this->propertyRepository->getListProprietorsByUserId(Auth::user()->id)
        ]);
    }

    /**
     * Get data chart when check list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataBorrowingChartAll(Request $request)
    {
        $params = $request->all();
        $listId = json_decode($params['list_id_checked'], true);
        return response()->json([
            'data' => json_encode($this->propertyRepository->getDataChartBorrowing($listId))
        ]);
    }

    /**
     * list single analysis
     *
     * @param int $propertyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSingleAnalysis($propertyId)
    {
        $userId = Auth::user()->id;
        $property = $this->propertyRepository->getObjectPropertyById($propertyId);
        if (!$property || $userId != $property['user_id']) {
            return abort(404);
        }
        $dataValues = $this->indexFormulasRepository->getDataSingleAnalysis($property);
        if (isset($property['real_estate_type']['bank_uses'])) {
            $dataValues['bank_uses'] = $property['real_estate_type']['bank_uses'];
        }
        $listPropertyTable = $this->propertyRepository->getAllDataSingleAnalysis($property);
        $dataCompeteChart = $this->propertyRepository->getDataCompeteChart($property, $listPropertyTable);
        return view('backend.property.single_analysis')->with([
            'property' => $property,
            'listProperty' => $this->propertyRepository->getListNameByUserId($userId),
            'listPropertyTable' => $listPropertyTable,
            'countProperty' => count($listPropertyTable),
            'dataValues' => $dataValues,
            'dataCompeteChart' => $dataCompeteChart,
            'pmt' => pmt($property['interest_rate'], $property['contract_loan_period'], $property['loan'])
        ]);
    }

    /**
     * sort borrowing all data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSortBorrowing()
    {
        abort_if(Auth::user()->isSubUser(), 404);
        $listData = $this->propertyRepository->getAllDataBorrowing();
        return view('backend.property.borrowing_sort', compact('listData'));
    }

    /**
     * update order property
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrderProperty(Request $request)
    {
        $params = $request->all();
        $result = $this->propertyRepository->updateOrder($params);

        if ($result == true) {
            return response()->json(['updated' => true]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['updated' => false]);
        }
    }

    /**
     * Move to Repair History
     *
     * @param Request $request
     * @param $propertyId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function moveRepairHistory(Request $request, $propertyId)
    {
        $property = $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId());
        if (!$property) {
            return abort(404);
        }
        if ($this->repairHistoryRepository->checkHasRepair($propertyId)) {
            return redirect()->route(USER_REPAIR_HISTORY, $propertyId);
        }
        return redirect()->route(USER_REPAIR_HISTORY_CREATE, [$propertyId, 'screen' => $request->all()['screen'], 'page' => $request->all()['page']]);
    }

    /**
     * function get data example
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getDataExample(Request $request)
    {
        if (isset($request->id)) {
            return response()->json([
                'data' => $this->propertyRepository->getDataExample($request->id, $request->year),
                'propertyChecked' => view('backend.preview_print.property-tax-preview', ['data' => $this->propertyRepository->getPropertyChecked($request->id)])->render()
            ]);
        }
    }

    /**
     * function get data house example
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getDataHouseExample(Request $request)
    {
        $params = $request->all();
        if (isset($params['year']) && isset($params['month'])) {
            return response()->json(['data' => view('backend.property.confirm_final.list_house', ['listProperty' => $this->propertyRepository->getDataCreateTax($params)])->render()]);
        }
    }

    /**
     * search
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        return view('backend.property.search.bank')->with([
            'params' => $request->all()
        ]);
    }

    /**
     * get data search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDataSearch(Request $request)
    {
        $params = $request->all();
        abort_if($this->propertyRepository->isConditionSearch($params), 404);
        $listData = $this->propertyRepository->getDataSearch($params);
        $dataCompeteChart = $this->propertyRepository->getDataCompeteChartBankList($listData->items());
        return view('backend.property.search.index') ->with([
            'itemSearch' => displayItemSearch($params),
            'listData' => $this->propertyRepository->getDataSearch($params),
            'params' => $params,
            'dataCompeteChart' => $dataCompeteChart
        ]);
    }
}
