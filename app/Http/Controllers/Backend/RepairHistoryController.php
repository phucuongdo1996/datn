<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepairHistoryRequest;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\RepairHistory\RepairHistoryRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RepairHistoryController extends Controller
{
    /**
     * @var PropertyRepositoryInterface
     */
    private $propertyRepository;

    /**
     * @var RepairHistoryRepositoryInterface
     */
    private $repairHistoryRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * RepairHistoryController constructor.
     * @param PropertyRepositoryInterface $propertyRepository
     * @param RepairHistoryRepositoryInterface $repairHistoryRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        RepairHistoryRepositoryInterface $repairHistoryRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->repairHistoryRepository = $repairHistoryRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
    }

    /**
     * list Repair History
     *
     * @param $propertyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index($propertyId)
    {
        $property = $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId());
        $request = request()->all();
        $optionPaginate = isset($request['option_paginate']) && in_array($request['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
            ? $request['option_paginate'] : LIMIT_RECORD_DEFAULT;
        $records = $this->repairHistoryRepository->getListDataByHouseId($propertyId, $optionPaginate);
        $totalPage = ceil($property->repairHistory()->count() / $optionPaginate);
        return view('backend.report.repair_history.index', compact('records', 'property', 'optionPaginate', 'totalPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $propertyId
     * @return \Illuminate\Http\Response
     */
    public function create($propertyId)
    {
        return view('backend.report.repair_history.add')->with([
            'property' => $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId()),
            'optionPaginate' => request()['option_paginate'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepairHistoryRequest $request)
    {
        $data = $request->validatedForm();
        $request = $request->all();
        abort_if(!$data['property_id'], 404);
        $repairHistory = $this->repairHistoryRepository->create($data);
        if ($repairHistory) {
            return redirect()->route(USER_REPAIR_HISTORY, [$data['property_id'], 'option_paginate' => $request['option_paginate'], 'page' => $this->repairHistoryRepository->getPageNumber($request)]);
        } else {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $propertyId
     * @param int $repairHistoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($propertyId, $repairHistoryId)
    {
        $record = $this->repairHistoryRepository->getDataByPropertyId($repairHistoryId, $propertyId);
        abort_if(!$record, 404);
        return view('backend.report.repair_history.edit')->with([
            'property' => $this->propertyRepository->getDataByIdOfUser($propertyId, targetUserId()),
            'record' => $record,
            'optionPaginate' => request()['option_paginate']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RepairHistoryRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|void
     */
    public function update(RepairHistoryRequest $request)
    {
        $data = $request->validatedForm();
        $request = $request->all();
        $repairHistory = $this->repairHistoryRepository->getDataByPropertyId($data['id'], $data['property_id']);
        abort_if(!$repairHistory, 404);
        if (date_format($repairHistory['updated_at'], 'Y/m/d H:i:s') > $data['time_open_page']) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }

        if ($this->repairHistoryRepository->update($data['id'], $data)) {
            return redirect()->route(USER_REPAIR_HISTORY, [$data['property_id'], 'option_paginate' => $request['option_paginate'], 'page' => $this->repairHistoryRepository->getPageNumber($request)]);
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * Delete repair history of property
     *
     * @param Request $request
     * @param $propertyId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $propertyId, $id)
    {
        $request = $request->all();
        if ($this->repairHistoryRepository->deleteByPropertyId($id, $propertyId)) {
            return redirect()->route(USER_REPAIR_HISTORY, [$propertyId, 'option_paginate' => $request['option_paginate'], 'page' => $this->repairHistoryRepository->getPageNumber($request)]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return redirect()->back();
    }
}
