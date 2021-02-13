@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-wrapper-pay">
        <div id="main-info-assessment">
            <div class="row row-header mb-3">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.setting.pay.register_information') }}</h3>
                    </div>
                </div>
            </div>

            <input id="public-key" type="hidden" value="{{ $publicKey }}">

        @include('partials.flash_messages')

        <!--profile edit-->
            <div class="row col-12 m15b justify-content-between">
                <div class="centered-vertical fs13 align-items-flex-end">
                    {{ trans('messages.card_allow.main') }}
                </div>
                <div class="row w-25 justify-content-end min-w300">
                        <img class="w-15" src="{{ asset('images/visa/visa.png') }}" alt="">
                        <img class="w-15" src="{{ asset('images/visa/mastercard.png') }}" alt="">
                        <img class="w-15" src="{{ asset('images/visa/jcb.png') }}" alt="">
                        <img class="w-15" src="{{ asset('images/visa/discover.png') }}" alt="">
                        <img class="w-15" src="{{ asset('images/visa/dinersClub.png') }}" alt="">
                        <img class="w-15" src="{{ asset('images/visa/americanExpress.png') }}" alt="">
                </div>
            </div>
            <div class="row col-12 m15b">
                <div class="centered-vertical fs13 align-items-flex-end">
                    {{ trans('messages.card_allow.sub_1') }}<br>
                    {{ trans('messages.card_allow.sub_2') }}<br>
                    {{ trans('messages.card_allow.sub_3') }}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">{{ trans('attributes.setting.pay.payment_information') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ trans('attributes.setting.pay.card') }}</label>
                                <div id="number-form" class="form-control payjp_simple-input-text payjs-outer invalid_number d-flex align-items-center"></div>
                                <p class="error-message p5t m0" data-error="invalid_number"></p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="">{{ trans('attributes.setting.pay.expire_day') }}</label>
                                        <div id="expiry-form" class="payjs-outer form-control invalid_expiry_year d-flex align-items-center"></div>
                                        <p class="error-message p5t m0" data-error="invalid_expiry_year"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-12">{{ trans('attributes.setting.pay.cvc') }}</label>
                                        <div class="col-12">
                                            <div id="cvc-form" class="payjs-outer form-control invalid_cvc d-flex align-items-center"></div>
                                            <p class="error-message p5t m0" data-error="invalid_cvc"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('attributes.balance.body.name') }}</label>
                                <input name="card_name" class="form-control text-transform-uppercase" type="text" placeholder="TARO YAMADA">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="m20r centered-vertical">
                                    <p class="error-message m0 fs13" data-error="check_card"></p>
                                </div>
                                <button id="create-card" type="button" class="btn btn-primary float-right">{{ trans('attributes.setting.pay.btn_checkout') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="p5l fs13">{{ trans('messages.footer_check_card') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://js.pay.jp/v2/pay.js"></script>
    <script src="{{ asset('dist/js/create-card.min.js') }}"></script>
@endsection
