<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioAnalysisRequest;
use App\Repositories\DetailRealEstateType\DetailRealEstateTypeRepositoryInterface;
use App\Repositories\PortfolioAnalysis\PortfolioAnalysisRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\RentRoll\RentRollRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioAnalysisController extends Controller
{
    /**
     * Variable portfolio analysis repository
     *
     * @var PortfolioAnalysisRepositoryInterface
     */
    private $portfolioAnalysisRepository;

    /**
     * Variable property repository
     *
     * @var PropertyRepositoryInterface
     */
    private $propertyRepository;

    /**
     * Variable user repository
     *
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Variable detail real estate type repository
     *
     * @var DetailRealEstateTypeRepositoryInterface
     */
    private $detailRealEstateTypeRepository;

    /**
     * @var RentRollRepositoryInterface
     */
    private $rentRollRepository;

    /**
     * PortfolioAnalysisController constructor.
     *
     * @param PortfolioAnalysisRepositoryInterface $portfolioAnalysisRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param UserRepositoryInterface $userRepository
     * @param DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository
     * @param RentRollRepositoryInterface $rentRollRepository
     */
    public function __construct(
        PortfolioAnalysisRepositoryInterface $portfolioAnalysisRepository,
        PropertyRepositoryInterface $propertyRepository,
        UserRepositoryInterface $userRepository,
        DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository,
        RentRollRepositoryInterface $rentRollRepository
    ) {
        $this->portfolioAnalysisRepository = $portfolioAnalysisRepository;
        $this->propertyRepository = $propertyRepository;
        $this->userRepository = $userRepository;
        $this->detailRealEstateTypeRepository = $detailRealEstateTypeRepository;
        $this->rentRollRepository = $rentRollRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $this->handleCondition($request->all());
        if (isset($params['option_paginate'])) {
            is_numeric($params['option_paginate']) ? $params['option_paginate'] : $params['option_paginate'] = 10;
        }
        $listDetailReadEstateType = $this->detailRealEstateTypeRepository->getAll();
        $listDataTable = $this->propertyRepository->getListDataAnalysis($params);
        return view('backend.property.portfolio_analysis', [
            'listDataTables' => $listDataTable,
            'listDetailReadEstateType' => $listDetailReadEstateType,
            'params' => $params,
            'dataRenRollChart' => $this->rentRollRepository->getDataBuildChart($params),
            'proprietors' => $this->propertyRepository->getListProprietorsByUserId(Auth::user()->id),
        ]);
    }

    /**
     * Handle condition
     *
     * @param array $params
     *
     * @return mixed
     */
    public function handleCondition($params)
    {
        if (empty($params['status'])) {
            $params['status'] = array_key_exists('option_paginate', $params) ? [] : [1, 2, 3, 4];
        }
        if (empty($params['option_paginate'])) {
            $params['option_paginate'] = 10;
        } else {
            $paginate = $params['option_paginate'];
            if (!is_numeric($paginate) || ($paginate != 10 && $paginate != 20 && $paginate != 30 && $paginate != 50)) {
                $paginate = 10;
            }
            $params['option_paginate'] = $paginate;
        }
        return $params;
    }

    /**
     * Update or create
     *
     * @param PortfolioAnalysisRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrUpdate(PortfolioAnalysisRequest $request)
    {
        $params = $request->all();
        $result = $this->portfolioAnalysisRepository->saveData($params);

        if ($result) {
            return response()->json(['save' => true]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
