<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContractSigningDateRule implements Rule
{
    public $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
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
        if ( (!($this->startDate) && strtotime($value) <= strtotime($this->endDate))
            || (!($this->endDate) && strtotime($value) <= strtotime($this->startDate))
            || (strtotime($value) <= strtotime($this->startDate) && strtotime($value) <= strtotime($this->endDate)
                && isset($this->startDate) && isset($this->endDate))
            || (!($this->startDate) && !($this->endDate)) ) {
            return true;
        }
        else {
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
        return trans('validation.rent_roll.date_period_1');
    }

}
