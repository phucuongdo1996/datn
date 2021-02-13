@extends('layout.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register/step3.css') }}">
@endsection
@section('content')
    <div class="container container-reset-password">
        <div class="title-forgot-pw title-forgot-pw_2 text-center fw-bold p90t fs40">{{__('attributes.forgot_password.title_2')}}</div>

        <div class="forgot-pw-step3 p15b">
            <div
                class="label-forgot-pw text-center fs16 m15t">{{__('attributes.forgot_password.step_3.label_forgot_pw_1')}}</div>
            <div
                class="label-forgot-pw text-center fs16">{{__('attributes.forgot_password.step_3.label_forgot_pw_2')}}</div>
            <div class="row">
                <div class="form-forgot-password step1 col-sm-12 col-lg-6 m40t">
                    <form id="confirm-password">
                        @csrf
                        <div class="form-group m25b">
                            <label for="exampleInputPassword">{{__('attributes.forgot_password.step_3.input_password')}}
                                <span class="text-red">*</span></label>
                            <input type="password" class="form-control input-forgot" name="password"
                                   id="password-forgot" placeholder="Password"
                                   value="">
                            <span class="text-red span-error-forgot-pw" data-error="password"></span>
                        </div>
                        <div class="form-group">
                            <label
                                for="exampleInputPassword">{{__('attributes.forgot_password.step_3.input_password_confirm')}}
                                <span class="text-red">*</span></label>
                            <input type="password" class="form-control input-forgot" name="password_confirm"
                                   id="password-forgot-confirm" placeholder="Password"
                                   value="">
                            <span class="text-red span-error-forgot-pw" data-error="password_confirm_1"></span><br>
                            <span class="text-red span-error-forgot-pw" data-error="password_confirm_2"></span>
                        </div>
                        <div class="margin-auto text-center m50t">
                            <div>
                                <button type="button" class="btn btn-submit btn-forgot-pass text-white custom-top-btn-primary"
                                        id="btn-change-pass">
                                    {{__('attributes.forgot_password.step_3.btn_submit_change_pw')}}
                                </button>
                            </div>
                            <div>
                                <a href="{{ route(TOP) }}" class="btn m10t fs14 go-to-top"
                                   data-id="2"><i class="fa fa-chevron-right"
                                                  aria-hidden="true"></i>{{__('attributes.forgot_password.step_3.back_to_top')}}
                                </a>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{ request()->token }}">
                    </form>
                </div>
            </div>
        </div>

        <div class="forgot-pw-step4 p15b" style="display:none;">
            <div
                class="label-forgot-pw text-center fs16 m65t text-danger fw-bold">{{__('attributes.forgot_password.step_4.label_forgot_pw_1')}}</div>
            <div
                class="label-forgot-pw text-center fs16 m15t">{{__('attributes.forgot_password.step_4.label_forgot_pw_2')}}</div>
            <div
                class="label-forgot-pw text-center fs16">{{__('attributes.forgot_password.step_4.label_forgot_pw_3')}}</div>
                <div class="margin-auto text-center m60t m60b">
                    <a href="{{ route(TOP) }}">
                        <button type="button"
                                class="btn btn-submit btn-forgot-pass text-white label-forgot-pw custom-top-btn-primary">{{__('attributes.forgot_password.step_4.go_to_login')}}
                        </button>
                    </a>
                </div>
        </div>
    </div>
</div>
@endsection
