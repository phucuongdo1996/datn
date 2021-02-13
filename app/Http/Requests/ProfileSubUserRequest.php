<?php

namespace App\Http\Requests;

use App\Rules\AddressValidateRule;
use App\Rules\AvatarValidateRule;
use App\Rules\CharacterDoubleByteKatakana;
use App\Rules\CharacterJapanDoubleByte;
use App\Rules\CheckSpecialCharacters;
use App\Rules\DateTimeValidateRule;
use App\Rules\EmailProfileValidateRule;
use App\Rules\NickNameValidateRule;
use App\Rules\PhoneNumberValidateRule;
use App\Rules\ValidationMailOfNetwork;
use App\Rules\ZipCodeValidateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileSubUserRequest extends FormRequest
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
        return [
            'avatar' => [new AvatarValidateRule()],
            'nick_name' => ['bail', 'required', 'max:10', new NickNameValidateRule()],
            'person_charge_first_name' => ['required', new CharacterJapanDoubleByte()],
            'person_charge_last_name' => ['required', new CharacterJapanDoubleByte()],
            'person_charge_first_name_kana' => ['required', new CharacterDoubleByteKatakana()],
            'person_charge_last_name_kana' => ['required', new CharacterDoubleByteKatakana()],
            'gender' => 'required',
            'birthday' => ['required', new DateTimeValidateRule()],
            'email' => ['required','unique:users,email,'.$request->user_id, new EmailProfileValidateRule(), new ValidationMailOfNetwork()],
            'company_name' => new CheckSpecialCharacters(),
            'division' => new CheckSpecialCharacters(),
            'company_representative_last_name' => new CharacterJapanDoubleByte(),
            'company_representative_first_name' => new CharacterJapanDoubleByte(),
            'phone' => ['required', new PhoneNumberValidateRule()],
            'zip_code' => ['required', new ZipCodeValidateRule()],
            'address_city' => ['required'],
            'address_district' => ['required', new AddressValidateRule()],
            'address_town' => ['required', new AddressValidateRule()],
            'address_building' => new AddressValidateRule(),
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
            'nick_name.required' => trans('validation.profile.required'),
            'nick_name.max' => ' ',
            'person_charge_first_name.required' => trans('validation.profile.required'),
            'person_charge_last_name.required' => trans('validation.profile.required'),
            'person_charge_first_name_kana.required' => trans('validation.profile.required'),
            'person_charge_last_name_kana.required' => trans('validation.profile.required'),
            'gender.required' => trans('validation.profile.please_choose'),
            'birthday.required' => trans('validation.profile.required'),
            'email.required' => trans('validation.register.email.required'),
            'email.unique' => trans('validation.register.email.unique_edit'),
            'company_representative_first_name.required' => trans('validation.profile.required'),
            'company_representative_last_name.required' => trans('validation.profile.required'),
            'phone.required' => trans('validation.profile.required'),
            'zip_code.required' => trans('validation.profile.required'),
            'address_city.required' => trans('validation.profile.please_choose'),
            'address_district.required' => trans('validation.profile.required'),
            'address_town.required' => trans('validation.profile.required'),
        ];
    }
}
