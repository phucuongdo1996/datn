<?php

namespace App\Repositories\MonthlyBalance;

use App\Models\MonthlyBalance;
use App\Repositories\BaseRepository;
use App\Repositories\Property\PropertyRepositoryInterface;

class MonthlyBalanceEloquentRepository extends BaseRepository implements MonthlyBalanceRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return MonthlyBalance::class;
    }

    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params)
    {
        try {
            $property = resolve(PropertyRepositoryInterface::class)->find($params['property_id']);
            $property->monthlyBalances()->createMany($params['data']);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * update data
     *
     * @param int $propertyId
     * @param array $params
     *
     * @return bool
     */
    public function updateData($propertyId, $params)
    {
        try {
            $ids = $this->model->where('property_id', $propertyId)
                ->where('date_year_registration', $params[FLAG_ZERO]['date_year_registration'])
                ->pluck('id')
                ->toArray();
            foreach ($params as $key => $data) {
                $this->update($ids[$key], $data);
            }
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * get list date year by property id
     *
     * @param integer $propertyId
     * @return array
     */
    public function getListDateYearByPropertyId(int $propertyId)
    {
        return $this->model->selectRaw('distinct date_year_registration, property_id')
                    ->where('property_id', $propertyId)
                    ->orderBy('date_year_registration', 'desc')
                    ->pluck('date_year_registration')
                    ->toArray();
    }

    /**
     * get latest year has registered
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function getLatestYearHasRegistered(int $propertyId)
    {
        return $this->model->selectRaw('id, date_year_registration')
                        ->where('property_id', $propertyId)
                        ->orderBy('date_year_registration', 'desc')
                        ->pluck('date_year_registration')
                        ->first();
    }

    /**
     * get list by conditions
     *
     * @param integer $propertyId
     * @param array $params
     * @return array
     */
    public function getListByConditions(int $propertyId, array $params)
    {
        return $this->model->where('property_id', $propertyId)
                        ->when($params, function ($query, $params) {
                            return $query->where('date_year_registration', (int)$params['date_year']);
                        })
                        ->when(!$params, function ($query) use ($propertyId) {
                            return $query->where('date_year_registration', $this->getLatestYearHasRegistered($propertyId));
                        })
                        ->get()->toArray();
    }

    /**
     * get list by conditions
     *
     * @param integer $userId
     * @return mixed
     */
    public function getListPropertyIdByUserId(int $userId)
    {
        return $this->model->selectRaw(' distinct monthly_balances.property_id, property.house_name')
            ->join('property', 'monthly_balances.property_id', 'property.id')
            ->where('property.user_id', $userId)
            ->where('property.deleted_at', '=', null)
            ->get();
    }

    /**
     * get calculate the total data by year
     *
     * @param integer $propertyId
     * @param array $params
     * @return mixed
     */
    public function getCalculateTheTotalDataByYear(int $propertyId, array $params)
    {
        return $this->model->selectRaw('sum(revenue_land_taxes) as revenue_land_taxes, sum(revenue_room_rentals) as revenue_room_rentals, sum(revenue_service_charges) as revenue_service_charges
        , sum(revenue_utilities) as revenue_utilities, sum(revenue_car_deposits) as revenue_car_deposits, sum(turnover_revenue) as turnover_revenue
        , sum(revenue_contract_update_fee) as revenue_contract_update_fee, sum(revenue_other) as revenue_other, sum(bad_debt) as bad_debt
        , sum(total_operating_revenue) as total_operating_revenue, sum(maintenance_management_fee) as maintenance_management_fee
        , sum(electricity_gas_charges) as electricity_gas_charges, sum(repair_fee) as repair_fee, sum(recovery_costs) as recovery_costs
        , sum(property_management_fee) as property_management_fee, sum(find_tenant_fee) as find_tenant_fee, sum(tax) as tax
        , sum(loss_insurance) as loss_insurance, sum(land_rental_fee) as land_rental_fee, sum(other_costs) as other_costs
        , sum(total_operating_costs) as total_operating_costs, sum(operating_expenses) as operating_expenses')
            ->where('property_id', $propertyId)
            ->when($params, function ($query, $params) {
                return $query->where('date_year_registration', (int)$params['date_year']);
            })
            ->when(!$params, function ($query) use ($propertyId) {
                return $query->where('date_year_registration', $this->getLatestYearHasRegistered($propertyId));
            })
            ->get()->toArray();
    }

    /**
     * get data chart
     *
     * @param array $params
     * @return mixed
     */
    public function getDataChart(array $params)
    {
        return $this->model->selectRaw('concat(date_month_registration, "月期") as date_month_registration, total_operating_revenue, total_operating_costs, operating_expenses, rental_percentage')
            ->where('property_id', $params['property_id'])
            ->where('date_year_registration', (int)$params['date_year'])
            ->get()->toArray();
    }

    /**
     * set array data chart
     *
     * @param array $params
     * @return array
     */
    public function setArrayDataChart(array $params)
    {
        $data = array_merge(
            array_slice($this->getDataChart($params), $params['date_month'] - FLAG_ONE),
            array_slice($this->getDataChart($params), FLAG_ZERO, $params['date_month'] - FLAG_ONE)
        );

        return [array_column($data, 'total_operating_costs'), array_column($data, 'operating_expenses'), array_column($data, 'total_operating_revenue')
            , array_map('floatval', array_column($data, 'rental_percentage')), array_column($data, 'date_month_registration')];
    }

    /**
     * Set Array Data Preview
     *
     * @param $params
     * @return mixed
     */
    public function setArrayDataPreview($params)
    {
        $listItem = [
            'revenue_land_taxes',
            'revenue_room_rentals',
            'revenue_service_charges',
            'revenue_utilities',
            'revenue_car_deposits',
            'turnover_revenue',
            'revenue_contract_update_fee',
            'revenue_other',
            'bad_debt',
            'total_operating_revenue',
            'maintenance_management_fee',
            'electricity_gas_charges',
            'repair_fee',
            'recovery_costs',
            'property_management_fee',
            'find_tenant_fee',
            'tax',
            'loss_insurance',
            'land_rental_fee',
            'other_costs',
            'total_operating_costs',
            'operating_expenses',
            'rental_percentage'];
        foreach ($listItem as $item) {
            $arrData[$item] = array_column($params, $item);
        }
        return $arrData;
    }
}
