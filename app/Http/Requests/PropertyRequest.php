<?php

namespace App\Http\Requests;

use App\Rules\AreaRentalOperatingRule;
use App\Rules\DateTimeValidateRule;
use App\Rules\InterestRateValidationRule;
use App\Rules\PhoneNumberValidateRule;
use App\Rules\TrimCustom;
use Illuminate\Foundation\Http\FormRequest;
use DateTime;

class PropertyRequest extends FormRequest
{
    /**
     * Format date
     */
    public function convertDateProperty()
    {
        $request = [];
        if (request()->has('receive_house_date') && !empty(request('receive_house_date'))) {
            $request['receive_house_date'] = date_format(date_create(request('receive_house_date')), 'Y-m-d');
        }

        if (request()->has('loan_date') && !empty(request('loan_date'))) {
            $request['loan_date'] = date_format(date_create(request('loan_date')), 'Y-m-d');
        }

        if (request()->has('construction_time') && !empty(request('construction_time'))) {
            $request['construction_time'] = date_format(date_create(request('construction_time')), 'Y-m-d');
        }

        if (request()->has('rental_period_from') && !empty(request('rental_period_from'))) {
            $request['rental_period_from'] = date_format(date_create(request('rental_period_from')), 'Y-m-d');
        }

        if (request()->has('date_lease') && !empty(request('date_lease'))) {
            $request['date_lease'] = date_format(date_create(request('date_lease')), 'Y-m-d');
        }

        if (request()->has('rental_period_to') && !empty(request('rental_period_to'))) {
            $request['rental_period_to'] = date_format(date_create(request('rental_period_to')), 'Y-m-d');
        }

        return request()->merge($request)->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->request->all();
        $rule =  [
            'avatar' => ['nullable', 'mimes:jpeg,png', 'max:5120'],
            'status' => ['required'],
            'receive_house_date' => ['nullable', 'date_format:Y/m/d'],
            'loan_date' => ['nullable', 'date_format:Y/m/d'],
            'money_receive_house' => [new PhoneNumberValidateRule()],
            'loan' => [new PhoneNumberValidateRule()],
            'interest_rate' => ['bail', 'nullable', 'regex: /^[0-9-.]*$/', 'numeric', 'between: 0.00, 99.99', new InterestRateValidationRule()],
            'house_name' => ['required', new TrimCustom()],
            'zip_code' => ['nullable', 'regex: /^[0-9]{7}$/'],
            'address_city' => ['required'],
//            'address_district' => ['required'],
            'address_town' => ['required'],
            'real_estate_type_id' => ['required'],
            'date_month_registration_revenue' => ['required'],
            'date_year_registration_revenue' => ['required'],
            'ground_area' => ['regex: /^[0-9-.]*$/'],
            'total_area_floors' => ['regex: /^[0-9-.]*$/'],
            'construction_time' => ['nullable', 'date_format:Y/m/d'],
            'total_tenants' => [new PhoneNumberValidateRule()],
            'area_may_rent' => ['regex: /^[0-9-.]*$/'],
            'deposits' => [new PhoneNumberValidateRule()],
            'area_rent' => ['regex: /^[0-9-.]*$/'],
            'rental_period_from' => ['nullable', 'date_format:Y/m/d'],
            'rental_period_to' => ['nullable', 'date_format:Y/m/d'],
            'date_lease' => ['nullable', 'date_format:Y/m/d'],
            'revenue_land_taxes' => [new PhoneNumberValidateRule()],
            'revenue_room_rentals' => [new PhoneNumberValidateRule()],
            'revenue_service_charges' => [new PhoneNumberValidateRule()],
            'revenue_utilities' => [new PhoneNumberValidateRule()],
            'revenue_car_deposits' => [new PhoneNumberValidateRule()],
            'turnover_revenue' => [new PhoneNumberValidateRule()],
            'revenue_contract_update_fee' => [new PhoneNumberValidateRule()],
            'revenue_other' => [new PhoneNumberValidateRule()],
            'bad_debt' => [new PhoneNumberValidateRule()],
            'maintenance_management_fee' => [new PhoneNumberValidateRule()],
            'electricity_gas_charges' => [new PhoneNumberValidateRule()],
            'repair_fee' => [new PhoneNumberValidateRule()],
            'recovery_costs' => [new PhoneNumberValidateRule()],
            'property_management_fee' => [new PhoneNumberValidateRule()],
            'find_tenant_fee' => [new PhoneNumberValidateRule()],
            'tax' => [new PhoneNumberValidateRule()],
            'loss_insurance' => [new PhoneNumberValidateRule()],
            'land_rental_fee' => [new PhoneNumberValidateRule()],
            'other_costs' => [new PhoneNumberValidateRule()],
            'area_rental_operating' => ['regex: /^[0-9-.]*$/', new AreaRentalOperatingRule($data['area_may_rent'])],
            'rental_percentage' => ['nullable', 'regex: /^[0-9.%]*$/'],
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
            'avatar.mimes' => trans('validation.property.avatar_image'),
            'avatar.max' => trans('validation.property.avatar_max_size'),
            'house_name.required' => trans('validation.property.required'),
            'status.required' => trans('validation.property.please_choose'),
            'address_city.required' => trans('validation.property.please_choose'),
//            'address_district.required' => trans('validation.property.please_choose'),
            'address_town.required' => trans('validation.property.required'),
            'real_estate_type_id.required' => trans('validation.property.please_choose'),
            'date_month_registration_revenue.required' => trans('validation.property.please_choose'),
            'date_year_registration_revenue.required' => trans('validation.property.please_choose'),
            'zip_code.regex' => trans('validation.property.zip_code'),
            'interest_rate.regex' => trans('validation.profile.phone.format'),
            'rental_percentage.regex' => trans('validation.profile.phone.format'),
            'between' => trans('validation.property.interest_rate'),
            'receive_house_date.date_format' => trans('validation.simulation.date_format'),
            'loan_date.date_format' => trans('validation.simulation.date_format'),
            'construction_time.date_format' => trans('validation.simulation.date_format'),
            'rental_period_from.date_format' => trans('validation.simulation.date_format'),
            'rental_period_to.date_format' => trans('validation.simulation.date_format'),
            'date_lease.date_format' => trans('validation.simulation.date_format'),
        ];
    }
}
