<?php

namespace App\Http\Requests;

use App\Rules\MonthlyBalanceNumberOneByteRule;
use Illuminate\Foundation\Http\FormRequest;

class MonthlyBalanceRequest extends FormRequest
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
        $rule = [
            'data.*.date_year_registration' => ['required'],
            'data.*.revenue_land_taxes' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_room_rentals' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_service_charges' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_utilities' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_car_deposits' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.turnover_revenue' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_contract_update_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.revenue_other' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.bad_debt' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.maintenance_management_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.electricity_gas_charges' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.repair_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.recovery_costs' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.property_management_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.find_tenant_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.tax' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.loss_insurance' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.land_rental_fee' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.other_costs' => [new MonthlyBalanceNumberOneByteRule()],
            'data.*.operating_expenses' => ['regex: /^[0-9-]*$/'],
            'data.*.rental_percentage' => ['bail', 'nullable', 'regex: /^[0-9.]*$/', 'numeric', 'between: 0.0, 100.0'],
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
            'data.*.date_year_registration.required' => trans('validation.monthly_balance.please_choose'),
            'data.*.operating_expenses.regex' => trans('validation.monthly_balance.number_one_byte'),
            'data.*.rental_percentage.regex' => trans('validation.monthly_balance.number_and_dot_one_byte'),
            'data.*.rental_percentage.between' => trans('validation.monthly_balance.limit'),
        ];
    }
}
