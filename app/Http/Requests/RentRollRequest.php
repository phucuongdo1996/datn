<?php

namespace App\Http\Requests;

use App\Rules\ContractEndDateRule;
use App\Rules\ContractSigningDateRule;
use App\Rules\ContractStartDateRule;
use Illuminate\Foundation\Http\FormRequest;

class RentRollRequest extends FormRequest
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
        $params = $this->request->all();
        return [
            'contract_area' => ['bail', 'required', 'not_in:0, 0.00', 'regex: /^[0-9.]*$/'],
            'monthly_rent' => ['bail', 'required', 'regex: /^[0-9]*$/'],
            'monthly_service' => ['bail', 'required', 'regex: /^[0-9]*$/'],
            'deposit_monthly' => ['bail', 'required', 'regex: /^[0-9.]*$/'],
            'real_estate_type_id' => ['required'],
            'key_money_monthly' => ['bail', 'required', 'regex: /^[0-9.]*$/'],
            'contract_signing_date' => ['bail', 'nullable', 'date_format:Y/m/d', new ContractSigningDateRule($params['contract_start_date'], $params['contract_end_date'])],
            'contract_start_date' => ['bail', 'required', 'date_format:Y/m/d', new ContractStartDateRule($params['contract_signing_date'], $params['contract_end_date'])],
            'contract_end_date' => ['bail', 'required', 'date_format:Y/m/d', new ContractEndDateRule($params['contract_signing_date'], $params['contract_start_date'])],
            'money_update' => ['regex: /^[0-9.]*$/'],
            'cancellation_notice' => ['regex: /^[0-9]*$/'],
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
            'contract_area.required' => trans('validation.rent_roll.required'),
            'contract_area.not_in' => trans('validation.rent_roll.required'),
            'contract_area.regex' => trans('validation.rent_roll.input_number_dot'),
            'monthly_rent.required' => trans('validation.rent_roll.required'),
            'monthly_rent.regex' => trans('validation.rent_roll.input_number'),
            'monthly_service.regex' => trans('validation.rent_roll.input_number'),
            'deposit_monthly.required' => trans('validation.rent_roll.required'),
            'deposit_monthly.regex' => trans('validation.rent_roll.input_number_dot'),
            'real_estate_type_id.required' => trans('validation.rent_roll.required_1'),
            'key_money_monthly.required' => trans('validation.rent_roll.required'),
            'key_money_monthly.regex' => trans('validation.rent_roll.input_number_dot'),
            'contract_signing_date.required' => trans('validation.rent_roll.required'),
            'contract_signing_date.date_format' => trans('validation.rent_roll.format_date'),
            'contract_start_date.required' => trans('validation.rent_roll.required'),
            'contract_start_date.date_format' => trans('validation.rent_roll.format_date'),
            'contract_end_date.required' => trans('validation.rent_roll.required'),
            'contract_end_date.date_format' => trans('validation.rent_roll.format_date'),
            'money_update.regex' => trans('validation.rent_roll.input_number'),
            'cancellation_notice.regex' => trans('validation.rent_roll.input_number'),
        ];
    }
}
