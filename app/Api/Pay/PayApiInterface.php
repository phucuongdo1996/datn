<?php

namespace App\Api\Pay;

interface PayApiInterface
{
    /**
     * Create card
     *
     * @param $user
     * @param $payToken
     */
    public function createCard($user, $payToken);

    /**
     * Create customer
     *
     * @param $user
     */
    public function createCustomer($user);

    /**
     * get data customer
     *
     * @param $idCus
     */
    public function getDataCustomer($idCus);

    /**
     * delete card
     *
     * @param $idCus
     * @param $idCar
     */
    public function deleteCard($idCus, $idCar);
}
