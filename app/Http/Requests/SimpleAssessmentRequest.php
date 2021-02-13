<?php

namespace App\Http\Requests;

use App\Rules\NumberOneByte;
use Illuminate\Foundation\Http\FormRequest;

class SimpleAssessmentRequest extends FormRequest
{
    /**
     * SimpleAssessmentRequest constructor.
     */
    public function __construct()
    {
        $this->formatPaymentExcludingTax();
    }

    /**
     *Format Payment Excluding Tax
     */
    protected function formatPaymentExcludingTax()
    {
        if (request()->has('net_profit', 'amount_assessed_taxing')) {
            request()->merge([
                'net_profit' => floatval(str_replace(',', '', request('net_profit'))),
                'amount_assessed_taxing' => intval(str_replace(',', '', request('amount_assessed_taxing')))
            ]);
        }
    }

    /**
     * @return array
     */
    public function validatedForm()
    {
        return \request()->validate(
            $this->rules(),
            $this->messages()
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'property_id' => 'required',
            'time_open_page' => 'required',
            'year' => 'integer|nullable',
            'net_profit' => 'regex: /^[0-9-.]*$/',
            'amount_assessed_taxing' => 'regex: /^[0-9-]*$/',
        ];

        return $rule;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'net_profit.regex' => trans('validation.simple_assessment.number_and_dot_one_byte'),
            'amount_assessed_taxing.regex' => trans('validation.simple_assessment.number_one_byte'),
        ];
    }
}
