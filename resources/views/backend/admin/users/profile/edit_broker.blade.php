<div class="container container-info">
    <form action="" id="form-data-profile">
        <div class="head">
            <div class="text-center"><div class="roll-text red-color d-inline-block">{{ __('attributes.profile.body.role_title_broker') }}</div></div>
            <input type="hidden" name="role" value="{{ BROKER }}">
            <input type="hidden" name="user_id" value="{{ $profile['user_id'] ?? null }}">
            <input type="hidden" name="profile_id" value="{{ $profile['id'] }}">
            <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
            <h1 class="text-center fw-bold">{{ __('attributes.profile.header.title_update') }}</h1>
        </div>
        @include('profiles.header_info')
        <table class="table table-bordered">
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.specialty') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required_one') }}</label>
                </td>
                <td>
                    <div class="row d-block p20l">
                        @foreach($specialties as $value)
                            <label class="container-input fs14 fw-bold width-fit-content">
                                <input type="checkbox" class="pointer checkbox-specialty cus-checkbox" value="{{ $value['id'] }}" name="specialty[]"
                                       @if(in_array($value['id'], $profile['specialties'])) checked @endif>
                                <span class="checkmark"></span>
                                {{ $value['name'] }}
                            </label><br>
                        @endforeach
                        <p class="error-message p5t m0" data-error="specialty"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.name_responsible') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <label class="col-2 col-md-1 text-left p0 lh3">{{ __('attributes.profile.body.content.last_name') }}</label>
                        <div class="col-9 col-md-4 p0l">
                            <input type="text" name="person_charge_last_name" class="form-control error-color fs13" value="{{ $profile['person_charge_last_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                            <p class="error-message p5t m0" data-error="person_charge_last_name"></p>
                        </div>
                        <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.first_name') }}</label>
                        <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                            <input type="text" name="person_charge_first_name" class="form-control error-color fs13" value="{{ $profile['person_charge_first_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.first_name') }}">
                            <p class="error-message p5t m0" data-error="person_charge_first_name"></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.kana_responsible') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <label class="col-2 col-md-1 text-left p0 lh3">{{ __('attributes.profile.body.content.kana_last_name') }}</label>
                        <div class="col-9 col-md-4 p0l">
                            <input type="text" name="person_charge_last_name_kana" class="form-control fs13" value="{{ $profile['person_charge_last_name_kana'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.kana_last_name') }}">
                            <p class="error-message p5t m0" data-error="person_charge_last_name_kana"></p>
                        </div>
                        <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.kana_first_name') }}</label>
                        <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                            <input type="text" name="person_charge_first_name_kana" class="form-control fs13" value="{{ $profile['person_charge_first_name_kana'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.kana_first_name') }}">
                            <p class="error-message p5t m0" data-error="person_charge_first_name_kana"></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.email') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l p0r input-md-pr">
                            <input type="text" name="email" value="{{ $profile['email'] ?? '' }}" class="form-control col-11 col-md-10 fs13">
                        </div>
                        <p class="error-message p5t m0" data-error="email"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.name_trademark') }}</span>
                <td>
                    <div class="row p20l ">
                        <div class="col-md-12 p0l p0r input-md-pr">
                            <input type="text" name="business_name" class="form-control col-11 col-md-10 fs13 not-required" value="{{ $profile['business_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.name_trademark') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="business_name"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.web') }}</span>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l p0r input-md-pr">
                            <input type="text" name="website_business_name" class="form-control col-11 col-md-10 fs13" value="{{ $profile['website_business_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.web') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="website_business_name"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.name_company') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-10 col-md-5 p0l p0r">
                            <input type="text" name="company_name" class="form-control fs13" value="{{ $profile['company_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.company') }}">
                            <p class="error-message p5t m0" data-error="company_name"></p>
                        </div>
                        <span class="col-10 col-md-1 d-none d-md-block text-center fs20">/</span>
                        <div class="col-10 col-md-5 p0l p0r">
                            <input type="text" name="division" class="form-control fs13" value="{{ $profile['division'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.division') }}">
                            <p class="error-message p5t m0" data-error="division"></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.club') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.last_name') }}</label>
                        <div class="col-9 col-md-4 p0l">
                            <input type="text" class="form-control fs13" name="company_representative_last_name" value="{{ $profile['company_representative_last_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                            <p class="error-message p5t m0" data-error="company_representative_last_name"></p>
                        </div>
                        <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.first_name') }}</label>
                        <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                            <input type="text" class="form-control fs13" name="company_representative_first_name" value="{{ $profile['company_representative_first_name'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.first_name') }}">
                            <p class="error-message p5t m0" data-error="company_representative_first_name"></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.license_number') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l p30r row-license">
                        <div class="col-8 col-md-3 p0l p0r">
                            <select name="license_address" class="form-control license_address fs13">
                                <option value="{{null}}">---</option>
                                @foreach(LICENSES as $license)
                                    <option value="{{ $license }}" @if($license == $profile['license_address']) selected @endif>{{ $license }}</option>
                                @endforeach
                            </select>
                            <p class="error-message p5t m0" data-error="license_address"></p>
                            <p class="error-message p5t m0" data-error="license_number"></p>
                        </div>
                        <span class="col-4 col-md-1 text-center fs13 lh3 p0r p0-under-md">{{ __('attributes.profile.body.content.license_number') }}</span>
                        <span class="col-1 col-md-1 text-center fs13 lh3">(</span>
                        <div class="col-5 col-md-2 p0l p0r">
                            <input type="text" name="license" maxlength="2" class="form-control fs13" value="{{ $profile['license'] ?? '' }}">
                            <p class="error-message p5t m0" data-error="license"></p>
                        </div>
                        <span class="col-1 col-md-1 text-center fs13 lh3">)</span>
                        <span class="col-2 col-md-1 text-center fs13 lh3 p0-under-md">{{ __('attributes.profile.body.content.license_number_1') }}</span>
                        <div class="col-8 col-md-2 p0l p0r">
                            <input type="text" name="number_license" maxlength="6" class="form-control fs13" placeholder="" value="{{ $profile['number_license'] ?? '' }}">
                            <p class="error-message p5t m0" data-error="number_license"></p>
                        </div>
                        <span class="col-4 col-md-1 text-center fs13 lh3">{{ __('attributes.profile.body.content.number') }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.phone_number') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l">
                            <input type="text" name="phone" class="form-control col-11 col-md-6 fs13" value="{{ $profile['phone'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.phone') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="phone"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.ZIP_code') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l">
                            <input type="text" name="zip_code" class="form-control col-11 col-md-6 fs13 zip-code" value="{{ $profile['zip_code'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.ZIP_code') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="zip_code"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.address_city') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l">
                            @include('profiles.province')
                        </div>
                        <p class="error-message p5t m0" data-error="address_city"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.address_district') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l">
                            <input type="text" name="address_district" class="form-control col-11 col-md-6 fs13" value="{{ $profile['address_district'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.address_district') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="address_district"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.address_2') }}</span>
                    <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                </td>
                <td>
                    <div class="row p20l">
                        <input type="text" name="address_town" class="form-control col-11 fs13" value="{{ $profile['address_town'] ?? '' }}"
                               placeholder="{{ __('attributes.profile.body.place_holder.address_2') }}">
                        <p class="error-message p5t m0" data-error="address_town"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.address_3') }}</span>
                </td>
                <td>
                    <div class="row p20l">
                        <input type="text" name="address_building" class="form-control col-11 fs13 not-required" value="{{ $profile['address_building'] ?? '' }}"
                               placeholder="{{ __('attributes.profile.body.place_holder.address_3') }}">
                        <p class="error-message p5t m0" data-error="address_building"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.other_web') }}</span>
                </td>
                <td>
                    <div class="row p20l">
                        <div class="col-md-12 p0l p0r">
                            <input type="text" name="website_business_name_other" class="form-control col-11 fs13 not-required" value="{{ $profile['website_business_name_other'] ?? '' }}"
                                   placeholder="{{ __('attributes.profile.body.place_holder.other_web') }}">
                        </div>
                        <p class="error-message p5t m0" data-error="website_business_name_other"></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ trans('attributes.profile.body.label.how_did_you_know') }}</span>
                </td>
                <td>
                    <div class="row p20l">
                        <select name="search_tool" class="form-control col-11 col-md-5 fs13 not-required search-tool">
                            <option value="">---</option>
                            @foreach(SEARCH_TOOL as $value)
                                <option value="{{ $value }}" @if($profile['search_tool'] == $value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="col-11 col-md-1"></div>
                        <div class="col-11 col-md-5 p0l p0r">
                            <input name="presenter" class="form-control fs13 presenter @if($profile['search_tool'] != PRESENTER) d-none @endif"
                                   placeholder="{{ trans('attributes.profile.body.place_holder.owner') }}" value="{{ $profile['presenter'] }}">
                            <p class="error-message p5t m0 presenter-error" data-error="presenter"></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-info">
                    <span>{{ __('attributes.profile.body.label.introduction') }}</span>
                </td>
                <td>
                    <div class="row p20l">
                        <textarea name="introduction" class="form-control col-11 not-required" rows="7">{{ $profile['introduction'] ?? '' }}</textarea>
                        <p class="m5t max_character">{{ __('attributes.profile.body.content.max_characters') }}</p>
                    </div>
                </td>
            </tr>
        </table>
        <div class="col-12 error-register-info">
                <span class="text-danger">{{ trans('attributes.register_info.profile_exist.error_message_1') }}
                    <a href="{{ route(USER_HOME) }}">{{ trans('attributes.register_info.profile_exist.link_home') }}</a>
                    {{ trans('attributes.register_info.profile_exist.error_message_2') }}</span>
        </div>
    </form>
</div>
