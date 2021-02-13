@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper p0 bg-white">
    <div class="container container-info">
        <input id="profile-id-check" type="hidden" name="profile_id" value="{{ $profile['id'] }}">
        <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
        <form action="" id="form-data-profile">
            <div class="head">
                <div class="text-center"><div class="roll-text orange-color d-inline-block">{{ __('attributes.profile.body.role_title_investor') }}</div></div>
                <input type="hidden" name="role" value="{{ INVESTOR }}">
                <input type="hidden" name="user_id" value="{{ $profile['user_id'] }}">
                <h1 class="text-center fw-bold">{{ __('attributes.profile.header.title_update') }}</h1>
            </div>
            @include('partials.flash_messages')
            @include('profiles.header_info')
            <table class="table table-bordered">
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.name_responsible') }}</span>
                        <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" name="person_charge_last_name" class="form-control fs13 progress-calculate" value="{{ $profile['person_charge_last_name'] ?? '' }}"
                                       placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_last_name"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ __('attributes.profile.body.content.first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" name="person_charge_first_name" class="form-control fs13 progress-calculate" value="{{ $profile['person_charge_first_name'] ?? '' }}"
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
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.kana_last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" name="person_charge_last_name_kana" class="form-control fs13 progress-calculate" value="{{ $profile['person_charge_last_name_kana'] ?? '' }}"
                                       placeholder="{{ __('attributes.profile.body.place_holder.kana_last_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_last_name_kana"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ __('attributes.profile.body.content.kana_first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" name="person_charge_first_name_kana" class="form-control fs13 progress-calculate" value="{{ $profile['person_charge_first_name_kana'] ?? '' }}"
                                       placeholder="{{ __('attributes.profile.body.place_holder.kana_first_name') }}">
                                <p class="error-message p5t m0" data-error="person_charge_first_name_kana"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.birth_day_and_gender') }}</span>
                        <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <select name="gender" class="form-control col-10 col-md-2 m5b fs13 progress-calculate">
                                <option value="0" @if($profile['gender'] == FLAG_ZERO) selected @endif>{{ __('attributes.common.male') }}</option>
                                <option value="1" @if($profile['gender'] == FLAG_ONE) selected @endif>{{ __('attributes.common.female') }}</option>
                            </select>
                            <p class="error-message" data-error="gender"></p>
                            <span class="col-10 col-md-1 d-none d-md-block text-center fs20">/</span>

                            <div class="col-10 col-md-3 p0l p0r">
                                <input type="text" name="birthday" id="date-picker" class="form-control fs13 progress-calculate" value="{{ $profile['birthday'] ? dateTimeFormat($profile['birthday']) : '' }}">
                                <p class="error-message p5t m0" data-error="birthday"></p>
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
                            <div class="col-10 col-md-8 p0l p0r">
                                <input type="text" name="email" value="{{ $profile['email'] ?? '' }}" class="form-control fs13 progress-calculate">
                            </div>
                            <p class="error-message p5t m0" data-error="email"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.name_company') }}</span>
                    </td>
                    <td>
                        <div class="row p20l">
                            <div class="col-10 col-md-5 p0l p0r">
                                <input type="text" name="company_name" class="form-control fs13 not-required progress-calculate" value="{{ $profile['company_name'] ?? '' }}"
                                       placeholder="{{ __('attributes.profile.body.place_holder.company') }}">
                                <p class="error-message p5t m0" data-error="company_name"></p>
                            </div>
                            <span class="col-10 col-md-1 d-none d-md-block text-center fs20">/</span>
                            <div class="col-10 col-md-5 p0l p0r">
                                <input type="text" name="division" class="form-control fs13 not-required progress-calculate" value="{{ $profile['division'] ?? '' }}"
                                       placeholder="{{ __('attributes.profile.body.place_holder.division') }}">
                                <p class="error-message p5t m0" data-error="division"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.club') }}</span>
                    </td>
                    <td>
                        <div class="row p20l">
                            <label class="col-2 col-md-1 text-left lh3 p0">{{ __('attributes.profile.body.content.last_name') }}</label>
                            <div class="col-9 col-md-4 p0l">
                                <input type="text" class="form-control fs13 not-required progress-calculate" name="company_representative_last_name"
                                       value="{{ $profile['company_representative_last_name'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.last_name') }}">
                                <p class="error-message p5t m0" data-error="company_representative_last_name"></p>
                            </div>
                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ __('attributes.profile.body.content.first_name') }}</label>
                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                <input type="text" class="form-control fs13 not-required progress-calculate" name="company_representative_first_name"
                                       value="{{ $profile['company_representative_first_name'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.first_name') }}">
                                <p class="error-message p5t m0" data-error="company_representative_first_name"></p>
                            </div>
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
                                <input type="text" name="phone" class="form-control col-11 col-md-6 fs13 progress-calculate"
                                       value="{{ $profile['phone'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.phone') }}">
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
                                <input type="text" name="zip_code" class="form-control col-11 col-md-6 fs13 zip-code progress-calculate"
                                       value="{{ $profile['zip_code'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.ZIP_code') }}">
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
                                <input type="text" name="address_district" class="form-control col-11 col-md-6 fs13 progress-calculate"
                                       value="{{ $profile['address_district'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.address_district') }}">
                            </div>
                            <p class="error-message p5t m0" data-error="address_district"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.address_2') }} </span>
                        <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
                    </td>
                    <td>
                        <div class="row p20l">
                            <input type="text" class="form-control col-11 fs13 progress-calculate" name="address_town"
                                   value="{{ $profile['address_town'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.address_2') }}">
                            <p class="error-message p5t m0" data-error="address_town"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.address_3') }} </span>
                    </td>
                    <td>
                        <div class="row p20l">
                            <input type="text" class="form-control col-11 not-required fs13 progress-calculate" name="address_building"
                                   value="{{ $profile['address_building'] ?? '' }}" placeholder="{{ __('attributes.profile.body.place_holder.address_3') }}">
                            <p class="error-message p5t m0" data-error="address_building"></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ trans('attributes.profile.body.label.how_did_you_know') }}</span>
                    </td>
                    <td>
                        <div class="row p20l">
                            <select name="search_tool" class="form-control col-11 col-md-5 fs13 not-required search-tool progress-calculate">
                                <option value="">---</option>
                                @foreach(SEARCH_TOOL as $value)
                                    <option value="{{ $value }}" @if($profile['search_tool'] == $value) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="col-11 col-md-1"></div>
                            <div class="col-11 col-md-5 p0l p0r">
                                <input name="presenter" class="form-control fs13 presenter not-required @if($profile['search_tool'] != PRESENTER) d-none @endif"
                                       placeholder="{{ trans('attributes.profile.body.place_holder.owner') }}" value="{{ $profile['presenter'] }}">
                                <p class="error-message p5t m0 presenter-error" data-error="presenter"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label-info">
                        <span>{{ __('attributes.profile.body.label.information_from_CYARea') }}</span>
                    </td>
                    <td>
                    <div class="row p20l">
                        <div class="col-12 col-md-4 p0l">
                            <label class="container-input p30l">
                                <input type="radio" name="notification" class="input-notification" value="0" id="notification" @if($profile['notification'] == FLAG_ZERO) checked @endif>
                                <span class="checkmark-radio"></span>
                                {{ __('attributes.profile.body.content.wish_to_notification') }}
                            </label>
                        </div>
                        <div class="col-12 col-md-4 p0l">
                            <label class="container-input p30l">
                                <input type="radio" name="notification" class="input-notification"  value="1" id="notification" @if($profile['notification'] == FLAG_ONE) checked @endif>
                                <span class="checkmark-radio"></span>
                                {{ __('attributes.profile.body.content.dont_want_notification') }}
                            </label>
                        </div>
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
