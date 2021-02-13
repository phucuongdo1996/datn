<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InterestRateValidationRule implements Rule
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
        if ($value == "0" || (preg_match("/^(?=.*[1-9])\d{0,2}(?:\.\d{0,2})?$/", $value))) {
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
        return trans('validation.property.interest_rate');
    }
}
