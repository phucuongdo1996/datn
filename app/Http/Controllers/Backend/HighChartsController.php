<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Areas\AreaRepositoryInterface;
use App\Repositories\IndexFormulas\IndexFormulasRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use Illuminate\Http\Request;

class HighChartsController extends Controller
{
    /**
     * @var \App\Repositories\Areas\AreaEloquentRepository
     */
    private $aresRepository;

    /**
     * @var \App\Repositories\IndexFormulas\IndexFormulasEloquentRepository
     */
    private $indexFormulasRepository;

    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    private $propertyRepository;

    /**
     * HighChartsController constructor.
     * @param AreaRepositoryInterface $aresRepository
     * @param IndexFormulasRepositoryInterface $indexFormulasRepository
     * @param PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(
        AreaRepositoryInterface $aresRepository,
        IndexFormulasRepositoryInterface $indexFormulasRepository,
        PropertyRepositoryInterface $propertyRepository
    ) {
        $this->aresRepository = $aresRepository;
        $this->indexFormulasRepository = $indexFormulasRepository;
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Build Spiderweb Chart
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buildSpiderWeb(Request $request)
    {
        if ($request->has('type')) {
            $params = $this->propertyRepository->find($request->get('property_id'))->toArray();
            $params = array_merge($params, [
                'provincial' => $params['address_city'],
                'district' => $params['address_district'],
                'type' => 'single_analysis'
            ]);
        } else {
            $params = $request->all();
        }
        if (!$params['real_estate_type_id'] || BANK_TYPES[$params['real_estate_type_id']] == "") {
            return response()->json([
                'dataSpiderWeb' => [],
                'dataFirstQuarter' => [],
                'dataAverageNumber' => [],
                'dataThirdQuarter' => [],
            ]);
        }
        $params['region_acreage_year'] = [
            $this->aresRepository->getRegionAcreageYear($params),
            getValueByListLimited($params['real_estate_type_id'], $params['total_area_floors']),
            getYearByListLimited($params['real_estate_type_id'], getNumberYearPassed($params['construction_time']))
        ];
        $dataValues = $this->indexFormulasRepository->getDataValues($params);
        return response()->json($dataValues);
    }

    /**
     * Build Scatter Chart
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buildScatterChart(Request $request)
    {
        return response()->json(['data' => $this->propertyRepository->getDataScatterChart()]);
    }
}
