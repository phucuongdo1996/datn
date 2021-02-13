<?php

namespace App\Http\Requests;

use App\Rules\CheckFloatSingleByteSimulation;
use App\Rules\PhoneNumberValidateRule;
use App\Rules\ZipCodeValidateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SimulationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required',
            'zipcode' => ['nullable', new ZipCodeValidateRule()],
            'address' => 'required',
            'province' => 'required',
            'uses' => 'required',
            'ground_area' => ['bail','required', new CheckFloatSingleByteSimulation(), 'numeric', 'between: 0.00,9999999.9', 'regex: /^(\d{1,7})(\.\d{1,2})?$/'],
            'total_area_floors' => ['bail', 'required', new CheckFloatSingleByteSimulation(), 'numeric', 'between: 0.00,9999999.9', 'regex: /^(\d{1,7})(\.\d{1,2})?$/'],
            'revenue_room_rentals' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'revenue_general_services' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'revenue_utilities' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'revenue_parking' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'income_input_money' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'income_update_house_contract' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'other_revenue' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'bad_debt' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'maintenance_management_fee' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'fee_utilities' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'repair_fee' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'fee_intact_reply' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'fee_property_management' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'fee_recruitment_rental' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'tax' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'loss_insurance' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'land_tax' => ['nullable', new PhoneNumberValidateRule(), 'integer'], //18
            'other_fees' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'house_price' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'personal_money_spent' => ['nullable', new PhoneNumberValidateRule(), 'integer'],
            'interest' => ['bail', 'nullable', new CheckFloatSingleByteSimulation(), 'numeric', 'between: 0.00,99.99', 'regex: /^(\d{1,2})(\.\d{1,2})?$/'],
            'year' => 'required',
        ];
        if ($request->uses == FLAG_NINE || $request->uses == FLAG_TEN) {
            $rules[ 'construction_time'] = ['bail', 'nullable', 'date_format:Y/m/d'];
        } else {
            $rules[ 'construction_time'] = ['bail', 'required', 'date_format:Y/m/d'];
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('validation.simulation.name_required'),
            'address.required' => trans('validation.simulation.select_required'),
            'province.required' => trans('validation.simulation.select_required'),
            'uses.required' => trans('validation.simulation.select_required'),
            'construction_time.date_format' => trans('validation.simulation.date_format'),
            'ground_area.regex' => trans('validation.simulation.correct_format'),
            'construction_time.required' => trans('validation.simulation.name_required'),
            'ground_area.required' => trans('validation.simulation.name_required'),
            'total_area_floors.required' => trans('validation.simulation.name_required'),
            'ground_area.between' => trans('validation.simulation.correct_format'),
            'total_area_floors.regex' => trans('validation.simulation.correct_format'),
            'total_area_floors.between' => trans('validation.simulation.correct_format'),
            'interest.regex' => trans('validation.simulation.interest_correct_format'),
            'interest.between' => trans('validation.simulation.interest_correct_format'),
            'integer' => trans('validation.simulation.integer'),
            'year.required' => trans('validation.simulation.select_required'),
            'numeric' => trans('validation.profile.phone.format'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'ground_area' => '土地延べ面積',
            'total_area_floors' => '建物延床面積',
        ];
    }
}
