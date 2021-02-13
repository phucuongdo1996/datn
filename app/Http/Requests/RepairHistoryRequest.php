<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberValidateRule;
use Illuminate\Foundation\Http\FormRequest;

class RepairHistoryRequest extends FormRequest
{
    /**
     * RepairHistoryRequest constructor.
     */
    public function __construct()
    {
        $this->formatPaymentExcludingTax();
    }

    /**
     * Format Payment Excluding Tax
     */
    protected function formatPaymentExcludingTax()
    {
        if (request()->has('payment_excluding_tax')) {
            request()->merge([
                'payment_excluding_tax' => intval(str_replace(',', '', request('payment_excluding_tax')))
            ]);
        }
    }

    /**
     * Validated Form
     *
     * @return mixed
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
        $rules = [
            'property_id' => 'required',
            'classify' => 'required',
            'describe' => 'nullable',
            'order_repair_date' => ['nullable', 'date_format:Y/m/d'],
            'construction_completion_date' => ['nullable', 'date_format:Y/m/d'],
            'payment_excluding_tax' => ['nullable', new PhoneNumberValidateRule()],
            'payment_date' => ['nullable', 'date_format:Y/m/d'],
            'payment_side' => 'nullable'
        ];
        switch($this->method())
        {
            case 'POST':
            {
                return $rules;
            }
            case 'PUT':
            {
                $rules['id'] = 'required';
                $rules['time_open_page'] = 'required';
                return $rules;
            }
            default:break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'classify.required' => trans('validation.simulation.select_required'),
            'order_repair_date.date_format' => trans('validation.simulation.date_format'),
            'construction_completion_date.date_format' => trans('validation.simulation.date_format'),
            'payment_date.date_format' => trans('validation.simulation.date_format'),
        ];
    }
}
