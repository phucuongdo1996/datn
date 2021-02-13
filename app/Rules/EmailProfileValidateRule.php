<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailProfileValidateRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($value)
            && (substr($value, FLAG_ZERO, FLAG_ONE) != '+')
            && (substr_count( $value, '+') < FLAG_TWO)
            && preg_match("/^[a-zA-Z0-9-+]+[a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/", $value)
        ) {
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
        return trans('validation.profile.email.format');
    }
}
