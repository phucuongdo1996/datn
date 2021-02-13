<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationMailOfNetwork implements Rule
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
        if (empty($value)) {
            return false;
        }
        foreach (HOME_NETWORK_DOMAIN as $item) {
            if (strpos($value, $item) !== false) {
                return false;
            }
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
        return trans('validation.register.email.home_network_domain');
    }
}
