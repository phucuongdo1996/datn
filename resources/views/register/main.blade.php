@extends('layout/base')
@section('content')
    <div class="main-header text-center">
        <h1 class="text-header fw-bold">{{__('attributes.main_register.title')}}</h1>
    </div>

    <div class="container">
        <div class="main-text-header text-center">
            <p class="main-summary fs16">{{__('attributes.main_register.summary_1')}}</p>
            <p class="main-summary fs16">{{__('attributes.main_register.summary_2')}}</p>
        </div>
        <div class="row justify-content-center p100b content-main-register">
            <div class="col-12 col-md-8 col-lg-4 p20r p20l m10b-per">
                <div class="card card-item no-border m0b">
                    <div class="card-investor card-header card-item-header text-center"><span
                            class="fs17">{{__('attributes.main_register.card_investor.title')}}</span></div>
                    <div class="card-body card-item-body">
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_investor.description_1')}}</p>
                        </div>
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_investor.description_2')}}</p>
                        </div>
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_investor.description_3')}}</p>
                        </div>
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_investor.description_4')}}</p>
                        </div>
                    </div>
                    <div class="card-footer card-item-footer text-center border-bottom-radius">
                        <form action="{{ route(REGISTER_SET_DATA_STEP1) }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="{{ INVESTOR }}">
                            <button class="btn border-0 custom-top-btn-primary btn-send"><span
                                    class="fs16">{{__('attributes.main_register.card_investor.btn_register')}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-4 p20r p20l m10b-per">
                <div class="card card-item no-border m0b">
                    <div class="card-broker card-header card-item-header text-center"><span
                            class="fs17">{{__('attributes.main_register.card_broker.title')}}</span></div>
                    <div class="card-body card-item-body">
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_broker.description_1')}}</p>
                        </div>
                    </div>
                    <div class="card-footer card-item-footer text-center border-bottom-radius">
                        <form action="{{ route(REGISTER_SET_DATA_STEP1) }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="{{ BROKER }}">
                            <button class="btn border-0 custom-top-btn-primary btn-send"><span
                                    class="fs16">{{__('attributes.main_register.card_broker.btn_register')}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-4 p20r p20l">
                <div class="card card-item no-border m0b">
                    <div class="card-expert card-header card-item-header text-center"><span
                            class="fs17">{{__('attributes.main_register.card_expert.title')}}</span></div>
                    <div class="card-body card-item-body">
                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_expert.description_1')}}</p>
                        </div>

                        <div class="row">
                            <i class="fa fa-stop font_awesome-stop col-1"></i>
                            <p class="col-10 fs14 p10l">{{__('attributes.main_register.card_expert.description_2')}}</p>
                        </div>
                    </div>
                    <div class="card-footer card-item-footer text-center border-bottom-radius">
                        <form  action="{{ route(REGISTER_SET_DATA_STEP1) }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="{{ EXPERT }}">
                            <button class="btn border-0 custom-top-btn-primary btn-send"><span
                                    class="fs16">{{__('attributes.main_register.card_expert.btn_register')}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
