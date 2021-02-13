@extends('layout/register')
@section('style-step')
    <link rel="stylesheet" href="{{ asset('css/register/step2.css') }}">
@endsection
@section('head-text')
    <div class="fw-bold">{{__('attributes.register.title_step2')}}</div>
@endsection
@section('content-step')
    <div class="row">
        <div class="form-process col-sm-12 col-lg-6">
            <div id="process-step2" class="process-content">
                <div class="content-step-2">
                    <div>
                        <h4 class="label-input-step2">{{__('attributes.register.step2.email_id')}}</h4>
                        <p class="fs16-sp">{{ session()->get('data_register')['email'] }}</p>
                    </div>
                    <div>
                        <h4 class="label-input-step2">{{__('attributes.register.step2.password')}}</h4>
                        <p class="fs16-sp">{{ str_pad('', strlen(session()->get('data_register')['password']), '*', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="margin-auto text-center">
                    <form id="form-data-step2" action="{{ route(REGISTER_STEP2_VERIFIED_ADD_RECORD) }}" method="POST">
                        @csrf
                        <button id="btn-register-confirm" type="button"
                                class="btn border-0 custom-top-btn-primary btn-submit btn-confirm-step2 fs16-sp w-100-sp"
                                data-id="2">{{__('attributes.register.step2.btn_submit')}}</button>
                    </form>
                    <a href="{{ route(REGISTER_SHOW_REGISTRATION_FORM) }}" class="btn m20t fs14 fs16-sp"
                            data-id="2"><i class="fa fa-chevron-right" aria-hidden="true"></i>{{__('attributes.register.step2.btn_back')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
