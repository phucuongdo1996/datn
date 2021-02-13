<?php

namespace App\Http\Controllers\Backend;

use App\Api\AddressApi;
use App\Http\Controllers\Controller;
use App\Repositories\RealEstateType\RealEstateTypeRepositoryInterface;
use App\Repositories\Simulation\SimulationRepositoryInterface;
use App\Http\Requests\SimulationRequest;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    /**
     * @var SimulationRepositoryInterface|\App\Repositories\Simulation\SimulationEloquentRepository
     */
    protected $simulationInterface;

    /**
     * Variable real estate type repository
     *
     * @var \App\Repositories\RealEstateType\RealEstateTypeEloquentRepository
     */
    private $realEstateTypeRepository;

    /**
     * SimulationController constructor.
     *
     * @param  SimulationRepositoryInterface  $simulationInterface
     * @param  RealEstateTypeRepositoryInterface  $realEstateTypeRepository
     */
    public function __construct(
        SimulationRepositoryInterface $simulationInterface,
        RealEstateTypeRepositoryInterface $realEstateTypeRepository
    ) {
        $this->simulationInterface = $simulationInterface;
        $this->realEstateTypeRepository = $realEstateTypeRepository;
    }

    /**
     * Display screen to create a new simulation
     *
     * @param  $addressApi
     * @return \Illuminate\View\View
     */
    public function create(AddressApi $addressApi)
    {
        return view('user.simulation')->with([
            'listRealEstateType' => $this->realEstateTypeRepository->getAll(),
            'prefectures' => $addressApi->getDataPrefecture(),
            'districts' => $addressApi->getDataDistrict(),
        ]);
    }

    /**
     * Create new simulation
     *
     * @param SimulationRequest $request
     * @return mixed
     */
    public function store(SimulationRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if ($this->simulationInterface->create($data)) {
            return response()->json(['save' => true]);
        }
        return response()->json(['save' => false]);
    }
}
