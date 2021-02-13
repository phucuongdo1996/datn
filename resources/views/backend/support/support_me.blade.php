@extends('layout.home.master')
@section('content')
    <div class="support-container">
        <div class="row row-header mb-5">
            <div class="row m0">
                <div class="col-12 text-center text-md-left">
                    <h3 class="m0">{{ trans('attributes.support.paid_support') }}</h3>
                </div>
            </div>
        </div>

        @include('partials.flash_messages')

        <!--profile edit-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('attributes.support.content_of_inquiry') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                        <div class="card-body" style="display: block;">
                            <form class="form-support" action="{{ route(USER_SUPPORT_STORE) }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}" readonly>
                            <input type="hidden" name="user_code" value="{{ $user['user_code'] }}" readonly>
                            <input type="hidden" name="user_name" value="{{ $user['profile']['person_charge_last_name_kana'] . $user['profile']['person_charge_first_name_kana']}}" readonly>
                            <input type="hidden" name="user_address" value="{{ $user['profile']['address_city'] . ' ' . $user['profile']['address_district'] }}" readonly>
                            <input type="hidden" name="person_charge_last_name" value="{{ $user['profile']['person_charge_last_name'] }}" readonly>
                            <input type="hidden" name="person_charge_first_name" value="{{ $user['profile']['person_charge_first_name'] }}" readonly>
                            <input type="hidden" name="person_charge_last_name_kana" value="{{ $user['profile']['person_charge_last_name_kana'] }}" readonly>
                            <input type="hidden" name="person_charge_first_name_kana" value="{{ $user['profile']['person_charge_first_name_kana'] }}" readonly>
                            <input type="hidden" name="address_city" value="{{ $user['profile']['address_city'] }}" readonly>
                            <input type="hidden" name="address_district" value="{{ $user['profile']['address_district'] }}" readonly>
                            <input type="hidden" name="email" value="{{ $user['email'] }}" readonly>
                            @if ($currentUser->role != INVESTOR)
                                @foreach($user['profile']['specialties'] as $value)
                                    <input type="hidden" name="specialties[]" value="{{ $value['name'] }}" readonly>
                                @endforeach
                                <input type="hidden" name="website_business_name" value="{{ $user['profile']['website_business_name'] }}" readonly>
                            @endif
                            <div class="form-group">
                                <label>{{ trans('attributes.support.content_of_inquiry') }}</label>
                                <select class="form-control @error('content_of_inquiry')input-error @enderror" name="content_of_inquiry">
                                    <option value="">---</option>
                                    @foreach(CONTENT_OF_INQUIRY as $value)
                                        <option value="{{ $value }}" {{ old('content_of_inquiry') == $value  ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('content_of_inquiry')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ trans('attributes.support.member_id') }}</label>
                                <input type="text" class="form-control" placeholder="{{ trans('attributes.support.member_id') }}" value="{{ $user['user_code'] }}" disabled="">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('attributes.business_plan.destination_name') }}</label>
                                <input type="text" class="form-control" placeholder="{{ trans('attributes.business_plan.destination_name') }}" value="{{ $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name'] }}" disabled="">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('attributes.admin.csv.kata_name') }}</label>
                                <input type="text" class="form-control" placeholder="{{ trans('attributes.admin.csv.kata_name') }}" value="{{ $user['profile']['person_charge_last_name_kana'] . $user['profile']['person_charge_first_name_kana'] }}" disabled="">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('attributes.tax.street_address') }}</label>
                                <input type="text" class="form-control" placeholder="" value="{{ $user['profile']['address_city'] . ' ' . $user['profile']['address_district'] }}" disabled="">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('attributes.invite_user.mail_address') }}</label>
                                <input type="text" class="form-control" placeholder="{{ trans('attributes.invite_user.mail_address') }}" value="{{ $user['email'] }}" disabled="">
                            </div>

                            @if ($currentUser->role != INVESTOR)
                                <div class="form-group">
                                    <label>{{ trans('attributes.profile.body.label.specialty') }}</label>
                                    <div class="form-control break-all h-100 min-h38" readonly>
                                        @foreach($user['profile']['specialties'] as $value)
                                            <span class="m5t">{{ $value['name'] }}<br></span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ trans('attributes.support.web_url') }}</label>
                                    <input type="text" class="form-control" value="{{ $user['profile']['website_business_name'] ?? '' }}" disabled>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>{{ trans('attributes.support.content') }}</label>
                                <textarea class="form-control @error('content')input-error @enderror" name="content" rows="3" placeholder="">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class="card-footer" style="display: block;">
                                    <button class="btn btn-primary float-right send-supports">{{ trans('attributes.support.send') }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
