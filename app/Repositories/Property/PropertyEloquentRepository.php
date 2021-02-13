<?php

namespace App\Repositories\Property;

use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\Areas\AreaRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\IndexFormulas\IndexFormulasRepositoryInterface;
use App\Repositories\PortfolioAnalysis\PortfolioAnalysisRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyEloquentRepository;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use App\Repositories\TaxProperty\TaxPropertyRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class PropertyEloquentRepository extends BaseRepository implements PropertyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Property::class;
    }

    /**
     * Function get all data list house
     *
     * @param $params
     * @return mixed
     */
    public function getListData($params)
    {
        $user = Auth::user();
        return $this->model
            ->with('detailRealEstateType', 'realEstateType', 'buildingRight', 'landRight', 'houseMaterial', 'houseRoofType', 'typeRental', 'rentRolls', 'monthlyBalances')
            ->with(['subUserProperty' => function ($query) {
                return $query->with('profileUser')->whereIn('permission', ARRAY_EDIT_PERMISSION);
            }])
            ->when(!empty($params['subuser_id']), function ($query) use ($params) {
                return $query->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyEditForUser($params['subuser_id']), true);
            })
            ->when(empty($params['subuser_id']), function ($query) use ($user) {
                return $query->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyForUser($user->id), $user->isSubUser())
                    ->mainUser($user->id, !$user->isSubUser());
            })
            ->when(isset($params['proprietor']), function ($query) use ($params) {
                return $params['proprietor'] == 'ー' ? $query->where('proprietor', null) : $query->where('proprietor', $params['proprietor']);
            })
            ->orderBy('id', 'asc');
    }

    /**
     * get list property name by user id
     *
     * @param int $userId
     * @param null $propertyId
     * @return mixed
     */
    public function getListNameByUserId($userId, $propertyId = null)
    {
        return $this->model->where('user_id', $userId)
                    ->when($propertyId, function ($q) use ($propertyId) {
                        return $q->where('id', '<>', $propertyId);
                    })
                    ->get(['id', 'house_name'])
                    ->toArray();
    }

    /**
     * Get list data after convert
     *
     * @param $params
     * @return array
     */
    public function getListDataAfterConvert($params)
    {
        return $this->convertDataListHouse($this->getListData($params)->paginate(LIMIT_RECORD_LIST_HOUSE_DEFAULT));
    }

    /**
     * Get data by condition
     *
     * @param array $condition
     *
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListDataAnalysis($condition)
    {
        $user = Auth::user();
        try {
            return $this->model
                ->with('portfolioAnalysis', 'detailRealEstateType.realEstateTypes')
                ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($user->id), $user->isSubUser())
                ->mainUser($user->id, !$user->isSubUser())
                ->whereIn('status', $condition['status'])
                ->when(isset($condition['proprietor']), function ($query) use ($condition) {
                    return $condition['proprietor'] == 'ー' ? $query->where('proprietor', null) : $query->where('proprietor', $condition['proprietor']);
                })
                ->orderBy('order', 'asc')
                ->paginate($condition['option_paginate']);
        } catch (Exception $e) {
            report($e);
            return [];
        }
    }

    /**
     * Get list data for User
     *
     * @param $condition
     * @return array
     */
    public function getListDataForUser($condition)
    {
        $user = Auth::user();
        try {
            return $this->model
                ->select('id')
                ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($user->id), $user->isSubUser())
                ->mainUser($user->id, !$user->isSubUser())
                ->whereIn('status', $condition['status'])
                ->paginate($condition['option_paginate']);
        } catch (Exception $e) {
            report($e);
            return [];
        }
    }

    /**
     * function convert data list house
     *
     * @param array $listData
     * @return array
     */
    public function convertDataListHouse($listData)
    {
        foreach ($listData as $data) {
            $data->amount_paid_annually = countAmountPaidAnnually($data->loan, $data->contract_loan_period, $data->interest_rate);
            $data->cost_ratio = divisionNumber($data->total_cost, $data->total_revenue) * 100;
            $data->dscr = divisionNumber(round($data->operating_revenue_expenditure), round($data->amount_paid_annually)) * 100;
            $data->surface_yield = divisionNumber($data->total_revenue, $data->money_receive_house) * 100;
            $data->noi_yield = divisionNumber($data->operating_revenue_expenditure, $data->money_receive_house) * 100;
            if (empty($data->loan) || empty($data->contract_loan_period) || empty($data->loan_date)) {
                $data->debt_balance = 0;
            } else {
                $data->debt_balance = $data->loan - (divisionNumber($data->loan, ($data->contract_loan_period * 12)) * getMonthDifferenceNow($data->loan_date));
            }
            $data->floor_rate_for_rent = divisionNumber($data->area_may_rent, $data->total_area_floors) * 100;
        }

        return $listData;
    }

    /**
     * function convert data house
     *
     * @param mixed $data
     * @return mixed
     */
    public function convertData($data)
    {
        $data->amount_paid_annually = countAmountPaidAnnually($data->loan, $data->contract_loan_period, $data->interest_rate);
        $data->cost_ratio = divisionNumber($data->total_cost, $data->total_revenue) * 100;
        $data->dscr = divisionNumber(round($data->operating_revenue_expenditure), round($data->amount_paid_annually)) * 100;
        $data->surface_yield = divisionNumber($data->total_revenue, $data->money_receive_house) * 100;
        $data->noi_yield = divisionNumber($data->operating_revenue_expenditure, $data->money_receive_house) * 100;
        if (empty($data->loan) || empty($data->contract_loan_period) || empty($data->loan_date)) {
            $data->debt_balance = 0;
        } else {
            $data->debt_balance = $data->loan - (divisionNumber($data->loan, ($data->contract_loan_period * 12)) * getMonthDifferenceNow($data->loan_date));
        }
        $data->floor_rate_for_rent = divisionNumber($data->area_may_rent, $data->total_area_floors) * 100;

        return $data;
    }

    /**
     * get list by conditions
     *
     * @param null $propertyId
     * @return mixed
     */
    public function getListByConditions($propertyId = null)
    {
        $user = Auth::user();
        $conditions = [] ;
        if ($propertyId != null) {
            array_push(
                $conditions,
                ['id', '<>', $propertyId ]
            );
        }

        return $this->model
            ->mainUser($user->id, !$user->isSubUser())
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyEditForUser($user->id), $user->isSubUser())
            ->where($conditions)
            ->with('detailRealEstateType.realEstateTypes', 'houseMaterial', 'buildingRight', 'landRight', 'houseRoofType', 'typeRental')
            ->get()
            ->toArray();
    }

    /**
     * get page number
     *
     * @param int $propertyId
     * @param int $recordInOnePage
     * @return int
     */
    public function getPageNumber(int $propertyId, int $recordInOnePage)
    {
        $user = Auth::user();
        $data = $this->model
            ->mainUser($user->id, !$user->isSubUser())
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyForUser($user->id), $user->isSubUser())
            ->pluck('id')->toArray();

        if (!$data || !in_array($propertyId, $data)) {
            return FLAG_ZERO;
        }

        return intval(ceil((array_search($propertyId, $data) + FLAG_ONE)  / $recordInOnePage));
    }

    /**
     * get page number after delete
     * @param $perPage
     * @param $page
     * @return int
     */
    public function getPageNumberRedirect($perPage, $page): int
    {
        if ($this->getListData()->get()->count() == ($page - FLAG_ONE) * $perPage) {
            return $page - FLAG_ONE;
        }
        return $page;
    }

    /**
     * get value record last property id
     *
     * @param int $userId
     * @return mixed
     */
    private function getLastPropertyCode($userId)
    {
        return $this->model->select('property_code')
                        ->where('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->when(true, function ($query) {
                            $query->withTrashed();
                        })
                        ->first();
    }

    /**
     * get value record last order
     *
     * @param int $userId
     * @return mixed
     */
    private function getLastOrder($userId)
    {
        return $this->model->select('order')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * convert property id format string to int
     *
     * @param string $userCode
     * @return int|string
     */
    private function convertPropertyCode($userCode)
    {
        do {
            $propertyCode = $userCode . '-' . str_pad(rand(MIN_PROPERTY_CODE, MAX_PROPERTY_CODE), FLAG_FIVE, '0', STR_PAD_LEFT);
        } while ($this->checkPropertyCode($propertyCode));
        return $propertyCode;
    }

    /**
     * Check property code
     *
     * @param $propertyCode
     * @return bool
     */
    public function checkPropertyCode($propertyCode)
    {
        if (count($this->model->withTrashed()->where('property_code', $propertyCode)->get()->toArray()) == FLAG_ZERO) {
            return false;
        }
        return true;
    }

    /**
     * save property
     *
     * @param PropertyRequest $request
     * @param int $userId
     * @param string $userCode
     * @return bool
     */
    public function saveData(PropertyRequest $request, $userId, $userCode)
    {
        $propertyCode = $this->convertPropertyCode($userCode['user_code']);
        $order = $this->getLastOrder($userId);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['user_id'] = $userId;
            $data['order'] = $order['order'] + 1;
            $data['property_code'] = $propertyCode;
            $data['rental_percentage'] = preg_replace('[%]', '', $data['rental_percentage']);
            if (isset($data['avatar_url'])) {
                $img = new UploadedFile(storage_path('/app/public/images/' . $data['avatar_url']), 'name');
            } else {
                $img = $request->file('avatar');
            }
            if ($img) {
                $imageName = saveImageInFolder($img, FOLDER_IMAGES_PROPERTY);
                $data['avatar'] = $imageName['avatar'];
                $data['avatar_thumbnail'] = $imageName['avatar_thumbnail'];
            } else {
                unset($data['avatar']);
                unset($data['avatar_thumbnail']);
            }
            if ($data['address_district'] == 'null') {
                $data['address_district'] = null ;
            }
            $this->setScoreMap($data);
            $property = $this->create($data);
            resolve(AnnualPerformanceRepositoryInterface::class)->createRecordByNewProperty($property);
            if (Auth::user()->isSubUser()) {
                resolve(SubUserPropertyRepositoryInterface::class)->create([
                    'user_id' => Auth::user()->id,
                    'property_id' => $property->id,
                    'permission' => VIEW_EDIT_DELETE_REPORT_PERMISSION
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * delete house of user
     *
     * @param int $id Property ID
     * @return bool|void
     */
    public function deleteByIdOfUser($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->model->where('id', $id)->first();
            if (empty($result)) {
                return false;
            } else {
                removeImagesInFolder('/public/' . FOLDER_IMAGES_PROPERTY, $result->avatar);
                $result->delete();
                $result->subUser()->detach();
                DB::commit();
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return false;
        }
    }

    /**
     * function git data by id of user login
     *
     * @param int $id
     * @param int $userId
     * @return array|mixed
     */
    public function getDataByIdOfUser($id, $userId)
    {
        try {
            return $this->model->where('id', $id)->where('user_id', $userId)->first();
        } catch (Exception $e) {
            report($e);
            return [];
        }
    }

    /**
     * Get data property with id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function getObjectPropertyById($propertyId)
    {
        $data = $this->model
            ->competeChart()
            ->where('id', $propertyId)
            ->with(
                'detailRealEstateType',
                'realEstateType',
                'houseMaterial',
                'buildingRight',
                'landRight',
                'houseRoofType',
                'typeRental'
            )
            ->first();
        if (!$data) {
            return null;
        }
        $data = $data->toArray();
        $data['years_passed'] = empty($data['loan_date']) ? 0 : getNumberYearPassed($data['loan_date']);
        return $data;
    }

    /**
     * Update data property
     *
     * @param integer|Property $property
     * @param array $data
     *
     * @return bool|mixed
     */
    public function updateRecord($property, array $data)
    {
        try {
            if (isset($data['avatar_url'])) {
                $img = new UploadedFile(storage_path('/app/public/images/' . $data['avatar_url']), 'name');
            } else {
                $img = isset($data['avatar']) ? $data['avatar'] : false;
            }
            if ($img) {
                removeImagesInFolder('/public/' . FOLDER_IMAGES_PROPERTY, $property->avatar);
                $imageName = saveImageInFolder($img, FOLDER_IMAGES_PROPERTY);
                $data['avatar'] = $imageName['avatar'];
                $data['avatar_thumbnail'] = $imageName['avatar_thumbnail'];
            } else {
                unset($data['avatar']);
                unset($data['avatar_thumbnail']);
            }
            if ($data['address_district'] == 'null') {
                $data['address_district'] = null ;
            }
            $this->setScoreMap($data);
            return $this->update($property->id, $data);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return false;
        }
    }

    /**
     * Set score map
     *
     * @param $data
     */
    public function setScoreMap(&$data)
    {
        $data['region_acreage_year'] = [
            resolve(AreaRepositoryInterface::class)->getRegionAcreageYearForSave($data),
            getValueByListLimited($data['real_estate_type_id'], $data['total_area_floors']),
            getYearByListLimited($data['real_estate_type_id'], getNumberYearPassed($data['construction_time']))
        ];
        $dataMediumStandardDeviation = resolve(IndexFormulasRepositoryInterface::class)->getMediumAndStandardDeviation($data);
        if (!$dataMediumStandardDeviation) {
            $data['synthetic_point'] = 0;
        } else {
            $data['synthetic_point'] = $this->calculateScoreMap($data['operating_expenses'], $data['total_area_floors'], $dataMediumStandardDeviation->where('formula', FLAG_SEVEN)->first());
        }
    }

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
     *  count record property
     *
     * @return mixed
     */
    public function countRecord()
    {
        $user = Auth::user();
        return $this->model->select('user_id')
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyForUser($user->id), $user->isSubUser())
            ->mainUser($user->id, !$user->isSubUser())
            ->count();
    }

    /**
     * Function get all data list house
     *
     * @param int $id
     * @return array
     */
    public function getListByCondition($id)
    {
        try {
            $data = $this->model
                ->with('detailRealEstateType.realEstateTypes', 'portfolioAnalysis')
                ->where('user_id', $id)->orderBy('order', 'asc')->get();
            return $this->convertDataListHouse($data);
        } catch (Exception $e) {
            report($e);
            return [];
        }
    }

    /**
     * update order property
     *
     * @param array $params
     * @return bool
     */
    public function updateOrder($params)
    {
        try {
            foreach ($params as $value) {
                $property = $this->model->find($value['id']);
                $data['order'] = $value['order'];
                $property->update($data);
            }
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);

            return false;
        }
    }

    /**
     * function get list data borrowing
     *
     * @param array $param
     * @return mixed
     */
    public function getListDataBorrowing($param)
    {
        $user = Auth::user();
        return $this->model->with('detailRealEstateType', 'realEstateType', 'portfolioAnalysis')
            ->when(!empty($param), function ($query) use ($param) {
                $query->whereIn('status', $this->convertParamBorrowing($param));
            })
            ->when(isset($param['proprietor']), function ($query) use ($param) {
                return $param['proprietor'] == 'ー' ? $query->where('proprietor', null) : $query->where('proprietor', $param['proprietor']);
            })
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($user->id), $user->isSubUser())
            ->mainUser($user->id, !$user->isSubUser())
            ->orderBy('order', 'asc')
            ->paginate(isset($param['paginate']) ? $param['paginate'] : LIMIT_RECORD_DEFAULT);
    }

    /**
     * function convert param
     *
     * @param  array $param
     * @return array
     */
    public function convertParamBorrowing($param)
    {
        $array = array();

        if (isset($param['owning']) && $param['owning'] = OWNING) {
            array_push($array, OWNING);
        }

        if (isset($param['sold']) && $param['sold'] = SOLD) {
            array_push($array, SOLD);
        }

        if (isset($param['negotiating']) && $param['negotiating'] = NEGOTIATING) {
            array_push($array, NEGOTIATING);
        }

        if (isset($param['negotiated']) && $param['negotiated'] = NEGOTIATED) {
            array_push($array, NEGOTIATED);
        }

        return $array;
    }

    /**
     * function get all data borrowing
     *
     * @return mixed
     */
    public function getAllDataBorrowing()
    {
        $userId = Auth::user()->id;
        return $this->model->with('detailRealEstateType.realEstateTypes', 'portfolioAnalysis')
            ->where('user_id', $userId)->orderBy('order', 'asc')->get();
    }

    /**
     * Function get data chart borrowing
     *
     * @param null $listId
     * @return mixed
     */
    public function getDataChartBorrowing($listId = null)
    {
        $user = Auth::user();
        $data = $this->model
            ->select('loan_date', 'loan', 'interest_rate', 'contract_loan_period', 'total_revenue', 'total_cost')
            ->when(isset($listId), function ($query) use ($listId) {
                return $query->whereIn('id', $listId);
            })
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($user->id), $user->isSubUser())
            ->mainUser($user->id, !$user->isSubUser())
            ->get();
        foreach ($data as $subData) {
            empty($subData->loan_date) ? $subData->years_passed = 0 : $subData->years_passed = getNumberYearPassed($subData->loan_date);
        }
        return $data;
    }

    /**
     * Get data scatter chart
     *
     * @return array|void
     */
    public function getDataScatterChart()
    {
//        $dataRecords = $this->model->get()->toArray();
        return [
            [
                [300, 4.54],
                [639, 0.91],
                [2288, 14.83],
                [290, 1.73],
                [1000, 1.04],
                [3284, 3.14],
                [1416, 1.12],
                [1469, 0.61],
                [1603, 2.33],
                [580, 0.9],
                [224, 1.25],
                [3284, 3.14],
                [939, 2.84],
                [858, 1.07],
                [1016, 1.6],
                [430, 0.76],
                [1050, 1.56],
                [1078, 3.26],
                [740, 1.03],
                [3316, 3.25],
                [2962, 38.4],
                [1042, 0.9],
                [1251, 1.26],
                [51, 0],
                [1560, 0.99],
                [397, 0.69],
                [5455, 2.61],
                [463, 1.12],
                [640, 0.95],
                [750, 1.05],
                [10662, 2.98],
                [729, 1],
                [692, 1.14],
                [2125, 2.2],
                [1070, 1.52],
            ],
            [
                [1113, 1.97],
                [1002, 3.64],
                [557, 0.65],
                [226, 2.74],
                [800, 1.04],
                [700, 1.24],
                [960, 0.97],
                [1656, 1.07],
                [900, 0.88],
                [467, 0.47],
                [372, 2.7],
                [697, 1.23],
                [1244, 1.64],
                [700, 0.89],
                [1199, 0.84],
                [521, 0.79],
                [560, 0.62],
                [484, 2.7],
                [210, 0.81],
                [738, 1.05],
                [250, 0.29],
                [520, 0.71],
                [821, 0.5],
                [880, 0.58],
                [960, 0.85],
                [386, 0],
                [1500, 2.09],
                [429, 3.05],
                [226, 2.93],
                [1413, 1.05],
                [280, 0.75],
                [327, 1.45],
                [989, 1.06],
                [4010, 3.03],
                [329, 1.48],
                [148, 0],
                [303, 0.92],
                [581, 3.1],
                [556, 0.63],
                [572, 3.4],
                [674, 2.13],
                [701, 1.04],
                [428, 2.73],
                [450, 0.65],
                [731, 0.7],
                [504, 1.05],
                [1113, 1.97],
                [364, 0],
                [138, 1.79],
                [450, 0.65],
                [1000, 1.37],
                [977, 1.39],
                [550, 1.02],
                [632, 1.18],
                [226, 2.93],
                [250, 3.36],
                [672, 0.5],
                [601, 0.77],
                [450, 0.69],
                [800, 1.49],
                [357, 2.54],
                [312, 0.91],
                [249, 1.01],
                [118, 1.59],
                [714, 1],
                [1154, 1.82],
                [260, 3.93],
                [960, 1.24],
                [590, 0.52],
                [331, 1.41],
                [34, 0],
                [600, 1.01],
                [456, 0.33],
                [251, 0.83],
                [755, 1.25],
                [700, 1.1],
                [600, 0.97],
                [800, 1.12],
                [1002, 1.58],
                [211, 3.64],
                [900, 0.84],
                [151, 1.19],
                [139, 0],
                [384, 2.11],
                [500, 9.07],
                [433, 2.46],
                [412, 0.81],
                [950, 1.77],
                [971, 0.69],
                [721, 1.28],
                [400, 0.76],
                [601, 1.25],
                [700, 0.75],
                [826, 3.75],
                [714, 1.3],
                [638, 0.95],
                [1278, 0.79],
                [664, 1.03],
                [720, 1.19],
                [624, 1.1],
                [159, 0.64],
                [600, 1.45],
                [756, 0.72],
                [404, 3.05],
                [567, 2.71],
                [36, 0],
                [400, 0.73],
                [225, 1.22],
                [378, 0.61],
                [209, 2.17],
                [546, 3.48],
                [302, 3.14],
                [198, 0.42],
                [165, 1.81],
                [413, 1.9],
                [389, 2.17],
                [585, 1.93],
                [410, 1.88],
                [739, 2.44],
                [929, 1.53],
                [883, 1.39],
                [993, 1.34],
                [447, 0.74],
                [1063, 1.17],
                [297, 2.07],
                [480, 1.06],
                [150, 1.09],
                [325, 0.81],
                [381, 0.56],
                [348, 0.65],
                [463, 1.08],
                [720, 1.07],
                [600, 0.87],
                [300, 0.53],
                [1016, 1.6],
                [1024, 1.81],
                [467, 2.39],
                [555, 2.52],
                [2016, 0.99],
                [1046, 0.9],
                [625, 2.47],
                [596, 3.67],
                [266, 0.44],
                [1158, 1.43],
                [501, 1.17],
                [291, 0.66],
                [167, 0],
                [1913, 1.39],
                [0, 0],
                [319, 0.77],
                [876, 1.2],
                [1983, 2.32],
                [468, 0.53],
                [731, 0.72],
                [480, 1.09],
                [294, 2.32],
                [381, 0.56],
                [430, 2.84],
                [1154, 1.13],
                [734, 3.14],
                [1046, 0.9],
                [1120, 1.1],
                [112, 0],
                [290, 1.57],
                [935, 1.39],
                [493, 0.7],
                [631, 2.69],
                [254, 0],
                [1350, 1.69],
                [799, 1],
                [348, 0.54],
                [347, 3.6],
                [1066, 1.89],
                [112, 0.49],
                [801, 1.26],
                [332, 0],
                [300, 0.38],
                [800, 1.57],
                [2158, 2.24],
                [130, 1.39],
                [295, 2.23],
                [209, 0.99],
                [950, 1.77],
                [900, 1.15],
                [467, 0.57],
                [195, 2.14],
                [664, 1.03],
                [1535, 2.06],
                [1905, 1.73],
                [611, 1.48],
                [250, 3.49],
                [333, 2.01],
                [899, 0.91],
                [452, 0.67],
                [611, 0.6],
                [768, 0.95],
                [398, 0],
                [530, 3.15],
                [733, 1.48],
                [620, 0.56],
                [422, 6.38],
                [343, 3.37],
                [305, 1.63],
                [305, 1.06],
                [291, 0.62],
                [1417, 1.51],
                [2000, 1.77],
                [263, 1.91],
                [213, 0.59],
                [438, 0.91],
                [641, 0.99],
                [842, 2.78],
                [222, 0.57],
                [300, 0.81],
                [700, 0.96],
                [750, 1.11],
                [600, 1.5],
                [1098, 2.75],
                [1075, 1.56],
                [372, 0.57],
                [729, 1.06],
                [535, 2.52],
                [1148, 0.95],
                [291, 0.51],
                [500, 0.77],
                [925, 1.22],
                [1284, 1.17],
                [324, 3.36],
                [386, 1.92],
                [989, 1.31],
                [643, 2.03],
                [365, 1.35],
                [609, 0.98],
                [1417, 1.51],
                [359, 0.59],
                [381, 0.56],
                [87, 0.52],
                [773, 0.62],
                [548, 0.6],
                [368, 2.62],
                [454, 1.37],
                [250, 1.49],
                [949, 0.88],
                [700, 0.79],
                [550, 0.77],
                [892, 0.51],
                [818, 1.35],
                [550, 0.45],
                [830, 0.89],
                [755, 1.3],
                [551, 3.45],
                [291, 0.66],
                [783, 0.81],
                [549, 0.87],
                [548, 0.47],
                [492, 2.18],
                [200, 1.19],
                [619, 0.83],
                [1954, 1.24],
                [1002, 0.64],
                [680, 0.87],
                [435, 1.58],
                [880, 1.39],
                [2552, 4.75],
                [660, 1.06],
                [167, 0],
                [639, 2.44],
                [980, 1.45],
                [2141, 6.22],
                [200, 0.56],
                [339, 2.02],
                [638, 3.31],
                [693, 0.87],
                [1377, 1.32],
                [737, 1.09],
                [658, 0.63],
                [569, 2.55],
                [636, 1.1],
                [416, 1.68],
                [1082, 1.12],
                [770, 0.82],
                [464, 0.91],
                [231, 1.12],
                [450, 1.79],
                [236, 3.3],
                [580, 0.9],
                [1122, 1.07],
                [1830, 0],
                [355, 1.03],
                [485, 0.5],
                [304, 2.76],
                [71, 0],
                [371, 0.51],
                [133, 3.7],
                [250, 0.59],
                [400, 1.86],
                [462, 2.66],
                [380, 0.95],
                [46, 0.92],
                [584, 1.28],
                [651, 1.28],
                [434, 0.56],
                [801, 0.81],
                [473, 0.95],
                [919, 1.48],
                [831, 1.1],
                [1100, 1.25],
                [194, 1.56],
                [462, 0.88],
                [513, 3.1],
                [640, 1.11],
                [743, 0.79],
                [1055, 0.96],
                [335, 3.48],
                [664, 2.01],
                [2000, 1.73],
                [837, 0.54],
                [255, 0.56],
                [235, 1.78],
                [474, 2.42],
                [228, 0],
                [2856, 14.01],
                [251, 1.47],
                [421, 0.69],
                [448, 2.43],
                [250, 0],
                [481, 2.61],
                [561, 0.99],
                [229, 0.54],
                [314, 0.48],
                [790, 0.82],
                [325, 4.92],
                [434, 2.35],
                [1408, 1.35],
                [321, 0.54],
                [1277, 1.5],
                [46, 0.34],
                [462, 2.66],
                [380, 0.95],
                [807, 1.09],
                [1075, 1.47],
                [2200, 1.33],
                [236, 1.22],
                [1464, 1.08],
                [255, 1.93],
                [152, 2.12],
                [73, 0],
                [840, 0.69],
                [368, 0.36],
                [278, 1.38],
                [914, 1.07],
            ],
            [
                [3274, 1.92],
                [8194, 5.22],
                [2584, 1.04],
                [697, 1.74],
                [711, 0.83],
                [645, 2.55],
                [450, 0.93],
                [986, 4.71],
                [3192, 4.46],
                [1173, 0.95],
                [2489, 1.84],
                [1443, 1.59],
                [840, 1.42],
                [2016, 0.88],
                [8194, 5.41],
                [706, 1.31],
                [804, 0.79],
                [140, 0],
                [1208, 0.93],
                [200, 0],
                [1339, 0.67],
                [982, 0.77],
                [840, 0.66],
                [2016, 0.94],
                [999, 1.13],
                [1554, 2.05],
                [2016, 0.94],
                [551, 8.33],
                [461, 1.39],
                [505, 0.76],
                [902, 3.99],
                [2230, 3.17],
                [2016, 0.88],
                [600, 0.75],
                [312, 0.61],
                [1289, 1.42],
                [1347, 3.06],
                [2400, 2.23],
                [68, 0],
                [951, 1.28],
                [7938, 2.29],
                [660, 1.17],
                [3036, 2.2],
                [545, 0.69],
                [1277, 2.11],
                [2016, 0.99],
                [7938, 2.29],
                [300, 3.3],
                [1250, 1.85],
                [570, 0.96],
                [2265, 1.42],
                [1698, 6.42],
                [2479, 2.09],
                [239, 2.71],
                [900, 1.52],
                [2834, 1.81],
                [1446, 1.17],
                [1060, 3.97],
                [2325, 1.06],
                [1895, 1.21],
                [784, 0.84],
                [1837, 2.47],
                [1002, 1.4],
                [2894, 6.78],
                [951, 0.88],
                [3736, 1.51],
                [2098, 1.59],
                [971, 1.22],
                [411, 1.3],
                [820, 1.14],
                [2139, 2.77],
                [642, 1.46],
                [1004, 0.98],
                [1212, 1.07],
                [971, 1.22],
                [1513, 3.05],
                [1107, 0.53],
                [868, 1.09],
                [1239, 1.8],
            ],
            [
                [737, 0.64],
                [599, 0.99],
                [1374, 1.66],
                [661, 1.78],
                [380, 0],
                [1339, 2.21],
            ],
            [
                [616, 0.8],
                [1250, 1.62],
                [231, 1.68],
                [471, 0.7],
                [1046, 0.97],
                [641, 0.99],
                [1459, 2.16],
                [451, 0.68],
                [200, 0.82],
                [701, 0.94],
                [480, 0.7],
                [333, 0.73],
                [1327, 1.85],
                [1102, 1.25],
                [529, 0.94],
                [622, 2.05],
                [1195, 3.94],
                [1459, 2.16],
                [1233, 1.32],
                [1826, 1.14],
                [1451, 1.85],
                [1900, 1.92],
                [114, 0],
                [835, 0.87],
                [1202, 1.41],
                [529, 0.85],
                [2690, 1.99],
                [1451, 1.85],
                [712, 1.72],
                [42, 0],
                [1826, 1.14],
                [468, 0.47],
                [600, 1.45],
                [496, 1.98],
                [610, 1.34],
                [729, 0.98],
                [1923, 1.22],
                [653, 1.22],
                [464, 2.13],
                [960, 1.06],
                [1826, 1.89],
                [507, 0.86],
                [1100, 1.95],
                [1718, 2.83],
                [7256, 17.56],
                [470, 0.92],
                [721, 1.07],
                [900, 1.02],
                [900, 1.52],
                [1202, 1.18],
            ]
        ];
//        if (empty($dataRecords)) {
//            return $dataReturns;
//        }
//        return $this->getDataSeries($dataRecords, $dataReturns);
    }

    /**
     * Get data series
     *
     * @param $dataRecords
     * @param $dataReturns
     * @return mixed
     */
    public function getDataSeries($dataRecords, $dataReturns)
    {
        foreach ($dataRecords as $item) {
            switch ($item['real_estate_type_id']) {
                case FLAG_ONE:
                    $this->calculateDistribution($item, $dataReturns[0]);
                    break;
                case FLAG_TWO:
                    $this->calculateDistribution($item, $dataReturns[1]);
                    break;
                case FLAG_THREE:
                    $this->calculateDistribution($item, $dataReturns[2]);
                    break;
                case FLAG_FOUR:
                case FLAG_SEVEN:
                case FLAG_EIGHT:
                    $this->calculateDistribution($item, $dataReturns[3]);
                    break;
                case FLAG_FIVE:
                case FLAG_SIX:
                    $this->calculateDistribution($item, $dataReturns[4]);
                    break;
                default:
                    break;
            }
        }
        return $dataReturns;
    }

    /**
     *  Calculate distribution
     *
     * @param array $data
     * @param array $arrayContain
     */
    public function calculateDistribution($data, &$arrayContain)
    {
        if ($data['area_rent'] != FLAG_ZERO) {
            $coordinatesX = round(divisionNumber($data['land_rental_fee'], $data['area_rent']) / 12 / 0.3025, FLAG_TWO);
            $coordinatesY = round(divisionNumber($data['land_rental_fee'], $data['area_rent']), FLAG_TWO);
            array_push($arrayContain, [$coordinatesX, $coordinatesY]);
        }
    }

    /**
     * Get all data by UserId
     *
     * @param integer $userId
     * @return mixed|null
     */
    public function getAllDataByUserId($userId)
    {
        $data = $this->model->where('user_id', $userId)->get();
        if ($data) {
            return $data;
        }
        return null;
    }

    /**
     * Get list property reports
     *
     * @param integer $userId User current Id
     * @param integer $perPage Option paginate
     * @param array $request params search
     *
     * @return mixed
     */
    public function getListReports($userId, $perPage, $request)
    {
        return $this->model
            ->mainUser($userId, !Auth::user()->isSubuser())
            ->select(['id', 'status', 'house_name', 'proprietor', 'date_month_registration_revenue', 'updated_at'])
            ->with([
                'generalInfo:property_id,updated_at',
                'businessPlan:property_id,updated_at',
                'simpleAssessment:property_id,updated_at',
                'rentRolls:property_id,contract_start_date',
                'monthlyBalances:property_id,date_year_registration',
                'annualPerformances:property_id,year',
                'repairHistory' => function ($query) {
                    return $query->select('property_id', 'updated_at')->orderBy('updated_at');
                },
//                'annualPerformances' => function ($query) {
//                    return $query->select('property_id', 'year')->orderBy('year', 'desc');
//                }
            ])
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($userId), Auth::user()->isSubuser())
            ->whereIn('status', $request['status'])
            ->when(isset($request['proprietor']), function ($query) use ($request) {
                if ($request['proprietor'] == 'ー') {
                    return $query->where('proprietor', null);
                }
                return $query->where('proprietor', $request['proprietor']);
            })
            ->simplePaginate($perPage);
    }

    /**
     * Count record property for user
     *
     * @param integer $userId
     *
     * @return mixed
     */
    public function countDataForUser($userId)
    {
        return $this->model
            ->mainUser($userId, !Auth::user()->isSubuser())
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($userId), Auth::user()->isSubuser())
            ->get()->count();
    }

    /**
     * Get list proprietor reports
     *
     * @param $userId
     * @return mixed
     */
    public function getListProprietorsByUserId($userId)
    {
        return $this->model->select('proprietor')
            ->mainUser($userId, !Auth::user()->isSubuser())
            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($userId), Auth::user()->isSubuser())
            ->groupBy('proprietor')->get();
    }

    /**
     * Get data property and simpleAssessment with property_id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function getObjectPropertyAndSimpleAssessmentById($propertyId)
    {
        $data = $this->model->where('id', $propertyId)
            ->with('detailRealEstateType', 'realEstateType', 'houseMaterial', 'buildingRight', 'landRight', 'houseRoofType', 'typeRental', 'simpleAssessment')
            ->first();
        if ($data) {
            $data = $data->toArray();
            $data['years_passed'] = empty($data['loan_date']) ? 0 : getNumberYearPassed($data['loan_date']);
            return $data;
        }

        return [];
    }

    /**
     *  count record property
     *
     * @param int $userId
     * @param int $propertyId
     * @return mixed
     */
    public function countRecordToPropertyId($userId, $propertyId)
    {
        return $this->model->select('user_id')
            ->where('user_id', $userId)
            ->where('id', '<=', $propertyId)
            ->count();
    }

    /**
     * get data relationship with annual performances table
     *
     * @param $params
     * @return Collection
     */
    public function getDataCreateTax($params = [])
    {
        $user = Auth::user();
        return DB::table('property')->join('annual_performances', 'property.id', 'annual_performances.property_id')
            ->select('property.id', 'property.house_name', 'property.proprietor')
            ->distinct()
            ->when($user->isMainUser(), function ($query) use ($user) {
                return $query->where('property.user_id', $user->id);
            })
            ->when($user->isSubUser(), function ($query) use ($user) {
                $listPropertyId = resolve(SubUserPropertyRepositoryInterface::class)->getListPropertyPermission(
                    $user->id,
                    [VIEW_REPORT_PERMISSION, VIEW_EDIT_REPORT_PERMISSION, VIEW_DELETE_REPORT_PERMISSION, VIEW_EDIT_DELETE_REPORT_PERMISSION]
                );
                return $query->whereIn('property.id', $listPropertyId);
            })
            ->where('annual_performances.year', empty($params['year']) ? date('Y') : $params['year'])
            ->where('property.date_month_registration_revenue', empty($params['month']) ? date('m') : $params['month'])
            ->when(isset($params['proprietor']), function ($query) use ($params) {
                return $query->where('proprietor', 'like', $params['proprietor']);
            })
            ->where('property.deleted_at', null)
            ->where('annual_performances.deleted_at', null)
            ->get();
    }

    /**
     * Get data proprietor
     *
     * @param $userId
     * @param null $year
     * @param null $month
     * @return Collection
     */
    public function getDataProprietor($userId, $year = null, $month = null)
    {
        return DB::table('property')->join('annual_performances', 'property.id', 'annual_performances.property_id')
            ->where('property.user_id', $userId)
            ->where('annual_performances.year', empty($year) ? date('Y') : $year)
            ->where('property.date_month_registration_revenue', empty($month) ? date('m') : $month)
            ->where('property.deleted_at', null)
            ->where('property.proprietor', '<>', null)
            ->where('annual_performances.deleted_at', null)
            ->select('property.proprietor')
            ->groupBy('property.proprietor')
            ->get();
    }

    /**
     * function custom get data house of user
     *
     * @param int $userId
     * @param null $select
     * @return bool
     */
    public function getAllHouseOfUser($userId, $select = null)
    {
        try {
            if ($select == null) {
                return $this->model->where('user_id', $userId)
                    ->get();
            } else {
                return $this->model->where('user_id', $userId)
                    ->select($select)
                    ->get();
            }
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * function get data Example
     *
     * @param array $data
     * @param int $year
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getDataExample($data, $year)
    {
        try {
            $result = DB::table('property')->join('annual_performances', 'property.id', 'annual_performances.property_id')
                ->select(
                    DB::raw('SUM(annual_performances.revenue_land_taxes) as total_revenue_land_taxes'),
                    DB::raw('SUM(annual_performances.rent_income) as total_rent_income'),
                    DB::raw('SUM(annual_performances.general_services) as total_general_services'),
                    DB::raw('SUM(annual_performances.income_input_money) as total_income_input_money'),
                    DB::raw('SUM(annual_performances.income_update_house_contract) as total_income_update_house_contract'),
                    DB::raw('SUM(annual_performances.utilities_revenue) as total_utilities_revenue'),
                    DB::raw('SUM(annual_performances.parking_revenue) as total_parking_revenue'),
                    DB::raw('SUM(annual_performances.other_income) as total_other_income'),
                    DB::raw('SUM(annual_performances.taxes_dues) as total_taxes_dues'),
                    DB::raw('SUM(annual_performances.insurance_premium) as total_insurance_premium'),
                    DB::raw('SUM(annual_performances.repair_fee) as total_repair_fee'),
                    DB::raw('SUM(annual_performances.intact_reply_fee) as total_intact_reply_fee'),
                    DB::raw('SUM(annual_performances.land_tax) as total_land_tax'),
                    DB::raw('SUM(annual_performances.management_fee) as total_management_fee'),
                    DB::raw('SUM(annual_performances.utilities_fee) as total_utilities_fee'),
                    DB::raw('SUM(annual_performances.asset_management_fee) as total_asset_management_fee'),
                    DB::raw('SUM(annual_performances.tenant_recruitment_fee) as total_tenant_recruitment_fee'),
                    DB::raw('SUM(annual_performances.bad_debt_losses) as total_bad_debt_losses'),
                    DB::raw('SUM(annual_performances.other_fee) as other_expenses')
                )
                ->where('annual_performances.year', $year)
                ->where('annual_performances.deleted_at', null)
                ->whereIn('property.id', $data)
                ->first();
            return $result;
        } catch (Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * function get data property checked
     * @param $dataId
     * @return mixed
     */
    public function getPropertyChecked($dataId)
    {
        return $this->model->select('house_name', 'proprietor')->whereIn('id', $dataId)->get();
    }

    /**
     * Get list year AnnulPerformance
     *
     * @param Property $property
     * @return array
     */
    public function getAllMonthAnnulPerformance(Property $property)
    {
        return $property->annualPerformances()->pluck('year')->toArray();
    }

    /**
     * Has annual performance
     *
     * @param $propertyId
     *
     * @return bool
     */
    public function hasAnnualPerformance($propertyId): bool
    {
        return $this->model->where('id', $propertyId)->has('annualPerformances')->count() ? true : false;
    }

    /**
     * get condition by real estate type
     *
     * @param array $params
     * @return array
     */
    private function getConditionByRealEstateType($params)
    {
        $conditions = [];

        switch ($params['real_estate_type_search']) {
            case "1":
                array_push($conditions, FLAG_ONE);
                break;
            case "2":
                array_push($conditions, FLAG_TWO);
                break;
            case "3":
                array_push($conditions, FLAG_THREE);
                break;
            case "4":
                array_push($conditions, FLAG_FIVE, FLAG_SIX);
                break;
            default:
                array_push($conditions, FLAG_FOUR, FLAG_SEVEN, FLAG_EIGHT);
                break;
        }
        return $conditions;
    }

    /**
     *  get condition by total floor area
     *
     * @param array $params
     * @return array
     */
    public function getConditionByTotalFloorArea($params)
    {
        $totalFloorArea = in_array(DATA_ALL, $params['total_floor_area']) ? DATA_ALL : $params['total_floor_area'];
        if ($totalFloorArea == DATA_ALL) {
            return ['total_area_floors > 0'];
        }

        $conditions = [];
        foreach ($totalFloorArea as $value) {
            switch ($value) {
                case '1,000㎡未満':
                    array_push($conditions, 'total_area_floors < 1000');
                    break;
                case '2,000㎡未満':
                    array_push($conditions, 'total_area_floors < 2000');
                    break;
                case '3,000㎡未満':
                    array_push($conditions, 'total_area_floors < 3000');
                    break;
                case '5,000㎡未満':
                    array_push($conditions, 'total_area_floors < 5000');
                    break;
                case '1,000㎡以上10,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 1000 and total_area_floors < 10000)');
                    break;
                case '2,000㎡以上3,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 2000 and total_area_floors < 3000)');
                    break;
                case '3,000㎡以上5,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 3000 and total_area_floors < 5000)');
                    break;
                case '3,000㎡以上10,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 3000 and total_area_floors < 10000)');
                    break;
                case '5,000㎡以上10,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 5000 and total_area_floors < 10000)');
                    break;
                case '10,000㎡以上30,000㎡未満':
                    array_push($conditions, '(total_area_floors >= 10000 and total_area_floors < 30000)');
                    break;
                case '5,000㎡以上':
                    array_push($conditions, 'total_area_floors >= 5000');
                    break;
                case '10,000㎡以上':
                    array_push($conditions, 'total_area_floors >= 10000');
                    break;
                default:
                    array_push($conditions, 'total_area_floors >= 30000');
                    break;
            }
        }
        return $conditions;
    }

    /**
     * get condition by construction time
     *
     * @param $params
     * @return array
     */
    public function getConditionByConstructionTime($params)
    {
        $houseLongevity = in_array(DATA_ALL, $params['house_longevity']) ? DATA_ALL : $params['house_longevity'];
        if ($houseLongevity == DATA_ALL) {
            return ['construction_time > ' . date('Y-m-d')];
        }

        $conditions = [];
        foreach ($houseLongevity as $value) {
            switch ($value) {
                case '10年未満':
                    array_push($conditions, 'construction_time > ' . getDateByHouseLongevity(TEN_YEAR));
                    break;
                case '20年未満':
                    array_push($conditions, 'construction_time > ' . getDateByHouseLongevity(TWENTY_YEAR));
                    break;
                case '10年以上20年未満':
                    array_push($conditions, '(construction_time <= ' . getDateByHouseLongevity(TEN_YEAR) . ' and construction_time >' . getDateByHouseLongevity(TWENTY_YEAR) . ')');
                    break;
                case '20年以上30年未満':
                    array_push($conditions, '(construction_time <= ' . getDateByHouseLongevity(TWENTY_YEAR) . ' and construction_time >' . getDateByHouseLongevity(THIRTY_YEAR) . ')');
                    break;
                case '20年以上':
                    array_push($conditions, 'construction_time <= ' . getDateByHouseLongevity(TWENTY_YEAR));
                    break;
                default:
                    array_push($conditions, 'construction_time <= ' . getDateByHouseLongevity(THIRTY_YEAR));
                    break;
            }
        }
        return $conditions;
    }

    /**
     * Get data search
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDataSearch($params)
    {
        return $this->model
            ->competeChart()
            ->with(
                'detailRealEstateType',
                'realEstateType',
                'buildingRight',
                'landRight',
                'houseMaterial',
                'houseRoofType',
                'typeRental'
            )
            ->when(isset($params['real_estate_type_search']), function ($query) use ($params) {
                return $query->whereIn('real_estate_type_id', $this->getConditionByRealEstateType($params));
            })
            ->when(isset($params['total_floor_area']), function ($query) use ($params) {
                return $query->where(function (Builder $query) use ($params) {
                    foreach ($this->getConditionByTotalFloorArea($params) as $item) {
                        $query->orWhereRaw($item);
                    }
                });
            })
            ->when(isset($params['house_longevity']), function ($query) use ($params) {
                return $query->where(function (Builder $query) use ($params) {
                    foreach ($this->getConditionByConstructionTime($params) as $item) {
                        $query->orWhereRaw($item);
                    }
                });
            })
            ->when(isset($params['area']) && isset($params['real_estate_type_search']), function ($query) use ($params) {
                    $address = resolve(AreaRepositoryInterface::class)->getDataByAreas($params);
                    return $query->whereIn('address_city', array_column($address, 'provincial'))
                        ->whereIn('address_district', array_column($address, 'district'));
            })
            ->orderBy('id', 'asc')
            ->paginate(LIMIT_RECORD_SEARCH_DEFAULT);
    }

    /**
     * handle condition search
     *
     * @param $params
     * @return bool
     */
    public function isConditionSearch($params)
    {
        if (
            empty($params['real_estate_type_search']) || !in_array($params['real_estate_type_search'], [FLAG_ONE, FLAG_TWO, FLAG_THREE, FLAG_FOUR, FLAG_FIVE])
            || !is_numeric($params['real_estate_type_search']) || $params['real_estate_type_search'] < FLAG_ZERO
        ) {
            return true;
        }
        return false;
    }

    /**
     * Delete records by userId
     *
     * @param $userId
     */
    public function deleteRecordsByUserId($userId)
    {
        DB::beginTransaction();
        try {
            $listRecord = $this->model->where('user_id', $userId)->get();
            foreach ($listRecord as $record) {
                removeImagesInFolder('/public/' . FOLDER_IMAGES_PROPERTY, $record->avatar);
                $record->delete();
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
        }
    }

    /**
     * Get data by user with role invalid
     *
     * @param int $userId
     * @param bool $withTrashed
     *
     * @return mixed
     */
    public function getByUserIdAndRole($userId, $withTrashed = false)
    {
        return $this->buildQueryGetByUserIdAndRole($userId, $withTrashed)
            ->simplePaginate(LIMIT_RECORD_PROPERTY_USER_DETAIL);
    }

    /**
     * Get all data by user with role invalid
     *
     * @param $userId
     * @param bool $withTrashed
     * @return mixed
     */
    public function getAllByUserIdAndRole($userId, $withTrashed = false)
    {
        return $this->buildQueryGetByUserIdAndRole($userId, $withTrashed)
            ->get();
    }

    /**
     * Count data by user id and role
     *
     * @param int $userId
     * @param bool $withTrashed
     *
     * @return mixed
     */
    public function countByUserIdAndRole($userId, $withTrashed = false)
    {
        return $this->buildQueryGetByUserIdAndRole($userId, $withTrashed)->count();
    }

    /**
     * Build query get data by user id and role
     *
     * @param int $userId
     * @param bool $withTrashed
     *
     * @return mixed
     */
    protected function buildQueryGetByUserIdAndRole($userId, $withTrashed)
    {
        $this->newQuery();

        return $this->query
            ->when($withTrashed, function ($query) {
                $query->withTrashed();
            })
            ->where('user_id', $userId)
            ->whereHas('user', function (Builder $query) {
                $query->withTrashed()->whereIn('role', [INVESTOR, BROKER, EXPERT]);
            })
            ->selectRaw('property.id, property.property_code, property.house_name, property.deleted_at')
            ->orderBy('property.created_at', 'DESC');
    }

    /**
     * Get data property with id
     *
     * @param integer $propertyId
     *
     * @return mixed
     */
    public function getObjectById($propertyId)
    {
        $this->with(['detailRealEstateType']);
        $property = $this->getById($propertyId)->toArray();
        $property['years_passed'] = empty($property['loan_date']) ? 0 : getNumberYearPassed($property['loan_date']);

        return $property;
    }

    /**
     * Move property
     *
     * @param $user
     * @param $properties
     * @return bool
     */
    public function moveProperty($user, $properties)
    {
        DB::beginTransaction();
        try {
            if (!$user) {
                return false;
            }
            $this->model->withTrashed()->whereIn('id', $properties)->update(['user_id' => $user->id]);
            resolve(PortfolioAnalysisRepositoryInterface::class)->movePortfolioAnalysis($user->id, $properties);
            resolve(SubUserPropertyEloquentRepository::class)->deleteRelationshipAfterMoveProperty($properties);
            resolve(TaxPropertyRepositoryInterface::class)->removeRecordsWhenMoveProperty($properties);
            DB::commit();
            return $this->model->whereIn('id', $properties)->pluck('house_name')->toArray();
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * get data property and profile of user
     *
     * @param $propertyId
     * @return array
     */
    public function getDataPropertyWithUserProfile($propertyId)
    {
        return $this->model->with(['user' => function ($query) {
                $query->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name');
        }, 'detailRealEstateType', 'realEstateType', 'buildingRight', 'landRight', 'houseMaterial', 'houseRoofType', 'typeRental', 'rentRolls', 'monthlyBalances'])->find($propertyId)->toArray();
    }

    /**
     * Block property by UserId
     *
     * @param $properties
     */
    public function block($properties)
    {
        $currentTime = date('Y-m-d h:i:s', time());
        foreach ($properties->get() as $property) {
            $property->update(['deleted_at' => $currentTime]);
            $property->annualPerformances()->update(['deleted_at' => $currentTime]);
            $property->portfolioAnalysis()->update(['deleted_at' => $currentTime]);
            $property->simpleAssessment()->update(['deleted_at' => $currentTime]);
            $property->repairHistory()->update(['deleted_at' => $currentTime]);
            $property->rentRolls()->update(['deleted_at' => $currentTime]);
            $property->businessPlan()->update(['deleted_at' => $currentTime]);
            $property->monthlyBalances()->update(['deleted_at' => $currentTime]);
            $property->generalInfo()->update(['deleted_at' => $currentTime]);
            $property->generalImagesProperty()->update(['deleted_at' => $currentTime]);
        }
    }

    /**
     * Unblock property by UserId
     *
     * @param $properties
     */
    public function unblock($properties)
    {
        foreach ($properties->get() as $property) {
            $property->update(['deleted_at' => null]);
            $property->annualPerformances()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->portfolioAnalysis()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->simpleAssessment()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->repairHistory()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->rentRolls()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->businessPlan()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->monthlyBalances()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->generalInfo()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
            $property->generalImagesProperty()->withTrashed()->where('unblock_status', FLAG_ZERO)->restore();
        }
    }

    /**
     * get router redirect
     *
     * @param array $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRedirectRouteName($request)
    {
        $request['option_paginate'] = $request['option_paginate'] ?? LIMIT_RECORD_DEFAULT;
        $pageIndex = isset($request['page']) ? $request['page'] : FLAG_ONE;
        if (isset($request['screen']) && $request['screen'] == 'property') {
            return redirect()->route(USER_PROPERTY_INDEX, ['page' => $pageIndex]);
        } elseif (isset($request['screen']) && $request['screen'] == 'portfolio-analysis') {
            return redirect()->route(USER_PROPERTY_PORTFOLIO_ANALYSIS, isset($request['params']) ? $request['params'] : ['option_paginate' => $request['option_paginate'], 'page' => $pageIndex]);
        }
        return redirect()->route(USER_PROPERTY_INDEX);
    }

    /**
     * get total property by user id
     *
     * @param $userId
     * @return mixed
     */
    public function getTotalPropertyByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    /**
     * get list property name by user id
     *
     * @param $userId
     * @return mixed
     */
    public function getListPropertyNameByUserId($userId)
    {
        return $this->model->selectRaw('id, house_name')
                        ->where('user_id', $userId)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(LIMIT_RECORD_DEFAULT);
    }

    /**
     * Get all data single analysis
     *
     * @param $property
     * @return mixed
     */
    public function getAllDataSingleAnalysis($property)
    {
//        $user = Auth::user();
        $address = resolve(AreaRepositoryInterface::class)->getDataByAreas([
            'real_estate_type_search' => $property['real_estate_type_id'],
            'area' => [resolve(AreaRepositoryInterface::class)->getRegionAcreageYearForSave($property)]
        ]);
        return $this->model
            ->competeChart()
            ->with('detailRealEstateType', 'realEstateType', 'houseMaterial', 'buildingRight', 'landRight', 'houseRoofType', 'typeRental')
//            ->mainUser($user->id, !$user->isSubUser())
//            ->subUser(resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyEditForUser($user->id), $user->isSubUser())
            ->where('id', '<>', $property['id'])
            ->where('real_estate_type_id', $property['real_estate_type_id'])
            ->whereRaw(getValueByListLimitedToSql($property['real_estate_type_id'], 'total_area_floors', $property['total_area_floors']))
            ->when(!empty($property['construction_time']), function ($query) use ($property) {
                return $query->whereRaw('(YEAR(construction_time) - YEAR(construction_time) % 10) = ' . getDecade($property['construction_time']));
            })
            ->whereIn('address_city', array_column($address, 'provincial'))
            ->whereIn('address_district', array_column($address, 'district'))
            ->orderBy('id', 'asc')
            ->take(LIMIT_RECORD_DEFAULT)->get()->toArray();
    }

    /**
     * Get list property home
     *
     * @param $user
     * @return array
     */
    public function getListPropertyHome($user)
    {
        if ($user) {
            $currentUser = Auth::user();
            if ($currentUser->isMainUser()) {
                return $currentUser->property->toArray();
            }
            return $this->model->whereIn('id', resolve(SubUserPropertyRepositoryInterface::class)->getDataPropertyReportForUser($currentUser->id))->get()->toArray();
        }
        return [];
    }

    /**
     * Get last property by user
     *
     * @param $userId
     * @return mixed
     */
    public function getLastPropertyByUser($userId)
    {
        return $this->model->where('user_id', $userId)->limit(FLAG_ONE)->first();
    }

    /**
     * Get data compete chart
     *
     * @param $property
     * @param $listProperty
     * @return array[]
     */
    public function getDataCompeteChart($property, $listProperty)
    {
        $dataReturn = [[[], []], [[], []], [[], []], [[], []], [[], []], [[], [[], [], [], []]]];
        $this->processDataToChart($dataReturn, $property, '対象');
        foreach ($listProperty as $key => $value) {
            $this->processDataToChart($dataReturn, $value);
        }
        return $dataReturn;
    }

    /**
     * Get data compete chart Bank List
     *
     * @param $listProperty
     * @return array[]
     */
    public function getDataCompeteChartBankList($listProperty)
    {
        $dataReturn = [[[], []], [[], []], [[], []], [[], []], [[], []], [[], [[], [], [], []]]];
        foreach ($listProperty as $key => $value) {
            $this->processDataToChart($dataReturn, $value->toArray());
        }
        return $dataReturn;
    }

    /**
     * Process data to Compete Chart
     *
     * @param $dataReturn
     * @param $property
     * @param $index
     * @param null $nameProperty
     */
    public function processDataToChart(&$dataReturn, $property, $nameProperty = null)
    {
        $color = sprintf("#%06x", rand(0, 16777215));
        $nameProperty = $nameProperty ?? $property['house_name'];
        array_push($dataReturn[FLAG_ZERO][FLAG_ZERO], (float)$property['rentable_ratio']);
        array_push($dataReturn[FLAG_ZERO][FLAG_ONE], [
            'name' => $nameProperty,
            'color' => $color,
            'y' => (float)$property['operating_balance']
        ]);
        array_push($dataReturn[FLAG_ONE][FLAG_ZERO], (float)$property['rentable_ratio']);
        array_push($dataReturn[FLAG_ONE][FLAG_ONE], [
            'name' => $nameProperty,
            'color' => $color,
            'y' => (float)$property['expense_ratio']
        ]);
        array_push($dataReturn[FLAG_TWO][FLAG_ZERO], (float)$property['operating_revenue']);
        array_push($dataReturn[FLAG_TWO][FLAG_ONE], [
            'name' => $nameProperty,
            'color' => $color,
            'y' => (float)$property['expense_ratio']
        ]);
        array_push($dataReturn[FLAG_THREE][FLAG_ZERO], (float)$property['operating_revenue']);
        array_push($dataReturn[FLAG_THREE][FLAG_ONE], [
            'name' => $nameProperty,
            'color' => $color,
            'y' => (float)$property['other_expense_items']
        ]);
        array_push($dataReturn[FLAG_FOUR][FLAG_ZERO], (float)$property['maintenance_management_cost']);
        array_push($dataReturn[FLAG_FOUR][FLAG_ONE], [
            'name' => $nameProperty,
            'color' => $color,
            'y' => (float)$property['repair_cost']
        ]);
        array_push($dataReturn[FLAG_FIVE][FLAG_ZERO], $nameProperty);
        array_push($dataReturn[FLAG_FIVE][FLAG_ONE][FLAG_ZERO], (float)$property['maintenance_management_cost']);
        array_push($dataReturn[FLAG_FIVE][FLAG_ONE][FLAG_ONE], (float)$property['repair_cost']);
        array_push($dataReturn[FLAG_FIVE][FLAG_ONE][FLAG_TWO], (float)$property['insurance_premium']);
        array_push($dataReturn[FLAG_FIVE][FLAG_ONE][FLAG_THREE], (float)$property['other_expense_items']);
    }

    /**
     * Push data items
     *
     * @param $arrayReturn
     * @param $name
     * @param $color
     * @param $category
     * @param $index
     * @param $data
     */
    public function pushDataItems(&$arrayReturn, $name, $color, $category, $index, $data)
    {
        array_push($arrayReturn, [
            'name' => $name,
            'color' => $color,
            'categories' => $category, // x
            'data' => [[$index, $data]], // y
        ]);
    }
}
