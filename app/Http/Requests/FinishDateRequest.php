<?php

namespace App\Http\Requests;

use App\Rules\InterestRateValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FinishDateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'finish_date' => ['date_format:Y/m/d', 'after:yesterday'],
            'discount' => ['bail', 'nullable', 'regex: /^[0-9-.]*$/', 'numeric', 'between: 0.00, 100'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'finish_date.required' => trans('validation.property.required'),
            'finish_date.date_format' => trans('validation.simulation.date_format'),
            'finish_date.after' => trans('validation.simulation.the_date_is_invalid'),
            'between' => trans('validation.property.interest_rate_100'),
        ];
    }
}
