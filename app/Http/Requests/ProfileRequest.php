<?php

namespace App\Http\Requests;

use App\Rules\AddressValidateRule;
use App\Rules\AvatarValidateRule;
use App\Rules\CheckCharacterSingleByte;
use App\Rules\CharacterJapanDoubleByte;
use App\Rules\CharacterDoubleByteKatakana;
use App\Rules\CheckNumberSingleByte;
use App\Rules\CheckSpecialCharacters;
use App\Rules\DateTimeValidateRule;
use App\Rules\EmailProfileValidateRule;
use App\Rules\NickNameValidateRule;
use App\Rules\PhoneNumberValidateRule;
use App\Rules\ValidationMailOfNetwork;
use App\Rules\ZipCodeValidateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        $params = $request->all();
        $rule = [
            'avatar' => [new AvatarValidateRule()],
            'nick_name' => ['bail', 'required', 'max:10', new NickNameValidateRule()],
            'person_charge_first_name' => ['required', new CharacterJapanDoubleByte()],
            'person_charge_last_name' => ['required', new CharacterJapanDoubleByte()],
            'person_charge_first_name_kana' => ['required', new CharacterDoubleByteKatakana()],
            'person_charge_last_name_kana' => ['required', new CharacterDoubleByteKatakana()],
            'email' => ['required','unique:users,email,' . $params['user_id'], new EmailProfileValidateRule(), new ValidationMailOfNetwork()],
            'phone' => ['required', new PhoneNumberValidateRule()],
            'zip_code' => ['required', new ZipCodeValidateRule()],
            'address_city' => ['required'],
            'address_district' => ['required', new AddressValidateRule()],
            'address_town' => ['required', new AddressValidateRule()],
            'address_building' => [new AddressValidateRule()],
        ];
        if ($params['search_tool'] == PRESENTER) {
            $rule['presenter'] = ['required'];
        }
        if ($params['role'] == INVESTOR) {
            $rule['gender'] = ['required'];
            $rule['birthday'] = ['required', new DateTimeValidateRule()];
            $rule['company_name'] = [new CheckSpecialCharacters()];
            $rule['division'] = [new CheckSpecialCharacters()];
            $rule['company_representative_first_name'] = [new CharacterJapanDoubleByte()];
            $rule['company_representative_last_name'] = [new CharacterJapanDoubleByte()];
        } elseif ($params['role'] == BROKER) {
            if ($params['license_address'] == null && $params['license'] == null && $params['number_license'] == null) {
                $rule['license_number'] = ['required'];
            } else {
                $rule['license_address'] = ['required'];
                $rule['license'] = ['required', new CheckNumberSingleByte()];
                $rule['number_license'] = ['required', new CheckNumberSingleByte()];
            }
            $rule['specialty'] = ['required'];
            $rule['website_business_name'] = ['bail', 'nullable', 'url', new CheckCharacterSingleByte()];
            $rule['introduction'] = ['max:150'];
            if (isset($params['website_business_name_other'])) {
                $rule['website_business_name_other'] = ['bail', 'url', new CheckCharacterSingleByte()];
            }
            $rule['company_name'] = ['required', new CheckSpecialCharacters()];
            $rule['division'] = ['required', new CheckSpecialCharacters()];
            $rule['company_representative_first_name'] = ['required', new CharacterJapanDoubleByte()];
            $rule['company_representative_last_name'] = ['required', new CharacterJapanDoubleByte()];
        } else {
            $rule['specialty'] = ['required'];
            $rule['website_business_name'] = ['bail', 'nullable', 'url', new CheckCharacterSingleByte()];
            $rule['introduction'] = ['max:150'];
            if (isset($params['website_business_name_other'])) {
                $rule['website_business_name_other'] = ['bail', 'url', new CheckCharacterSingleByte()];
            }
            $rule['company_name'] = ['required', new CheckSpecialCharacters()];
            $rule['division'] = ['required', new CheckSpecialCharacters()];
            $rule['company_representative_first_name'] = ['required', new CharacterJapanDoubleByte()];
            $rule['company_representative_last_name'] = ['required', new CharacterJapanDoubleByte()];
        }
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
            'nick_name.required' => trans('validation.profile.required'),
            'nick_name.max' => ' ',
            'nick_name.regex' => ' ',
            'person_charge_first_name.required' => trans('validation.profile.required'),
            'person_charge_last_name.required' => trans('validation.profile.required'),
            'person_charge_first_name_kana.required' => trans('validation.profile.required'),
            'person_charge_last_name_kana.required' => trans('validation.profile.required'),
            'email.required' => trans('validation.register.email.required'),
            'email.unique' => trans('validation.register.email.unique_edit'),
            'phone.required' => trans('validation.profile.required'),
            'zip_code.required' => trans('validation.profile.required'),
            'address_city.required' => trans('validation.profile.please_choose'),
            'address_district.required' => trans('validation.profile.required'),
            'address_town.required' => trans('validation.profile.required'),
            'website_business_name.url' => trans('validation.profile.check_url_single_byte'),
            'website_business_name_other.url' => trans('validation.profile.check_url_single_byte'),
            'specialty.required' => trans('validation.profile.please_choose'),
            'qualification.required' => trans('validation.profile.please_choose'),
            'gender.required' => trans('validation.profile.please_choose'),
            'birthday.required' => trans('validation.profile.required'),
            'license_number.required' => trans('validation.profile.required'),
            'license_address.required' => trans('validation.profile.license_address.required'),
            'license.required' => trans('validation.profile.required'),
            'number_license.required' => trans('validation.profile.required'),
            'website_business_name.required' => trans('validation.profile.required'),
            'company_name.required' => trans('validation.profile.required'),
            'division.required' => trans('validation.profile.required'),
            'company_representative_first_name.required' => trans('validation.profile.required'),
            'company_representative_last_name.required' => trans('validation.profile.required'),
            'introduction.max' => ' ',
            'presenter.required' => trans('validation.profile.required'),
        ];
    }
}
