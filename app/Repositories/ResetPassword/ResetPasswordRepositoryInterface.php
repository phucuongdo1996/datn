<?php

namespace App\Repositories\ResetPassword;

interface ResetPasswordRepositoryInterface
{
    /**
     * Find by a attribute
     *
     * @param string $attribute
     * @param string $value
     * @return |null
     */
    public function findByAttribute(string $attribute, string $value);


}
