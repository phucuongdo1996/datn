<?php

namespace App\Repositories\RentRoll;

use App\Models\RentRoll;
use App\Repositories\BaseRepository;
use App\Repositories\Property\PropertyRepositoryInterface;

class RentRollEloquentRepository extends BaseRepository implements RentRollRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return RentRoll::class;
    }

    /**
     * Get data rent-roll
     *
     * @param int $propertyId
     *
     * @return mixed
     */
    public function getDataById($propertyId, $id)
    {
        return $this->model->where('property_id', $propertyId)->find($id);
    }

    /**
     * Insert new data rent-roll
     *
     * @param array $params
     *
     * @return bool
     */
    public function insertData($params)
    {
        try {
            $this->create($params);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Update data rent-roll
     *
     * @param array $params
     *
     * @return bool
     */
    public function updateData($params, $propertyId, $id)
    {
        try {
            $this->model->where('property_id', $propertyId)->find($id)->update($params);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * check data exists by property id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function checkDataExistsByPropertyId(int $propertyId)
    {
        return $this->model->where('property_id', $propertyId)
            ->exists();
    }

    /**
     * get list by conditions
     *
     * @param integer $userId
     * @return mixed
     */
    public function getListByConditions(int $userId)
    {
        return $this->model->selectRaw(' distinct rent_rolls.property_id, property.house_name')
            ->join('property', 'rent_rolls.property_id', 'property.id')
            ->where('property.user_id', $userId)
            ->where('property.deleted_at', '=', null)
            ->get();
    }

    /**
     * get all data
     *
     * @param integer $propertyId
     * @param array $params
     * @return mixed
     */
    public function getAllData(int $propertyId, array $params)
    {
        return $this->model->where('property_id', $propertyId)
            ->contractDate($params)->get();
    }

    /**
     * get data score by id
     *
     * @param integer $id
     * @return mixed
     */
    private function getDataScoreById(int $id)
    {
        return $this->model->selectRaw('monthly_rent, monthly_service, contract_area, deposit, key_money, real_estate_type_id')
            ->where('id', $id)
            ->first();
    }

    /**
     * get list id by property id
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getListIdByPropertyId(int $propertyId)
    {
        return $this->model->select('id')
            ->where('property_id', $propertyId)->get();
    }

    /**
     * get list id by property id and date
     *
     * @param int $propertyId
     * @param array $params
     * @return mixed
     */
    public function getListIdByPropertyIdAndDate(int $propertyId, array $params)
    {
        return $this->model->select('id')
            ->where('property_id', $propertyId)
            ->contractDate($params)->get();
    }

    /**
     * calculate amount of the rent
     *
     * @param integer $id
     * @return float|int
     */
    private function calculateAmountOfTheRent(int $id)
    {
        $data = $this->getDataScoreById($id)->toArray();
        $amountForRealEstateType = $data['real_estate_type_id'] == FLAG_TWO ? round(0.01 + (0.01 / ((1 + 0.01) ** 5 - 1)), FLAG_SIX)
            : round(0.01 + (0.01 / ((1 + 0.01) ** 10 - 1)), FLAG_SIX);
        $keyMoneyMonthly = round($data['key_money'] * $amountForRealEstateType / 12, FLAG_ZERO);
        $depositMonthly = round($data['deposit'] * 0.01 / 12, FLAG_ZERO);
        return $data['contract_area'] == FLAG_ZERO ? FLAG_ZERO
            : round(($data['monthly_rent'] + $data['monthly_service'] + $keyMoneyMonthly + $depositMonthly) / round($data['contract_area'] * 0.3025, FLAG_TWO), FLAG_ZERO);
    }

    /**
     * calculate score inside the house
     *
     * @param int $propertyId
     * @param array $params
     * @return array
     */
    public function calculateScoreInsideTheHouse(int $propertyId, array $params = null)
    {
        $amountOfTheRentTotal = FLAG_ZERO;
        $count = FLAG_ZERO;
        $arrAmountOfTheRent = [];
        $datas = empty($params) ?  $this->getListIdByPropertyId($propertyId) : $this->getListIdByPropertyIdAndDate($propertyId, $params);
        foreach ($datas->toArray() as $id) {
            $amountOfTheRentTotal += $this->calculateAmountOfTheRent($id['id']);
            if ($this->calculateAmountOfTheRent($id['id']) != FLAG_ZERO) {
                $count += FLAG_ONE;
                array_push($arrAmountOfTheRent, $this->calculateAmountOfTheRent($id['id']));
            }
        }

        return [$amountOfTheRentTotal, $count, $arrAmountOfTheRent];
    }

    /**
     * array score inside the house
     *
     * @param int $propertyId
     * @param array $params
     * @return array|mixed
     */
    public function arrayScoreInsideTheHouse(int $propertyId, array $params = null)
    {
        $data = $this->calculateScoreInsideTheHouse($propertyId, $params);
        $arr = [];
        $datas = empty($params) ?  $this->getListIdByPropertyId($propertyId) : $this->getListIdByPropertyIdAndDate($propertyId, $params);
        foreach ($datas->toArray() as $id) {
            $dataRentRoll = $this->getDataScoreById($id['id'])->toArray();
            $score = empty($data[FLAG_TWO]) ? FLAG_ZERO : (statsStandardDeviation($data[FLAG_TWO]) == FLAG_ZERO ? FLAG_ZERO
                : round(($this->calculateAmountOfTheRent($id['id']) - ($data[FLAG_ZERO] / $data[FLAG_ONE])) / statsStandardDeviation($data[FLAG_TWO]) * 10 * 1.25 + 50, FLAG_ZERO));

            if ($dataRentRoll['monthly_rent'] + $dataRentRoll['monthly_service'] == FLAG_ZERO) {
                $arr[$id['id']] = FLAG_ZERO;
            } elseif ($score < MIN_SCORE_INSIDE_HOUSE) {
                $arr[$id['id']] = MIN_SCORE_INSIDE_HOUSE;
            } elseif ($score <= MAX_SCORE_INSIDE_HOUSE) {
                $arr[$id['id']] = $score;
            } else {
                $arr[$id['id']] = MAX_SCORE_INSIDE_HOUSE;
            }
        }

        return $arr;
    }

    /**
     * get data attribute by property id
     *
     * @param int $propertyId
     * @param array $conditions
     * @return mixed
     */
    public function getDataAttributeByPropertyId(int $propertyId, array $conditions = [])
    {
        return $this->model->selectRaw('sum(round(if(monthly_rent=0, 0, monthly_rent),0)) as rental_fee,
            sum(round(if(monthly_service=0, 0, monthly_service), 0))  as shared_fee,
            sum(round(if(monthly_rent+monthly_service=0, 0, (monthly_rent+monthly_service)), 0)) as total_rental')
            ->where('property_id', $propertyId)
            ->where('room_status', 'no_empty')
            ->where('real_estate_type_id', $conditions[FLAG_ZERO])
            ->contractDate($conditions[FLAG_ONE])
            ->get()->toArray();
    }

    /**
     * get data total to real estate types
     *
     * @param int $propertyId
     * @param array $params
     * @return mixed
     */
    public function getDataTotalToRealEstateTypes(int $propertyId, array $params)
    {
        return $this->model->selectRaw('sum(contract_area) as contract_area, sum(ROUND(contract_area*0.3025, 2)) as contract_area_2,  sum(monthly_rent) as monthly_rent
        , sum(monthly_service) as monthly_service, sum(deposit) as deposit, sum(deposit_monthly) as deposit_monthly
        , sum(key_money) as key_money, sum(key_money_monthly) as key_money_monthly, real_estate_type_id, room_status')
            ->where('property_id', $propertyId)
            ->whereNotNull('real_estate_type_id')
            ->contractDate($params)
            ->groupBy('real_estate_type_id', 'room_status')
            ->get()->toArray();
    }

    /**
     * set array total by real estate types
     *
     * @param int $propertyId
     * @param array $params
     * @return array
     */
    public function setArrayTotalByRealEstateTypes($propertyId, $params)
    {
        $arrTotal = [];
        for ($i = MIN_REAL_ESTATE_TYPE; $i <= MAX_REAL_ESTATE_TYPE; $i++) {
            $arrAttribute = !isset($this->getDataAttributeByPropertyId($propertyId, [$i, $params])[FLAG_ZERO]['total_rental']) ? array_fill_keys(['rental_fee', 'shared_fee', 'total_rental'], '0')
                : $this->getDataAttributeByPropertyId($propertyId, [$i, $params])[FLAG_ZERO];
            $arr = array(array_fill_keys(ATTRIBUTE_SUM_RENT_ROLL, FLAG_ZERO), array_fill_keys(ATTRIBUTE_SUM_RENT_ROLL, FLAG_ZERO), $arrAttribute);
            foreach ($this->getDataTotalToRealEstateTypes($propertyId, $params) as $key => $item) {
                if ($item['real_estate_type_id'] != $i) {
                    continue;
                }
                $item['room_status'] == 'no_empty' ? $arr[FLAG_ZERO] = $item : $arr[FLAG_ONE] = $item;
                $arrTotal[$i] = $arr;
            }
        }
        return $arrTotal;
    }

    /**
     * delete record by id
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteRecordById($id)
    {
        return $this->deleteById($id);
    }

    /**
     * Get all data
     *
     * @param integer $propertyId
     * @param array $params
     * @return mixed
     */
    public function listRentRollRoom(int $propertyId)
    {
        return $this->model->where('property_id', $propertyId)->paginate(FLAG_FIFTY);
    }

    /**
     * Get number page
     *
     * @param $propertyId
     * @param $page
     * @param $perPage
     * @return float
     */
    public function getPageNumberRedirect($propertyId, $page, $perPage)
    {
        $totalRecords = $this->where('property_id', $propertyId)->count();
        if (is_numeric($page) && $totalRecords == ($page - 1) * $perPage) {
            return ceil($totalRecords / $perPage);
        }
        return $page;
    }

    /**
     * Get data build chart
     *
     * @param $params
     * @return mixed
     */
    public function getDataBuildChart($params)
    {
        $dates  = [
            'date_year' => date("Y"),
            'date_month' => date("m")
        ];
        $listProperty = resolve(PropertyRepositoryInterface::class)->getListDataForUser($params)->pluck('id')->toArray();
        return $this->model->selectRaw("COUNT(contract_area) as `count_data`, COUNT(case when room_status = 'no_empty' then `contract_area` end) as `count_no_empty`,
        SUM(contract_area) as `sum_contract_area`, SUM(case when room_status = 'no_empty' then `contract_area` end) as `sum_contract_area_no_empty`")
            ->whereIn('property_id', $listProperty)
            ->contractDate($dates)
            ->first()->toArray();
    }
}
