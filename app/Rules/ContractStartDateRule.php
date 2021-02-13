<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContractStartDateRule implements Rule
{
    public $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($signingDate, $endDate)
    {
        $this->signingDate = $signingDate;
        $this->endDate = $endDate;
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
        if ((strtotime($this->signingDate) <= strtotime($value) && strtotime($this->endDate) >= strtotime($value))
            || (!($this->signingDate) && strtotime($this->endDate) >= strtotime($value))
            || (!($this->endDate) && strtotime($this->signingDate) <= strtotime($value))
            || (!($this->signingDate) && !($this->endDate))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.rent_roll.date_period_2');
    }
}
