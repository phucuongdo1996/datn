<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Information\InformationRepositoryInterface;

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
    public function __construct(InformationRepositoryInterface $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    /**
     * Function index show list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.information.index')->with([
            'information' => $this->informationRepository->getInformation(null)
        ]);
    }

    /**
     *  Function show information detail
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        return view('user.information.detail')->with(['information' => $this->informationRepository->findOrFail($id)]);
    }
}
