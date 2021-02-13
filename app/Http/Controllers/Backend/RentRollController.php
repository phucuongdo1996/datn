<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentRollRequest;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\RealEstateType\RealEstateTypeRepositoryInterface;
use App\Repositories\RentRoll\RentRollRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RentRollController extends Controller
{
    /**
     * Variable rent roll repository
     *
     * @var \App\Repositories\RentRoll\RentRollEloquentRepository;
     */
    private $rentRollRepository;

    /**
     * Variable property repository
     *
     * @var PropertyRepositoryInterface
     */
    private $propertyRepository;

    /**
     * Variable real estate type repository
     *
     * @var RealEstateTypeRepositoryInterface
     */
    private $realEstateTypeRepository;

    /**
     * Variable profile repository
     *
     * @var \App\Repositories\Profile\ProfileEloquentRepository;
     */
    private $profileRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * PortfolioAnalysisController constructor.
     *
     * @param RentRollRepositoryInterface $rentRollRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param RealEstateTypeRepositoryInterface $realEstateTypeRepository
     * @param ProfileRepositoryInterface $profileRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     */
    public function __construct(
        RentRollRepositoryInterface $rentRollRepository,
        PropertyRepositoryInterface $propertyRepository,
        RealEstateTypeRepositoryInterface $realEstateTypeRepository,
        ProfileRepositoryInterface $profileRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository
    ) {
        $this->rentRollRepository = $rentRollRepository;
        $this->propertyRepository = $propertyRepository;
        $this->realEstateTypeRepository = $realEstateTypeRepository;
        $this->profileRepository = $profileRepository;
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
        $request = request()->except('show_print');
        $userId = targetUserId();

        return view('backend.report.rent_roll.index')->with([
            'listProperty' => $this->rentRollRepository->getListByConditions($userId),
            'property' => $this->propertyRepository->getDataByIdOfUser($propertyId, $userId),
            'listRentRoll' => $this->rentRollRepository->getAllData($propertyId, $request)->toArray(),
            'score' => $this->rentRollRepository->arrayScoreInsideTheHouse($propertyId, $request),
            'realEstateType' => $this->realEstateTypeRepository->getAll(),
            'totalRealEstateTypes' => $this->rentRollRepository->setArrayTotalByRealEstateTypes($propertyId, $request),
            'propertyId' => $propertyId,
            'params' => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $propertyId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($propertyId)
    {
        return view('backend.report.rent_roll.add')->with([
            'listRealEstateType' => $this->realEstateTypeRepository->getAll(),
            'propertyId' => $propertyId
        ]);
    }

    /**
     * Show the form for contract renewal the specified resource.
     *
     * @param $propertyId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function contractRenewal($propertyId, $id)
    {
        $data = $this->rentRollRepository->getDataById($propertyId, $id);
        abort_if(!$data, 404);

        return view('backend.report.rent_roll.contract_renewal')->with([
            'listRealEstateType' => $this->realEstateTypeRepository->getAll(),
            'propertyId' => $propertyId,
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RentRollRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RentRollRequest $request)
    {
        $params = $request->all();
        if (empty($params['room_status'])) {
            $params['room_status'] = 'no_empty';
        }
        $result = $this->rentRollRepository->insertData($params);

        if ($result == false) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['save' => 'false']);
        } else {
            return response()->json(['save' => true]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $propertyId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($propertyId, $id)
    {
        $data = $this->rentRollRepository->getDataById($propertyId, $id);
        abort_if(!$data, 404);

        return view('backend.report.rent_roll.edit')->with([
            'listRealEstateType' => $this->realEstateTypeRepository->getAll(),
            'propertyId' => $propertyId,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RentRollRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RentRollRequest $request, $propertyId, $id)
    {
        $params = $request->all();
        $data = $this->rentRollRepository->getDataById($propertyId, $id);

        if (empty($params['room_status'])) {
            $params['room_status'] = 'no_empty';
        }
        if (!$data) {
            return response()->json(['updated' => false]);
        }
        if ($data['updated_at'] > $params['current_time']) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['updated' => false]);
        }
        $result = $this->rentRollRepository->updateData($params, $propertyId, $id);

        if ($result == false) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return response()->json(['save' => 'false']);
        } else {
            return response()->json(['save' => true]);
        }
    }

    /**
     * Delete rent roll of property
     *
     * @param Request $request
     * @param $propertyId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $propertyId, $id)
    {
        if ($this->rentRollRepository->deleteRecordById($id)) {
            if (isset($request->page)) {
                return redirect()->route(USER_PROPERTY_RENT_ROLL_ROOM, [
                    'propertyId' => $propertyId,
                    'page' => $this->rentRollRepository->getPageNumberRedirect($propertyId, $request->page, FLAG_FIFTY)
                ])->with(STR_FLASH_SUCCESS, trans('messages.rent_roll.success'));
            }
            return redirect()->back()->with(STR_FLASH_SUCCESS, trans('messages.rent_roll.success'));
        }
        return redirect()->back()->with(STR_FLASH_ERROR, trans('messages.rent_roll.fail'));
    }

    /**
     * Show list room
     *
     * @param $propertyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showListRoom($propertyId)
    {
        return view('backend.report.rent_roll.room')->with([
            'property' => $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId()),
            'dataRooms' => $this->rentRollRepository->listRentRollRoom($propertyId),
            'score' => $this->rentRollRepository->arrayScoreInsideTheHouse($propertyId),
        ]);
    }
}
