@extends('layout/base')
@section('content')
<div class="container-fluid container-wrapper p0 bg-white">
    <div class="container container-info">
        <form action="" id="form-data-profile">
            <div class="head">
                <div class="text-center"><div class="roll-text green-color d-inline-block">{{ __('attributes.profile.body.role_title_expert') }}</div></div>
                <input type="hidden" name="role" value="{{ EXPERT }}">
                <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
                <h1 class="text-center fw-bold">{{ __('attributes.profile.header.title') }}</h1>
            </div>
            @include('partials.flash_messages')
            @include('profiles.header_info')
            <table class="table table-bordered">
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.specialty') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required_two') }}</label>
                    </td>
                    <td>
                        <div class="row d-block p20l">
                        @foreach($specialties as $value)
                            <label class="container-input fs14 fw-bold width-fit-content">
                                <input type="checkbox" class="pointer profile-setting checkbox-specialty cus-checkbox progress-calculate-checkbox" value="{{ $value['id'] }}" name="specialty[{{ $value['id'] }}]" >
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
                        <span>{{ __('attributes.profile.body.label.name_responsible') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" name="person_charge_last_name" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_last_name"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" name="person_charge_first_name" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.first_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_first_name"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.kana_responsible') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.kana_last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" name="person_charge_last_name_kana" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.kana_last_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_last_name_kana"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.kana_first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" name="person_charge_first_name_kana" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.kana_first_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_first_name_kana"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.email') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <div class="col-md-12 p0l p0r">
                                <input type="text" name="email" value="{{ $currentUser->email }}" class="form-control col-10 fs13 profile-setting progress-calculate">
                            </div>
                            <p class="error-message p5t m0" data-error="email"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.name_trademark') }}</span>
                    <td>
                        <div class="row p20l">
                            <div class="col-md-12 p0l p0r">
                                <input type="text" name="business_name" class="form-control col-10 fs13 profile-setting not-required progress-calculate"
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
                            <div class="col-md-12 p0l p0r">
                                <input type="text" name="website_business_name" class="form-control col-10 fs13 profile-setting not-required progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.web') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="website_business_name"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.name_company') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <div class="col-10 col-md-5 p0l p0r">
                                <input type="text" name="company_name" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.company') }}">
                                <p class="error-message p5t m0" data-error="company_name"></p>
                            </div>
                            <span class="col-10 d-none d-md-block col-md-1 text-center fs20">/</span>
                            <div class="col-10 col-md-5 p0l p0r">
                                <input type="text" name="division" class="form-control fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.division') }}">
                                <p class="error-message p5t m0" data-error="division"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.club') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" class="form-control fs13 profile-setting progress-calculate" name="company_representative_last_name"
                                       placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                                <p class="error-message p5t m0" data-error="company_representative_last_name"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center lh3 p0">{{ __('attributes.profile.body.content.first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" class="form-control fs13 profile-setting progress-calculate" name="company_representative_first_name"
                                       placeholder="{{ __('attributes.profile.body.place_holder.first_name') }}">
                                <p class="error-message p5t m0" data-error="company_representative_first_name"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.phone_number') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <div class="col-md-12 p0l">
                                <input type="text" name="phone" class="form-control col-11 col-md-5 fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.phone') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="phone"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.ZIP_code') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <div class="col-md-12 p0l">
                                <input type="text" name="zip_code" class="form-control col-11 col-md-5 fs13 profile-setting zip-code progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.ZIP_code') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="zip_code"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.address_city') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
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
                                <input type="text" name="address_district" class="form-control col-11 col-md-5 fs13 profile-setting progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.address_district') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="address_district"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.address_2') }}</span><label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <input type="text" name="address_town" class="form-control col-11 fs13 profile-setting progress-calculate" placeholder="{{ __('attributes.profile.body.place_holder.address_2') }}">
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
                            <input type="text" name="address_building" class="form-control col-11 fs13 profile-setting not-required progress-calculate"
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
                                <input type="text" name="website_business_name_other" class="form-control col-11 fs13 profile-setting not-required progress-calculate"
                                       placeholder="{{ __('attributes.profile.body.place_holder.other_web') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="website_business_name_other"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.how_did_you_know') }}</span>
                    </td>
                    <td>
                        <div class="row p20l">
                            <select name="search_tool" class="form-control col-11 col-md-5 fs13 not-required search-tool progress-calculate">
                                <option value="">---</option>
                                @foreach(SEARCH_TOOL as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="col-11 col-md-1"></div>
                            <div class="col-11 col-md-5 p0l p0r">
                                <input name="presenter" class="form-control fs13 not-required presenter d-none"
                                       placeholder="{{ trans('attributes.profile.body.place_holder.owner') }}">
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
                            <textarea name="introduction" class="form-control col-11 profile-setting not-required progress-calculate" rows="7"></textarea>
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
            @include('profiles.footer_info')
        </form>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('/dist/js/profile.min.js') }}"></script>
@endsection
