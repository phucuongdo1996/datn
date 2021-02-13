<?php

namespace App\Repositories\Payment;

interface PaymentRepositoryInterface
{
    /**
     * get dates of payment
     *
     * @param $userId
     * @return mixed
     */
    public function getDatesPayment($userId);
}
