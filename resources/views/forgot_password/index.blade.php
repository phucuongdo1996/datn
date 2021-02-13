@extends('layout.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register/step3.css') }}">
@endsection
@section('content')
    <div class="container container-reset-password">
        <div class="title-forgot-pw title-forgot-pw_1 text-center fw-bold p90t fs40">{{__('attributes.forgot_password.title_1')}}</div>

        <div class="forgot-pw-step1 p15b">
            <div
                class="label-forgot-pw text-center fs16 m15t">{{__('attributes.forgot_password.step_1.label_forgot_pw')}}</div>
            <div class="row">
                <div class="form-forgot-password col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('attributes.forgot_password.step_1.input_email')}}<span
                                class="text-red">*</span></label>
                        <input type="email" class="form-control input-forgot m1b0b" name="email_forgot"
                               placeholder="E-mail" value="" id="email-forgot">
                        <span class="text-red span-error-forgot-pw" data-error="email_forgot_1"></span><br>
                        <span class="text-red span-error-forgot-pw" data-error="email_forgot_2"></span>
                    </div>
                    <div class="margin-auto text-center m40t">
                        <button type="button" class="btn btn-submit btn-forgot-pass text-white custom-top-btn-primary"
                                id="submit-gmail-forgot-pass">
                            {{__('attributes.forgot_password.step_1.btn_submit_forgot_pw')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="forgot-pw-step2" style="display: none">
            <div
                class="label-forgot-pw text-center fs16 m15t">{{__('attributes.forgot_password.step_2.label_forgot_pw_1')}}</div>
            <div
                class="label-forgot-pw text-center fs16">{{__('attributes.forgot_password.step_2.label_forgot_pw_2')}}</div>
            <div class="row">
                <div class="form-forgot-password step2 col-sm-12 col-lg-6">
                    <div
                        class="form-group div-gmail-forgot-pass text-center"></div>
                </div>
            </div>
        </div>

        <div class="receive-email receive-email-forgot-pw m120b">
            <hr>
            <div class="title-receive-email">{{ trans('attributes.register.step3.no_receive_email') }}</div>
            <div class="message-receive-email">
                <span>{{ trans('attributes.register.step3.message_check_email') }}</span>
                <br>
                <span>{{ trans('attributes.register.step3.re_register_member_information') }}</span>
            </div>
        </div>
    </div>
@endsection
