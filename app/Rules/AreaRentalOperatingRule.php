<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AreaRentalOperatingRule implements Rule
{
    public $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->type = $param;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $attribute, $value)
    {
        if ((float)$this->type == FLAG_ZERO || ((float)$value / (float)$this->type) * 100 <= MAX_RENT_RATE) {
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
        return trans('validation.property.max_rent_rate');
    }
}
