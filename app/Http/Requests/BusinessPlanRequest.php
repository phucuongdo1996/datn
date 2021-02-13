<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessPlanRequest extends FormRequest
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
            'input_date' => ['nullable', 'date_format:Y/m/d'],
            'expected_borrowing_date'  => ['nullable', 'date_format:Y/m/d'],
            'initial_borrowing_period' => ['regex: /^[0-9]*$/'],
            'expected_interest' => ['regex: /^[0-9.]*$/'],
            'expected_borrowing_amount' =>['regex: /^[0-9]*$/'],
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
            'input_date.date_format' => trans('validation.simulation.date_format'),
            'expected_borrowing_date.date_format' => trans('validation.simulation.date_format'),
            'initial_borrowing_period.regex' => trans('validation.business_plan.initial_borrowing_period'),
            'expected_interest.regex' => trans('validation.business_plan.expected_interest'),
            'expected_borrowing_amount.regex' => trans('validation.rent_roll.input_number'),
        ];
    }
}
