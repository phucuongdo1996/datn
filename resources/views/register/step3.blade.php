@extends('layout/register')
@section('style-step')
    <link rel="stylesheet" href="{{ asset('css/register/step3.css') }}">
@endsection
@section('head-text')
    <div class="fw-bold">{{__('attributes.register.title_step3')}}</div>
@endsection
@section('content-step')
    @if(session()->exists('step4_status'))
        <div class="row">
            <div class="form-process col-sm-12 col-lg-8">
                <div class="row process-content active text-center">
                    @php($step4Status = session()->get('step4_status'))
                    @if($step4Status == ACTIVE_FAIL)
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.active_fail_1') }}</h5>
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.active_fail_2') }}</h5>
                    @endif
                    <div class="form-group div-block">
                        <div>{{ session()->get('email_expiry') ?? "" }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="receive-email head-process">
            <hr>
            <div class="title-receive-email">{{ trans('attributes.register.step3.no_receive_email') }}</div>
            <div class="message-receive-email text-justify">
                <span>{{ trans('attributes.register.step3.message_check_email') }}</span>
                <br>
                <span>{{ trans('attributes.register.step3.re_register_member_information') }}</span>
            </div>
        </div>
    @else
        <div class="row">
            <div class="form-process col-sm-12 col-lg-8">
                <div class="row process-content active text-center">
                    @php($step3Status = session()->get('step3_status'))
                    @if($step3Status == EMAIL_SENDED)
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.verified_mail') }}</h5>
                    @elseif($step3Status == EMAIL_SEND_SUSSCESS)
                        @php(session()->put('step3_status', EMAIL_SENDED))
                        <h5 class="text-red text-center fs20">{{ trans('attributes.register.step3.no_complete_registration') }}</h5>
                    @endif
                    @if($step3Status == EMAIL_SEND_FAIL)
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.active_fail_1') }}</h5>
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.active_fail_2') }}</h5>
                    @endif
                    @if($step3Status == EMAIL_USER_VERIFIED)
                        <h5 class="text-red text-center fs20">{{ trans('messages.notification.authentication_done') }}</h5>
                    @endif
                    <div class="content-auth-email w-95-sp">
                        @if($step3Status == EMAIL_SEND_FAIL)
                            <span class="fs16-sp">{{ trans('messages.notification.active_fail_notification_1') }}</span>
                            <br>
                            <span class="fs16-sp">{{ trans('messages.notification.active_fail_notification_2') }}</span>
                        @else
                            <span class="fs16-sp">{{ trans('attributes.register.step3.message_email_authentication_one') }}</span>
                            <br>
                            <span class="fs16-sp">{{ trans('attributes.register.step3.message_email_authentication_two') }}</span>
                        @endif
                    </div>
                    <div class="form-group div-block w-95-sp pd-5-sp">
                        <div class="fs16-sp">{{ session()->get('data_register')['email'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        @if($step3Status == EMAIL_USER_VERIFIED)
            <div class="text-center step4-using-service"></div>
            <div class="text-center">
                <a href="{{ '/register/info/' . session()->get('data_register')['role'] }}">
                    <button class="text-center btn-register-information">{{ trans('attributes.register.step4.button_registration_screen') }}</button>
                </a>
            </div>
        @else
            <div class="receive-email head-process w-100-sp">
                <hr>
                <div class="title-receive-email">{{ trans('attributes.register.step3.no_receive_email') }}</div>
                <div class="message-receive-email text-justify ">
                    <span class="fs13-sp">{{ trans('attributes.register.step3.message_check_email') }}</span>
                    <br>
                    <span class="fs13-sp">{{ trans('attributes.register.step3.re_register_member_information') }}</span>
                </div>
            </div>
        @endif
    @endif
@endsection
