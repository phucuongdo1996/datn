<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidationRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value) || mb_strlen($value) != strlen($value)) {
            return false;
        }
        if (preg_match('/^[a-zA-Z0-9]*$/', $value) && mb_strlen($value) >= 8 && mb_strlen($value) <= 30) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.register.password.regex');
    }
}
