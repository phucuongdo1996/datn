@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-sub-user">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="form-data-profile">
                            <input type="hidden" class="parent-id" value="{{ $parentId }}">
                            <div class="head">
                                <h1 class="text-center fw-bold">{{ trans('attributes.sub_user.add.title') }}</h1>
                            </div>
                            <p class="attention text-center fs12"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ trans('attributes.profile.header.attention') }}</p>
                            @include('partials.flash_messages')
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="label-info">{{ trans('attributes.profile.header.label_avatar') }}</td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-12 col-md-3 p0l m5b">
                                                @if(isset($profile) && isset($profile['avatar_thumbnail']))
                                                    <div id="image-avatar" class="avatar essential-icon-img pointer">
                                                        <img class="img-preview-map" src="{{ asset('storage/' . FOLDER_IMAGES_PROFILE . '/' . $profile['avatar_thumbnail']) }}">
                                                    </div>
                                                @else
                                                    <div id="image-avatar" class="avatar essential-icon-img pointer">
                                                        <img src="{{ asset('images/icon-img.png') }}">
                                                    </div>
                                                @endif
                                            </div>
                                            <input id="input-avatar" type="file" name="avatar" class="d-none">
                                            <input type="hidden" name="user_id" value="{{ $profile['user_id'] }}">
                                            <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>

                                            <div class="col-md-9 p0l">
                                                <p class="fs16 fw-bold m5b">{{ trans('attributes.profile.header.note_avatar_1') }}</p>
                                                <p class="m5b d-none d-lg-block">{{ trans('attributes.profile.header.note_avatar_2') }}</p>
                                                <p class="fs10 mb-0">{{ trans('attributes.profile.header.note_avatar_3') }}</p>
                                                <p class="fs10 mb-0">{{ trans('attributes.profile.header.note_avatar_4') }}</p>
                                                <p class="fs10 mb-0">{{ trans('attributes.profile.header.note_avatar_5') }}</p>
                                            </div>
                                            <p class="error-messages" data-error="avatar"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.header.label_nickname') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l p20r">
                                            <p class=" note_nickname">{{ trans('attributes.profile.header.note_nickname') }}</p>
                                            <input id="nick_name" type="text" name="nick_name" class="form-control profile-setting" value="{{ $profile['nick_name'] ?? '' }}">
                                            <p class="error-message p5t" data-error="nick_name"></p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.name_responsible') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <label class="col-2 col-md-1 text-left lh3 p0">{{ trans('attributes.profile.body.content.last_name') }}</label>
                                            <div class="col-9 col-md-4 p0l">
                                                <input type="text" name="person_charge_last_name" class="form-control fs13" value="{{ $profile['person_charge_last_name'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.last_name') }}">
                                                <p class="error-message p5t m0" data-error="person_charge_last_name"></p>
                                            </div>
                                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ trans('attributes.profile.body.content.first_name') }}</label>
                                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                                <input type="text" name="person_charge_first_name" class="form-control fs13" value="{{ $profile['person_charge_first_name'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.first_name') }}">
                                                <p class="error-message p5t m0" data-error="person_charge_first_name"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.kana_responsible') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <label class="col-2 col-md-1 text-left lh3 p0">{{ trans('attributes.profile.body.content.kana_last_name') }}</label>
                                            <div class="col-9 col-md-4 p0l">
                                                <input type="text" name="person_charge_last_name_kana" class="form-control fs13" value="{{ $profile['person_charge_last_name_kana'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.kana_last_name') }}">
                                                <p class="error-message p5t m0" data-error="person_charge_last_name_kana"></p>
                                            </div>
                                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ trans('attributes.profile.body.content.kana_first_name') }}</label>
                                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                                <input type="text" name="person_charge_first_name_kana" class="form-control fs13" value="{{ $profile['person_charge_first_name_kana'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.kana_first_name') }}">
                                                <p class="error-message p5t m0" data-error="person_charge_first_name_kana"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.birth_day_and_gender') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <select name="gender" class="form-control col-10 col-md-2 m5b fs13">
                                                <option value="0" @if($profile['gender'] == FLAG_ZERO) selected @endif>{{ __('attributes.common.male') }}</option>
                                                <option value="1" @if($profile['gender'] == FLAG_ONE) selected @endif>{{ __('attributes.common.female') }}</option>
                                            </select>
                                            <p class="error-message" data-error="gender"></p>
                                            <span class="col-10 col-md-1 d-none d-md-block text-center fs20">/</span>

                                            <div class="col-10 col-md-3 p0l p0r">
                                                <input type="text" name="birthday" id="date-picker" class="form-control fs13" value="{{ $profile['birthday'] ? dateTimeFormat($profile['birthday']) : '' }}">
                                                <p class="error-message p5t m0" data-error="birthday"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.email') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-10 col-md-8 p0l p0r">
                                                <input type="text" name="email" value="{{ $profile['email'] ?? '' }}" class="form-control fs13" placeholder="abcde@sample.jp">
                                            </div>
                                        </div>
                                        <div class="row p20l">
                                            <p class="error-message p5t m0" data-error="email"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.name_company') }}</span>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-10 col-md-5 p0l p0r">
                                                <input type="text" name="company_name" class="form-control fs13 not-required" value="{{ $profile['company_name'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.company') }}">
                                                <p class="error-message p5t m0" data-error="company_name"></p>
                                            </div>
                                            <span class="col-10 col-md-1 d-none d-md-block text-center fs20">/</span>
                                            <div class="col-10 col-md-5 p0l p0r">
                                                <input type="text" name="division" class="form-control fs13 not-required" value="{{ $profile['division'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.division') }}">
                                                <p class="error-message p5t m0" data-error="division"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.club') }}</span>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <label class="col-2 col-md-1 text-left lh3 p0">{{ trans('attributes.profile.body.content.last_name') }}</label>
                                            <div class="col-9 col-md-4 p0l">
                                                <input type="text" class="form-control fs13 not-required" name="company_representative_last_name"
                                                       value="{{ $profile['company_representative_last_name'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.last_name') }}">
                                                <p class="error-message p5t m0" data-error="company_representative_last_name"></p>
                                            </div>
                                            <label class="col-2 col-md-1 text-left text-md-center p0 lh3">{{ trans('attributes.profile.body.content.first_name') }}</label>
                                            <div class="col-9 col-md-4 p0r p0l-under-md input-md-pr">
                                                <input type="text" class="form-control fs13 not-required" name="company_representative_first_name"
                                                       value="{{ $profile['company_representative_first_name'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.first_name') }}">
                                                <p class="error-message p5t m0" data-error="company_representative_first_name"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.phone_number') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-md-12 p0l">
                                                <input type="text" name="phone" class="form-control col-11 col-md-6 fs13" value="{{ $profile['phone'] ?? '' }}"
                                                       placeholder="{{ trans('attributes.profile.body.place_holder.phone') }}">
                                            </div>
                                            <p class="error-message p5t m0" data-error="phone"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.ZIP_code') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-md-12 p0l">
                                                <input type="text" name="zip_code" class="form-control col-11 col-md-6 fs13 zip-code"
                                                       value="{{ $profile['zip_code'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.ZIP_code') }}">
                                            </div>
                                            <p class="error-message p5t m0" data-error="zip_code"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.address_city') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
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
                                        <span>{{ trans('attributes.profile.body.label.address_district') }}</span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-md-12 p0l">
                                                <input type="text" name="address_district" class="form-control col-11 col-md-6 fs13"
                                                       value="{{ $profile['address_district'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.address_district') }}">
                                            </div>
                                            <p class="error-message p5t m0" data-error="address_district"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.address_2') }} </span>
                                        <label class="label-required float-md-right">{{ trans('attributes.common.required') }}</label>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <input type="text" class="form-control col-11 fs13" name="address_town"
                                                   value="{{ $profile['address_town'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.address_2') }}">
                                            <p class="error-message p5t m0" data-error="address_town"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.address_3') }}</span>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <input type="text" class="form-control col-11 not-required fs13" name="address_building"
                                                   value="{{ $profile['address_building'] ?? '' }}" placeholder="{{ trans('attributes.profile.body.place_holder.address_3') }}">
                                            <p class="error-message p5t m0" data-error="address_building"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-info">
                                        <span>{{ trans('attributes.profile.body.label.information_from_CYARea') }}</span>
                                    </td>
                                    <td>
                                        <div class="row p20l">
                                            <div class="col-12 col-md-4 p0l">
                                                <label class="container-input p30l">
                                                    <input type="radio" name="notification" value="0" id="notification" @if($profile['notification'] == FLAG_ZERO) checked @endif>
                                                    <span class="checkmark-radio"></span>
                                                    {{ trans('attributes.profile.body.content.wish_to_notification') }}
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-4 p0l">
                                                <label class="container-input p30l">
                                                    <input type="radio" name="notification" value="1" id="notification" @if($profile['notification'] == FLAG_ONE) checked @endif>
                                                    <span class="checkmark-radio"></span>
                                                    {{ trans('attributes.profile.body.content.dont_want_notification') }}
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="row p15r p15l">
                                <div class="col-12 text-center">
                                    <button type="button" id="update-info" class="btn border-0 custom-top-btn-primary admin-edit">{{ trans('attributes.profile.footer.button_update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
        <script src="{{ asset('/dist/js/profile_sub_user.min.js') }}"></script>
@endsection
