@extends('layouts.base')
@section('content')
    <div id="mainWrap" class="wrap-login">
        <div id="main">
            <div class="loginWrap">
                <div class="loginContent">
                    <h1><img src="{{ asset('images/login/logo.svg') }}" /></h1>
                    <div class="card">
                        <form id="form-login">
                            <div class="inputWrap">
                                <p class="color-black">{{ trans('attributes.register.step1.label_email') }}</p>
                                <div class="textInput m5b">
                                    <input type="text" name="email" id="email" class="form-control h47" placeholder="{{ __('attributes.top.header.login_form.email') }}">
                                </div>
                                <p class="error-message m0" data-error="email"></p>
                            </div>
                            <div class="inputWrap">
                                <p class="color-black">{{ trans('attributes.register.step1.label_password') }}</p>
                                <div class="textInput m5b">
                                    <input type="password" name="password" id="password" class="form-control h47" placeholder="{{ __('attributes.top.header.login_form.password') }}">
                                </div>
                                <p class="error-message m0" data-error="password"></p>
                            </div>
                            <div class="inputWrap m5b">
                                <div class="checkInput"><label class="color-black"><input type="checkbox" name="remember" /> {{ trans('attributes.top.header.login_form.remember') }}</label></div>
                            </div>
                            @include('partials.flash_messages')
                            <div class="inputWrap">
                                <div class="btnInput">
                                    <button type="button" id="login" class="btn border-0 custom-top-btn-primary btn-block h47 br8 fs16"> {{ trans('attributes.top.header.login_form.login') }}</button>
                                </div>
                            </div>
                            <a id="forgot-pass" class="d-inline-block m15t fs14" href="{{ route(USER_RESET_PASSWORD_INDEX) }}">
                                <i class="fas fa-angle-right"></i> {{ trans('attributes.top.header.login_form.forgot_password') }}
                            </a>
                        </form>
                        <div class="link">
                            <a href="{{ route(REGISTER_SHOW_SCREEN_REGISTER) }}">{{ trans('attributes.header.new_member') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--main-->
    </div><!--mainWrap-->
@endsection
