<?php

namespace App\Repositories\PayDetail;

use App\Models\PayDetail;
use App\Repositories\BaseRepository;

class PayDetailEloquentRepository extends BaseRepository implements PayDetailRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return PayDetail::class;
    }

    /**
     * Find by attribute
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findByAttribute($attribute, $value)
    {
        return $this->model->where($attribute, $value)->get();
    }

    /**
     * Update finish date old record
     *
     * @param $userId
     * @param $finishDate
     */
    public function updateFinishDateOldRecord($userId, $finishDate)
    {
        $oldRecord = $this->model->where('user_id', $userId)->orderBy('start_date')->get()->last();
        if ($oldRecord && $oldRecord->finish_date == null) {
            $oldRecord->finish_date = $finishDate;
            $oldRecord->save();
        }
    }

    /**
     * Create pay code
     *
     * @return string
     */
    public function createPayCode()
    {
        do {
            $payCode = str_pad(rand(0, 999999999999999), LENGTH_PAY_CODE, "0", STR_PAD_LEFT);
        } while ($this->findByAttribute('pay_code', $payCode) == null);
        return $payCode;
    }

    /**
     * Create record change plan
     *
     * @param $userId
     * @param $amounts
     * @param $typeUpgrade
     */
    public function createRecordChangePlan($userId, $amounts, $typeUpgrade)
    {
        $this->updateFinishDateOldRecord($userId, date('Y-m-d'));
        $amounts['user_id'] = $userId;
        $amounts['pay_code'] = $this->createPayCode();
        $amounts['captured_at'] = date('Y-m-d');
        $amounts['start_date'] = date('Y-m-d');
        $amounts['member_status'] = $typeUpgrade;
        $amounts['check_done'] = true;
        $this->create($amounts);
    }

    /**
     * Create record before pay
     *
     * @param $userId
     * @param $amounts
     * @param $typeUpgrade
     */
    public function createRecordBeforePay($userId, $amounts, $typeUpgrade)
    {
        $this->updateFinishDateOldRecord($userId, date('Y-m-d'));
        $amounts['user_id'] = $userId;
        $amounts['pay_code'] = $this->createPayCode();
        $amounts['captured_at'] = date('Y-m-d');
        $amounts['start_date'] = date('Y-m-d');
        $amounts['member_status'] = $typeUpgrade;
        $amounts['check_done'] = false;
        $this->create($amounts);
    }

    /**
     * Get history pay
     *
     * @param $userId
     * @return mixed
     */
    public function getHistoryPay($userId)
    {
        return $this->model->where('user_id', $userId)->where('check_done', true)
            ->orderBy('start_date', 'DESC')->orderBy('id', 'DESC')->get()->toArray();
    }

    /**
     * Update last record
     *
     * @param $userId
     */
    public function updateLastRecord($userId)
    {
        $oldRecord = $this->model->where('user_id', $userId)->orderBy('start_date')->get()->last();
        if ($oldRecord) {
            $oldRecord->check_done = true;
            $oldRecord->save();
        }
    }

    /**
     * Remove last record
     *
     * @param $userId
     */
    public function removeLastRecord($userId)
    {
        $oldRecord = $this->model->where('user_id', $userId)->orderBy('start_date')->get()->last();
        if ($oldRecord && $oldRecord->check_done == false) {
            $oldRecord->forceDelete();
        }
    }
}
