<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function findByEmail($email);

    public function findByVerifiedToken($verifiedToken);

    /**
     * get by user code
     *
     * @param int $id
     * @return mixed
     */
    public function getByUserCode($id);
}
