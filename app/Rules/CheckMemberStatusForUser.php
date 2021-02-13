<?php

namespace App\Rules;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class CheckMemberStatusForUser implements Rule
{

    private $checkTrial;

    /**
     * CheckMemberStatusForUser constructor.
     *
     * @param $checkTrial
     */
    public function __construct($checkTrial)
    {
        $this->checkTrial = $checkTrial;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = resolve(UserRepositoryInterface::class)->findByEmail($value);
        if ($this->checkTrial && $user->isTrial()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.move_for_trial_user');
    }
}
