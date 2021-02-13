<?php

namespace App\Repositories\IndexFormulas;

use App\Models\IndexFormulas;
use App\Repositories\BaseRepository;

class IndexFormulasEloquentRepository extends BaseRepository implements IndexFormulasRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return IndexFormulas::class;
    }

    /**
     * Get data values for Spiderweb Charts
     *
     * @param $params
     * @return array
     */
    public function getDataValues($params)
    {
        $dataSeries = [
            'dataSpiderWeb' => [],
            'dataFirstQuarter' => [],
            'dataAverageNumber' => [],
            'dataThirdQuarter' => [],
        ];

        $dataMediumStandardDeviation = $this->getMediumAndStandardDeviation($params);
        if (!$dataMediumStandardDeviation) {
            return $dataSeries;
        }
        for ($series = FLAG_ZERO; $series <= FLAG_THREE; $series++) {
            for ($formula = FLAG_ONE; $formula <= FLAG_SIX; $formula++) {
                $mediumStandardDeviation = $dataMediumStandardDeviation->where('formula', $formula)->first();
                if ($mediumStandardDeviation) {
                    array_push($dataSeries[SPIDER_WEB_SERIES[$series]], $this->calculateCategories($params, $mediumStandardDeviation->toArray(), ['series-chart' => $series, 'formula' => $formula]));
                } else {
                    array_push($dataSeries[SPIDER_WEB_SERIES[$series]], FLAG_ZERO);
                }
            }
        }
        return $dataSeries;
    }

    /**
     * Get data spiderWeb AnnualPerformance
     *
     * @param $dataMediumStandardDeviation
     * @param $dataAnnual
     * @param $totalAreaFloors
     * @return array
     */
    public function getDataSpiderWebAnnualPerformance($dataMediumStandardDeviation, $dataAnnual, $totalAreaFloors)
    {
        $dataSeries = [
            'spiderWeb' => [],
            'year' => [],
            'scoreMap' => []
        ];
        foreach ($dataAnnual as $key => $item) {
            $dataItems = [];
            for ($formula = FLAG_ONE; $formula <= FLAG_SIX; $formula++) {
                $mediumStandardDeviation = $dataMediumStandardDeviation[$formula] ?? null;
                if ($mediumStandardDeviation) {
                    array_push($dataItems, $this->calculateCategoriesAnnualPer($item, $mediumStandardDeviation, $totalAreaFloors, $formula));
                } else {
                    array_push($dataItems, FLAG_ZERO);
                }
            }
            array_push($dataSeries['spiderWeb'], $dataItems);
            array_push($dataSeries['year'], $item['year'] . trans('attributes.rent_roll_list.year'));
            array_push($dataSeries['scoreMap'], $this->calculateScoreMap($item['sum_difference'], $totalAreaFloors, $dataMediumStandardDeviation[FLAG_SEVEN] ?? null));
        }
        return $dataSeries;
    }

    /**
     * Get medium and standard deviation
     *
     * @param $params
     * @return mixed
     */
    public function getMediumAndStandardDeviation($params)
    {
        $record = $this->model->where('real_estate_type_id', $params['real_estate_type_id'])
            ->whereIn('region_acreage_year', $params['region_acreage_year'])
            ->unionAll(
                $this->model->where([
                    'real_estate_type_id' => $params['real_estate_type_id'],
                    'region_acreage_year' => '全体',
                    'formula' => FLAG_THREE
                ])
            )
            ->get();
        if ($record) {
            return $record;
        }
        return null;
    }

    /**
     * Calculate categories
     *
     * @param $params
     * @param $data
     * @param $type
     * @return float
     */
    public function calculateCategories($params, $data, $type)
    {
        try {
            $medium = $data['medium'];
            $standardDeviation = $data['standard_deviation'];
            $seriesChart = $type['series-chart'];
            if ($medium == null || $standardDeviation == null || $standardDeviation == 0 || ($params['total_area_floors'] == 0 && $seriesChart == 0)) {
                return 0;
            }
            $valueReturn = 0;
            switch ($type['formula']) {
                case FLAG_ONE:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 125 / 100 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['revenue_room_rentals'], $params['total_area_floors']) / 12 / 0.3025;
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 125 / 100 + 50, FLAG_ONE);
                    }
                    break;
                case FLAG_TWO:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['total_cost'], $params['total_area_floors']);
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    }
                    break;
                case FLAG_THREE:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['loss_insurance'], $params['total_area_floors']);
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    }
                    break;
                case FLAG_FOUR:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['repair_fee'], $params['total_area_floors']);
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    }
                    break;
                case FLAG_FIVE:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['maintenance_management_fee'], $params['total_area_floors']) / 12;
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50, FLAG_ONE);
                    }
                    break;
                case FLAG_SIX:
                    if (isset($params['type']) && $seriesChart != FLAG_ZERO) {
                        $valueReturn = round(divisionNumber($data[INDEX_SERIES[$seriesChart]] - $medium, $standardDeviation) * 10 * 1.25 + 50, FLAG_ONE);
                    } elseif ($seriesChart == FLAG_ZERO) {
                        $estateObject = divisionNumber($params['total_revenue'], $params['total_area_floors']);
                        $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 + 50, FLAG_ONE);
                    }
                    break;
            }
            if ($valueReturn > FLAG_ZERO && $valueReturn <= MAX_POINT) {
                return $valueReturn;
            } elseif ($valueReturn > MAX_POINT) {
                return MAX_POINT;
            }
            return FLAG_ZERO;
        } catch (\Exception $exception) {
            return 0;
        }
    }

    /**
     * Calculate categories for annual performance
     *
     * @param $params
     * @param $mediumStandardDeviation
     * @param $totalAreaFloors
     * @param $formula
     * @return float|int
     */
    public function calculateCategoriesAnnualPer($params, $mediumStandardDeviation, $totalAreaFloors, $formula)
    {
        try {
            $medium = $mediumStandardDeviation['medium'];
            $standardDeviation = $mediumStandardDeviation['standard_deviation'];
            if ($medium == null || $standardDeviation == null || $standardDeviation == 0 || ($totalAreaFloors == 0)) {
                return FLAG_ZERO;
            }
            $valueReturn = FLAG_ZERO;
            switch ($formula) {
                case FLAG_ONE:
                    $estateObject = divisionNumber($params['rent_income'], $totalAreaFloors) / 12 / 0.3025;
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 125 / 100 + 50);
                    break;
                case FLAG_TWO:
                    $estateObject = divisionNumber($params['sum_fee'], $totalAreaFloors);
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50);
                    break;
                case FLAG_THREE:
                    $estateObject = divisionNumber($params['insurance_premium'], $totalAreaFloors);
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50);
                    break;
                case FLAG_FOUR:
                    $estateObject = divisionNumber($params['repair_fee'], $totalAreaFloors);
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50);
                    break;
                case FLAG_FIVE:
                    $estateObject = divisionNumber($params['management_fee'], $totalAreaFloors) / 12;
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 * -1 + 50);
                    break;
                case FLAG_SIX:
                    $estateObject = divisionNumber($params['sum_income'], $totalAreaFloors);
                    $valueReturn = round(divisionNumber($estateObject - $medium, $standardDeviation) * 10 * 1.25 + 50);
                    break;
            }
            if ($valueReturn > FLAG_ZERO && $valueReturn <= MAX_POINT) {
                return $valueReturn;
            } elseif ($valueReturn > MAX_POINT) {
                return MAX_POINT;
            }
            return FLAG_ZERO;
        } catch (\Exception $exception) {
            return FLAG_ZERO;
        }
    }

    /**
     * Calculate scoreMap
     *
     * @param $operatingExpenses
     * @param $totalAreaFloors
     * @param $dataMediumStandardDeviation
     * @return float|int
     */
    public function calculateScoreMap($operatingExpenses, $totalAreaFloors, $dataMediumStandardDeviation)
    {
        if (!$dataMediumStandardDeviation) {
            return 0;
        }
        if (!$dataMediumStandardDeviation['medium'] || !$dataMediumStandardDeviation['standard_deviation'] || $dataMediumStandardDeviation['standard_deviation'] == 0 || $totalAreaFloors == 0) {
            return 0;
        }
        $scoreMap = round(divisionNumber(divisionNumber($operatingExpenses, $totalAreaFloors) - $dataMediumStandardDeviation['medium'], $dataMediumStandardDeviation['standard_deviation']) * 10 * 125 / 100 + 50);
        if ($scoreMap < 0) {
            return FLAG_ZERO;
        } elseif ($scoreMap > 100) {
            return MAX_POINT;
        } else {
            return $scoreMap;
        }
    }

    /**
     * Get medium and standard deviation
     *
     * @param $params
     * @return mixed
     */
    public function getDataIndexFormulas($params)
    {
        $record = $this->model->where('real_estate_type_id', $params['real_estate_type_id'])
            ->where('formula', '!=', FLAG_THREE)
            ->get();
        if ($record) {
            return $record;
        }
        return null;
    }

    /**
     * get data chart Single Analysis
     *
     * @param $param
     * @return mixed
     */
    public function getDataSingleAnalysis($param)
    {
        $data = $this->getDataIndexFormulas($param);
        foreach ($data as $subData) {
            if ($subData->formula) {
                switch ($subData->formula) {
                    case FLAG_ONE:
                        $subData->real_estate_object = round(divisionNumber($param['revenue_room_rentals'], $param['total_area_floors']) / 12 / 0.3025, 0);
                        break;
                    case FLAG_TWO:
                        $subData->real_estate_object = round(divisionNumber($param['total_cost'], $param['total_area_floors']), 0);
                        break;
                    case FLAG_FOUR:
                        $subData->real_estate_object = round(divisionNumber($param['repair_fee'], $param['total_area_floors']), 0);
                        break;
                    case FLAG_FIVE:
                        $subData->real_estate_object = round(divisionNumber($param['maintenance_management_fee'], $param['total_area_floors']) / 12, 0);
                        break;
                    case FLAG_SIX:
                        $subData->real_estate_object = round(divisionNumber($param['total_revenue'], $param['total_area_floors']), 0);
                        break;
                    case FLAG_SEVEN:
                        $subData->real_estate_object = round(divisionNumber($param['operating_expenses'], $param['total_area_floors']), 0);
                        break;
                    default:
                        $subData->real_estate_object = 0;
                        break;
                }
            } else {
                $subData->real_estate_object = 0;
            }
        }
        return $data->toArray();
    }
}
