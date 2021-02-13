@extends('layout.base_top')
@section('content')
    @include('layout.new_header')
    <div id="layout-contact" class="inner p80t">
        <div class="p40t p40b" style="margin: auto">
            <div class="row row-header">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left">
                        <h3 class="m0 fs32">{{ trans('attributes.support.contact_us') }}</h3>
                    </div>
                </div>
            </div>
        @include('partials.flash_messages')

        <!--profile edit-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title fs18">{{ trans('attributes.support.content_of_inquiry') }}</h3>
{{--                            <div class="card-tools">--}}
{{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse"--}}
{{--                                        data-toggle="tooltip" title="Collapse">--}}
{{--                                    <i class="fas fa-minus"></i></button>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-body">
                            <form class="form-support" action="{{ route(USER_CONTACT_STORE) }}" method="POST">
                                @csrf
                                <div class="form-group-2">
                                    <label>{{ trans('attributes.support.house_name_2') }}</label>
                                    <input type="text" name="house_name"
                                           class="form-control @error('house_name')input-error @enderror"
                                           placeholder="{{ trans('attributes.support.house_name_2') }}"
                                           value="{{ old('house_name') }}">
                                    @error('house_name')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group-2">
                                    <label>{{ trans('attributes.business_plan.destination_name') }}</label>
                                    <input type="text" name="user_name"
                                           class="form-control @error('user_name')input-error @enderror"
                                           placeholder="{{ trans('attributes.business_plan.destination_name') }}"
                                           value="{{ old('user_name') }}">
                                    @error('user_name')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group-2">
                                    <label>{{ trans('attributes.invite_user.mail_address') }}</label>
                                    <input type="text" name="email"
                                           class="form-control @error('email')input-error @enderror"
                                           placeholder="{{ trans('attributes.invite_user.mail_address') }}"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group-2">
                                    <label>{{ trans('attributes.profile.body.label.phone_number') }}</label>
                                    <input type="text" name="phone_number"
                                           class="form-control @error('phone_number')input-error @enderror"
                                           placeholder="{{ trans('attributes.profile.body.label.phone_number') }}"
                                           value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group-2">
                                    <label>{{ trans('attributes.support.content') }}</label>
                                    <textarea name="note" class="form-control @error('note')input-error @enderror"
                                              rows="4"
                                              placeholder="{{ trans('attributes.support.content') }}">{{ old('note') }}</textarea>
                                    @error('note')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer" style="display: block;">
                                    <button
                                        class="btn btn-primary float-right send-supports">{{ trans('attributes.support.send') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
