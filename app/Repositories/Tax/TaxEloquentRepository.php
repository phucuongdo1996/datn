<?php

namespace App\Repositories\Tax;

use App\Models\Tax;
use App\Repositories\BaseRepository;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\TaxProperty\TaxPropertyEloquentRepository;
use App\Repositories\TaxProperty\TaxPropertyRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Collection;

class TaxEloquentRepository extends BaseRepository implements TaxRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Tax::class;
    }

    /**
     * get all
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get()->toArray();
    }

    /**
     * get list tax by mont and year
     *
     * @param $params
     *
     * @return array|mixed
     */
    public function getByMonthAndYear($params)
    {
        return $this->model
                ->where('taxes.user_id', Auth::user()->id)
                ->with(['propertyTax' =>function ($query) {
                    return $query->orderBy('id', 'desc');
                }])
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->paginate($params);
    }

    /**
     * count tax total page
     *
     * @return mixed
     */
    public function countTaxes()
    {
        return $this->model
            ->where('taxes.user_id', Auth::user()->id)
            ->count();
    }

    /**
     * get page number
     *
     * @param int $userId
     * @param int $taxId
     * @param int $recordInOnePage
     * @return int
     */
    public function getPageNumber(int $userId, int $taxId, int $recordInOnePage)
    {
        $data = $this->model->where('user_id', $userId)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('id')->toArray();

        if (!$data || !in_array($taxId, $data)) {
            return FLAG_ZERO;
        }

        return intval(ceil((array_search($taxId, $data) + FLAG_ONE)  / $recordInOnePage));
    }

    /**
     * function get data property
     *
     * @param int $id
     * @param Auth $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getDataWithProperty($id, $userId)
    {

        $data = $this->model->with('property')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!empty($data->property)) {
            $data->dataProperty = $data->property->pluck('id');
        }

        return $data;
    }

    /**
     *  Function delete tax
     *
     * @param $id
     * @return bool
     */
    public function deleteRecordById($id)
    {
        DB::beginTransaction();
        try {
            $tax = $this->where('user_id', Auth::user()->id)->find($id);
            if(!$tax){
                return false;
            }
            $tax->taxProperty()->delete();
            $tax->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {

            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * Get Page Number
     *
     * @param $params
     * @return float|int
     */
    public function getPageNumberWhenDelete($params)
    {
        if (request()->isMethod('delete')) {
            if ($this->countTaxes() == ($params['page'] - 1) * $params['option_paginate']) {
                return $params['page'] - 1;
            }
            return $params['page'];
        }
        return false;
    }

    /**
     * function get data preview in
     * @param array $param
     * @return array
     */
    public function getDataPreview($param)
    {
        return [
            'date_format_tax' => dateTimeFormatTax($param['year'], $param['month']),
            'day_of_month' =>  getDayOfMonth($param['month'], $param['year']),
            'year_label' =>  getYearLabel($param['year']),
            'date_of_year_label' =>  getDateNumberTheLabel($param['year']),
        ];
    }

    /**
     * Auto update taxes and tax-property
     *
     * @param array $newData
     * @param array $oldData
     * @param array $taxes
     *
     * @return bool
     */
    public function autoUpdateData($newData, $oldData, $taxes)
    {
        try {
            DB::beginTransaction();
            foreach ($taxes as $key => $tax) {
                $this->update($tax['id'], $this->setDataUpdated($newData, $oldData, $tax));
                if (isset($oldData['delete'])) {
                    $taxPropertyRepository = resolve(TaxPropertyEloquentRepository::class);
                    $taxPropertyRepository->deleteDataByConditions($tax['id'], $oldData['property_id']);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Set data auto upload
     *
     * @param $newData
     * @param $oldData
     * @param $tax
     *
     * @return array
     */
    private function setDataUpdated($newData, $oldData, $tax)
    {
        $paramsTax = [];
        $paramsTax['rent'] = $tax['rent'] - $oldData['rent_income'] + $newData['rent_income'];
        $paramsTax['key_money'] = $tax['key_money'] - ($oldData['income_input_money'] + $oldData['income_update_house_contract']) + ($newData['income_input_money'] + $newData['income_update_house_contract']);
        $paramsTax['taxes_dues'] = $tax['taxes_dues'] - $oldData['taxes_dues'] + $newData['taxes_dues'];
        $paramsTax['non_life_insurance_premiums'] = $tax['non_life_insurance_premiums'] - $oldData['insurance_premium'] + $newData['insurance_premium'];
        $paramsTax['repair_costs'] = $tax['repair_costs'] - ($oldData['repair_fee'] + $oldData['intact_reply_fee']) + ($newData['repair_fee'] + $newData['intact_reply_fee']);
        $paramsTax['depreciation'] = 0;
        $paramsTax['borrowing_interest'] = 0;
        $paramsTax['payment_rent'] = $tax['payment_rent'] - $oldData['land_tax'] + $newData['land_tax'];
        $paramsTax['salary_wage'] = 0;
        $paramsTax['other_expenses'] = $tax['other_expenses'] - $oldData['other_fee'] + $newData['other_fee'];
        $paramsTax['other_income'] = $tax['other_income'] - ($oldData['utilities_revenue'] + $oldData['parking_revenue'] + $oldData['other_income']) + ($newData['utilities_revenue'] + $newData['parking_revenue'] + $newData['other_income']);
        $paramsTax['maintenance_management_fee'] = $tax['maintenance_management_fee'] - $oldData['management_fee'] + $newData['management_fee'];
        $paramsTax['utilities_expenses'] = $tax['utilities_expenses'] - $oldData['utilities_fee'] + $newData['utilities_fee'];
        $paramsTax['management_fee'] = $tax['management_fee'] - $oldData['asset_management_fee'] + $newData['asset_management_fee'];
        $paramsTax['commission_paid'] = $tax['commission_paid'] - $oldData['tenant_recruitment_fee'] + $newData['tenant_recruitment_fee'];
        $paramsTax['loan_loss'] = $tax['loan_loss'] - $oldData['bad_debt_losses'] + $newData['bad_debt_losses'];
        $paramsTax['total_income'] = $paramsTax['rent'] + $paramsTax['key_money'] + $paramsTax['other_income'];
        $paramsTax['total_required_expenses'] = $paramsTax['taxes_dues'] + $paramsTax['non_life_insurance_premiums'] + $paramsTax['repair_costs'] + $paramsTax['depreciation']
            + $paramsTax['borrowing_interest'] + $paramsTax['payment_rent'] + $paramsTax['salary_wage'] + $paramsTax['maintenance_management_fee']
            + $paramsTax['utilities_expenses'] + $paramsTax['management_fee'] + $paramsTax['commission_paid'] + $paramsTax['loan_loss']
            + $paramsTax['other_expenses'];
        $paramsTax['balance'] = $paramsTax['total_income'] - $paramsTax['total_required_expenses'];

        return $paramsTax;
    }
}
