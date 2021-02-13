<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Repositories\BaseRepository;

class PaymentEloquentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Payment::class;
    }

    /**
     * get dates of payment
     *
     * @param $userId
     * @return mixed
     */
    public function getDatesPayment($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->latest()
            ->first();
    }
}
