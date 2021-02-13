<?php

namespace App\Repositories\VerifiedRegister;

interface VerifiedRegisterRepositoryInterface
{
    /**
     * Find by a attribute
     *
     * @param string $attribute
     * @param string $value
     * @return mixed
     */
    public function findByAttribute(string $attribute, string $value);
}
