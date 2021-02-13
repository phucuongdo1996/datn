@extends('layout.register')
@section('style-step')
    <link rel="stylesheet" href="{{asset('css/register/step4.css')}}">
@endsection
@section('head-text')
    <div class="fw-bold">{{ trans('attributes.register.step4.title_complete_registration') }}</div>
@endsection
@section('content-step')
    <div class="register-step-4">
        @php($step4Status = session()->get('step4_status'))
        @if($step4Status == ACTIVE_SUCCESS)
            <h5 class="text-center">{{ trans('attributes.register.step4.complete_registration') }}</h5>
        @elseif($step4Status == ACTIVE_ERROR_USER_ACHIEVED)
            <h5 class="text-center">{{ trans('messages.notification.authentication_done') }}</h5>
        @endif
        <div class="progress-register">
                <div class="row form-group div-block w-100-sp">
                    <div class="col-12 col-md-8">
                        <div class="step4-progress-registration fs14-sp">
                            {{ trans('attributes.register.step4.display_progress_registration') }}
                        </div>
                        <div class="row">
                            <div class="col-7 col-md-12 show-sp">
                                <div class="progress progress-success">
                                    <div class="progress-bar" id="progress-bar-success" role="progressbar"></div>
                                </div>
                            </div>
                            <span class=" percent-register text-center col-5 none display-sp">20
                                <span class="step4-percent-register">{{ trans('attributes.register.step4.percent_register') }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <span class="none-sp percent-register col-md-4 text-center">20<span class="step4-percent-register">{{ trans('attributes.register.step4.percent_register') }}</span></span>
                </div>
        </div>
        <div class="text-center step4-using-service fs14-sp">{{ trans('attributes.register.step4.using_service') }}</div>
        <div class="text-center">
            <a href="{{ '/register/info/' . ROLES[$currentUser->role] }}">
                <button class="text-center btn border-0 custom-top-btn-primary btn-register-information w-100-sp">{{ trans('attributes.register.step4.button_registration_screen') }}</button>
            </a>
        </div>
    </div>
@endsection
