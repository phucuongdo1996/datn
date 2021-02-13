@extends('layout.register')
@section('style-step')
    <link rel="stylesheet" href="{{ asset('css/register/step1.css') }}">
@endsection
@section('head-text')
    <div class="fw-bold">{{__('attributes.register.title_step1')}}</div>
@endsection
@section('content-step')
    <div class="row">
        <div class="form-process col-sm-12 col-lg-6">
            <div id="process-step1" class="process-content active">
                <form action="" method="post" id="form-register">
                    @csrf
                    <input type="hidden" name="role" value="{{ session()->get('data_register')['role'] }}">
                    <div class="form-group">
                        <label class="fs12-sp" for="email-register">{{__('attributes.register.step1.label_email')}}  <span class="text-red">*</span></label>
                        <input type="email" class="form-control input-register fs14-sp" name="email" id="email-register" placeholder="Email" value="">
                        <span class="text-red span-error-register" id="error-register-email"></span>
                    </div>
                    <div class="form-group">
                        <label class="fs12-sp"
                               for="password-register">{{__('attributes.register.step1.label_password')}} <span
                                class="text-red">*</span> {{__('attributes.register.step1.explain_password')}}</label>
                        <input type="password" class="form-control input-register fs14-sp" name="password" id="password-register" placeholder="Password"
                               value="">
                        <span class="text-red span-error-register" id="error-register-password"></span>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input pointer" id="checkbox-show-pass">
                        <label class="form-check-label pointer fs14-sp" id="label-show-pass">{{__('attributes.register.step1.label_checkbox_pwd')}}</label>
                    </div>
                    <div class="form-group div-block">
                        <span class="fs16"><i class="fa fa-chevron-right" aria-hidden="true"></i> <a class="show-policy-modal" href="#">{{__('attributes.footer.policy')}}</a></span>
                        <span class="text-margin fs16"><i class="fa fa-chevron-right" aria-hidden="true"></i> <a class="show-rules-modal" href="#">{{__('attributes.footer.rules')}}</a></span>
                    </div>
                    <div class="form-check form-check-down text-sm-center margin-auto-sp w-70-sp">
                        <input type="checkbox" class="form-check-input pointer" id="checkbox-policy">
                        <label class="form-check-label pointer fs14-sp" id="label-policy">{{__('attributes.register.step1.label_policy_accept')}}</label>
                    </div>
                    <div class="margin-auto text-center">
                        <button type="button" disabled="true" class="btn border-0 custom-top-btn-primary btn-submit btn-submit-register fs16-sp w-100-sp" >{{__('attributes.register.step1.label_btn_register')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
