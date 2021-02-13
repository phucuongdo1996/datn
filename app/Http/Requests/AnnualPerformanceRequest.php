<?php

namespace App\Http\Requests;

use App\Rules\MonthlyBalanceNumberOneByteRule;
use Illuminate\Foundation\Http\FormRequest;

class AnnualPerformanceRequest extends FormRequest
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
            'year' => ['bail', 'required'],
            'revenue_land_taxes' => [new MonthlyBalanceNumberOneByteRule()],
            'rent_income' => [new MonthlyBalanceNumberOneByteRule()],
            'general_services' => [new MonthlyBalanceNumberOneByteRule()],
            'utilities_revenue' => [new MonthlyBalanceNumberOneByteRule()],
            'parking_revenue' => [new MonthlyBalanceNumberOneByteRule()],
            'income_input_money' => [new MonthlyBalanceNumberOneByteRule()],
            'income_update_house_contract' => [new MonthlyBalanceNumberOneByteRule()],
            'other_income' => [new MonthlyBalanceNumberOneByteRule()],
            'bad_debt_losses' => [new MonthlyBalanceNumberOneByteRule()],
            'management_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'utilities_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'repair_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'intact_reply_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'asset_management_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'tenant_recruitment_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'taxes_dues' => [new MonthlyBalanceNumberOneByteRule()],
            'insurance_premium' => [new MonthlyBalanceNumberOneByteRule()],
            'land_tax' => [new MonthlyBalanceNumberOneByteRule()],
            'other_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'crop_yield' => ['bail', 'nullable', 'regex: /^[0-9.]*$/', 'numeric', 'between:0,100']
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
            'year.required' => trans('validation.annual_performance.required'),
            'crop_yield.numeric' => trans('validation.rent_roll.input_number_dot'),
            'crop_yield.between' => trans('validation.annual_performance.between'),
            'crop_yield.regex' => trans('validation.monthly_balance.number_and_dot_one_byte'),
            'contract_area.required' => trans('validation.rent_roll.required'),
        ];
    }
}
