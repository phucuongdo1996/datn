<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContractEndDateRule implements Rule
{
    public $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($signingDate, $startDate)
    {
        $this->signingDate = $signingDate;
        $this->startDate = $startDate;
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
        if ( (!($this->signingDate) && strtotime($value) >= strtotime($this->startDate))
            || (!($this->startDate) && strtotime($value) >= strtotime($this->signingDate))
            || (strtotime($value) >=  strtotime($this->signingDate) && strtotime($value) >=  strtotime($this->startDate)
                && $this->signingDate && $this->startDate)
            || (!($this->signingDate) && !($this->startDate))) {
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
        return trans('validation.rent_roll.date_period_3');
    }
}
