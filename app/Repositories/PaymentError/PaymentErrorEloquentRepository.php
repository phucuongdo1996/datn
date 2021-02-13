<?php

namespace App\Repositories\PaymentError;

use App\Models\PaymentError;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentErrorEloquentRepository extends BaseRepository implements PaymentErrorRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return PaymentError::class;
    }

    /**
     * function clock user payment error
     *
     */
    public function blockUserPaymentError()
    {
        DB::beginTransaction();
        try {
            $dataUser = $this->model->where('deleted_at', null)->where('created_at', '<=', Carbon::now()->subDay(1)->format('Y-m-d H:i:s'));
            foreach ($dataUser->pluck('user_id')->toArray() as $id) {
                resolve(UserRepositoryInterface::class)->blockUserById(['deleted_at' => date('Y-m-d h:i:s', time())], $id);
            }
            $dataUser->delete();
            DB::commit();
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
        }
    }
}
