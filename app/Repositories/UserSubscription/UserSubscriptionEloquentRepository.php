<?php

namespace App\Repositories\UserSubscription;

use App\Models\UserSubscription;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class UserSubscriptionEloquentRepository extends BaseRepository implements UserSubscriptionRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return UserSubscription::class;
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
     * check data for user
     * @param $userId
     * @return mixed
     */
    public function getDataForUser($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * @param $data
     * @return bool
     */
    public function createRecord($data)
    {
        DB::beginTransaction();
        try {
            $date = new DateTime();
            $data['start_date'] = $date->format('Y-m-d');
            $data['finish_date'] = $date->add(new DateInterval('P60D'))->format('Y-m-d');
            $this->model->create($data);
            resolve(UserRepositoryInterface::class)->update($data['user_id'], ['member_status' => TRIALS]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * Get data after pay
     *
     * @return mixed
     */
    public function getDataAfterPay()
    {
        return $this->model->where('finish_date', Carbon::yesterday()->format('Y-m-d'))
                        ->get()->toArray();
    }

    /**
     * Get data before Pay
     *
     * @return mixed
     */
    public function getDataBeforePay()
    {
        return $this->model->where('finish_date', Carbon::now()->format('Y-m-d'))
            ->get()->toArray();
    }

    /**
     * get data by user id
     *
     * @param $userId
     * @return mixed
     */
    public function getDataByUserId($userId)
    {
        return $this->model->where('user_id', $userId)
            ->first();
    }
}
