<?php

namespace App\Repositories\AnnualPerformance;

use App\Models\AnnualPerformance;
use App\Repositories\Areas\AreaRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\IndexFormulas\IndexFormulasRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnnualPerformanceEloquentRepository extends BaseRepository implements AnnualPerformanceRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return AnnualPerformance::class;
    }

    /**
     * Create new record
     *
     * @param $propertyId
     * @param array $params
     * @return bool
     */
    public function createRecord($propertyId, array $params)
    {
        try {
            $params['property_id'] = $propertyId;
            $dataMediumStandardDeviation = $this->getMediumAndStandardDeviation($propertyId);
            $params['synthetic_point'] = !empty($dataMediumStandardDeviation['mediumAndStandardDeviation']) ?
                $this->calculateScoreMap($params['sum_difference'], $dataMediumStandardDeviation['total_area_floors'], $dataMediumStandardDeviation['mediumAndStandardDeviation'][FLAG_SEVEN]) : FLAG_ZERO;
            $this->create($params);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
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
     * Create record by new property
     *
     * @param $property
     */
    public function createRecordByNewProperty($property)
    {
        $data = $this->getProperty($property);
        $dataMediumStandardDeviation = $this->getMediumAndStandardDeviation($data['id']);
        $this->create([
            'property_id' => $data['id'],
            'year' => $data['date_year_registration_revenue'],
            'revenue_land_taxes' => $data['revenue_land_taxes'],
            'rent_income' => $data['revenue_room_rentals'],
            'general_services' => $data['revenue_service_charges'],
            'utilities_revenue' => $data['revenue_utilities'],
            'parking_revenue' => $data['revenue_car_deposits'],
            'income_input_money' => $data['turnover_revenue'],
            'income_update_house_contract' => $data['revenue_contract_update_fee'],
            'other_income' => $data['revenue_other'],
            'bad_debt_losses' => $data['bad_debt'],
            'sum_income' => $data['total_revenue'],
            'management_fee' => $data['maintenance_management_fee'],
            'utilities_fee' => $data['electricity_gas_charges'],
            'repair_fee' => $data['repair_fee'],
            'intact_reply_fee' => $data['recovery_costs'],
            'asset_management_fee' => $data['property_management_fee'],
            'tenant_recruitment_fee' => $data['find_tenant_fee'],
            'taxes_dues' => $data['tax'],
            'insurance_premium' => $data['loss_insurance'],
            'land_tax' => $data['land_rental_fee'],
            'other_fee' => $data['other_costs'],
            'sum_fee' => $data['total_cost'],
            'sum_difference' => $data['total_revenue'] - $data['total_cost'],
            'crop_yield' => number_format(divisionNumber($data['area_rental_operating'], $data['area_may_rent']) * FLAG_ONE_HUNDRED, FLAG_TWO),
            'dscr' => number_format(divisionNumber(($data['total_revenue'] - $data['total_cost']), $data['amount_paid_annually']) * FLAG_ONE_HUNDRED, FLAG_TWO),
            'total_tenants' => $data['total_tenants'],
            'area_may_rent' => $data['area_may_rent'],
            'deposits' => $data['deposits'],
            'area_rental_operating' => $data['area_rental_operating'],
            'synthetic_point' => $this->calculateScoreMap($data['total_revenue'] - $data['total_cost'], $data['total_area_floors'], $dataMediumStandardDeviation['mediumAndStandardDeviation'][FLAG_SEVEN])
        ]);
    }

    /**
     * Update annual performance record
     *
     * @param $propertyId
     * @param $id
     * @param array $params
     * @return bool
     */
    public function updateRecord($propertyId, $id, array $params)
    {
        DB::beginTransaction();
        try {
            if (!$this->accuracyRecord($this->find($id), $propertyId, $params['year'])) {
                return false;
            }
            $dataMediumStandardDeviation = $this->getMediumAndStandardDeviation($propertyId);
            $params['synthetic_point'] = $this->calculateScoreMap($params['sum_difference'], $dataMediumStandardDeviation['total_area_floors'], $dataMediumStandardDeviation['mediumAndStandardDeviation'][FLAG_SEVEN]);
            $this->update($id, $params);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Accuracy record
     *
     * @param $annualPerformance
     * @param $propertyId
     * @param $year
     * @return bool
     */
    public function accuracyRecord($annualPerformance, $propertyId, $year)
    {
        if ($annualPerformance->property_id != $propertyId || $annualPerformance->year != $year) {
            return false;
        }
        return true;
    }

    /**
     *
     * unction get year max
     *
     * @param int $propertyId
     *
     * @return mixed
     */
    public function getLatestYearHasRegistered(int $propertyId)
    {
        return $this->model->select('year')
            ->where('property_id', $propertyId)
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->first();
    }

    /**
     *
     * function get data year max
     *
     * @param int $propertyId
     *
     * @return mixed
     */
    public function getDataLatestYear(int $propertyId)
    {
        return $this->model
                    ->where('property_id', $propertyId)
                    ->where('year', $this->getLatestYearHasRegistered($propertyId))
                    ->first();
    }

    /**
     * function get all data list annual Performance no have year max
     *
     * @param $propertyId
     * @return mixed
     */
    public function getListData($propertyId)
    {
        return $this->model
                    ->where('property_id', $propertyId)
                    ->where('year', '<>', $this->getLatestYearHasRegistered($propertyId))
                    ->orderBy('year', 'desc')->paginate(LIMIT_RECORD_DEFAULT);
    }

    /**
     * function get all data list house
     *
     * @return mixed|void
     */
    public function getProperty($property)
    {
        $property = $property->toArray();
        $property['amount_paid_annually'] = countAmountPaidAnnually($property['loan'], $property['contract_loan_period'], $property['interest_rate']);
        return $property;
    }

    /**
     * count tax total page
     *
     * @return mixed
     */
    public function countAnual($propertyId)
    {
        return $this->model->where('property_id', $propertyId)->count();
    }

    /**
     * Get data by list year
     *
     * @param $propertyId
     * @param $years
     * @return mixed
     */
    public function getDataByYears($propertyId, $years)
    {
        return $this->model->where('property_id', $propertyId)->whereIn('year', $years)->orderBy('year', 'desc')->get()->toArray();
    }

    /**
     * Get data spider web chart
     *
     * @param $propertyId
     * @param $years
     * @return array
     */
    public function getDataSpiderWebChart($propertyId, $years)
    {
        $dataAnnual = $this->getDataByYears($propertyId, $years);
        if (empty($dataAnnual)) {
            return [
                'spiderWeb' => [],
                'year' => [],
                'scoreMap' => []
            ];
        }
        $dataMediumStandardDeviation = $this->getMediumAndStandardDeviation($propertyId);
        return resolve(IndexFormulasRepositoryInterface::class)
            ->getDataSpiderWebAnnualPerformance($dataMediumStandardDeviation['mediumAndStandardDeviation'], $dataAnnual, $dataMediumStandardDeviation['total_area_floors']);
    }

    /**
     * Get medium and standard deviation by Property
     *
     * @param $propertyId
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getMediumAndStandardDeviation($propertyId)
    {
        $property = resolve(PropertyRepositoryInterface::class)->find($propertyId)->toArray();
        if (!$property['real_estate_type_id'] || BANK_TYPES[$property['real_estate_type_id']] == "") {
            return [
                'mediumAndStandardDeviation' => [],
                'total_area_floors' => FLAG_ZERO
            ];
        }
        $property['provincial'] = $property['address_city'];
        $property['district'] = $property['address_district'];
        $property['region_acreage_year'] = [
            resolve(AreaRepositoryInterface::class)->getRegionAcreageYear($property),
            getValueByListLimited($property['real_estate_type_id'], $property['total_area_floors']),
            getYearByListLimited($property['real_estate_type_id'], getNumberYearPassed($property['construction_time']))
        ];
        return [
            'mediumAndStandardDeviation' => resolve(IndexFormulasRepositoryInterface::class)->getMediumAndStandardDeviation($property)->keyBy('formula')->toArray(),
            'total_area_floors' => $property['total_area_floors']
        ];
    }

    /**
     * Set Array Data Chart
     *
     * @param $params
     * @return array
     */
    public function setArrayDataChart($params)
    {
        $data = $this->getDataByYears($params['property_id'], $params['year']);
        return [
            array_column($data, 'sum_fee'),
            array_column($data, 'sum_difference'),
            array_column($data, 'sum_income'),
            array_column($data, 'crop_yield'),
            array_column($data, 'year')
        ];
    }

    /**
     * count record by year
     *
     * @param integer $propertyId
     * @param integer $year
     * @return mixed
     */
    public function countRecordByYear($propertyId, $year)
    {
        return $this->model
            ->where('property_id', $propertyId)
            ->where('year', '>', $year)
            ->count();
    }

    /**
     * Set Array Data Preview
     *
     * @param $params
     * @return mixed
     */
    public function setArrayDataPreview($params)
    {
        $listItem = $this->model->getFillable();
        $exceptItems = ['id', 'property_id'];
        foreach ($listItem as $item) {
            if (!in_array($item, $exceptItems)) {
                $arrData[$item] = array_column($params, $item);
            }
        }
        return $arrData;
    }

    /**
     * Delete by property Id
     *
     * @param int $propertyId
     * @param int $annualPerformanceId
     *
     * @return bool
     */
    public function destroy(int $propertyId, int $annualPerformanceId): bool
    {
        DB::beginTransaction();
        try {
            $annualPerformance = $this->model->where([
                'property_id' => $propertyId,
                'id' => $annualPerformanceId
            ])->first();
            if (!$annualPerformance) {
                return false;
            }
            $annualPerformance->update(['unblock_status' => true]);
            $annualPerformance->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Count by property Id
     *
     * @param int $propertyId
     *
     * @return int
     */
    public function countByPropertyId(int $propertyId): int
    {
        return $this->model->where('property_id', $propertyId)->count();
    }

    /**
     * Get number page
     *
     * @param int $propertyId
     * @param int $perPage
     * @param int $page
     *
     * @return int
     */
    public function getPageNumber($propertyId, $perPage, $page): int
    {
        if ($this->countByPropertyId($propertyId) == ($page - FLAG_ONE) * $perPage) {
            return $page - FLAG_ONE;
        }

        return $page;
    }

    /**
     * function get all data list annual Performance by property id
     *
     * @param $propertyId
     * @return mixed
     */
    public function getListDataByPropertyId($propertyId)
    {
        return $this->model
            ->where('property_id', $propertyId)
            ->orderBy('year', 'desc')
            ->get()->toArray();
    }

    /**
     * Get data by year
     *
     * @param $propertyId
     * @param $year
     * @return mixed|string
     */
    public function getDataByYear($propertyId, $year)
    {
        $listData = $this->getListDataByPropertyId($propertyId);

        if (empty($year) || !in_array($year, array_column($listData, 'year'))) {
            return null;
        }
        return array_combine(array_column($listData, 'year'), $listData)[$year];
    }

    /**
     * Get list year AnnualPerformance
     *
     * @param $propertyId
     * @return mixed
     */
    public function getListYearAnnualPerformance($propertyId)
    {
        return $this->model->where('property_id', $propertyId)->get()->keyBy('year')->toArray();
    }
}
