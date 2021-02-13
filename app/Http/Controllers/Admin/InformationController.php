<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationRequest;
use App\Repositories\Information\InformationRepositoryInterface;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * @var \App\Repositories\Information\InformationEloquentRepository
     */
    private $informationRepository;

    /**
     * InformationController constructor.
     * @param InformationRepositoryInterface $informationRepository
     */
    public function __construct(
        InformationRepositoryInterface $informationRepository
    ) {
        $this->informationRepository = $informationRepository;
    }

    /**
     * Show list information
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $information = $this->informationRepository->getInformation($request->all());
        return view('backend.admin.information.index', compact('information'));
    }

    /**
     * Show create information screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.admin.information.add');
    }

    /**
     * Create new information
     *
     * @param InformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InformationRequest $request)
    {
        if ($this->informationRepository->create($request->all())) {
            return redirect()->route(ADMIN_MANAGE_INFORMATION)->with(STR_SUCCESS_FLASH, trans('messages.admin.information.add_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.admin.information.add_fail'));
    }

    /**
     * Show edit information screen
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->informationRepository->findOrFail($id)->toArray();
        return view('backend.admin.information.edit', compact('data'));
    }

    /**
     * Update information
     *
     * @param InformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InformationRequest $request)
    {
        if ($this->informationRepository->update($request->id, $request->all())) {
            return redirect()->route(ADMIN_MANAGE_INFORMATION)->with(STR_SUCCESS_FLASH, trans('messages.admin.information.edit_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.admin.information.edit_fail'));
    }

    /**
     * Delete information
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if ($this->informationRepository->deleteRecord($request->information_id)) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.admin.information.delete_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.admin.information.delete_fail'));
    }
}
