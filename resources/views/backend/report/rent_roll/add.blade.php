@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-padding container-wrapper-add">
        @include('partials.flash_messages')
        <form id="main-info-assessment">
            <input name="property_id" type="hidden" value="{{$propertyId}}">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ __('attributes.rent_roll.title') }}</h3>
                    </div>
                </div>
            </div>

            <div class="w-45 m30b">
                <div class="m0 diagram-analysis">
                    <div class="p30 diagram-block">
                        <div class="d-flex m30b m0l">
                            <p class="fs16 fw-bold m0">{{ __('attributes.rent_roll.title_sub') }}</p>
                        </div>
                        <div class="row m0 p0">
                            <div class="col-6 d-flex p0 p10r align-items-center">
                                <div class="w-60 col-12-sp p0 m10r d-flex">
                                    <span class="d-inline-block">{{ __('attributes.rent_roll.floor_code') }}</span>
                                </div>
                                <div class="w-40 col-12-sp p0">
                                    <div class="w-100">
                                        <select name="floor_code" class="form-control m0 p13 p8l p8r h-auto fs14 text-left">
                                            <option value="">---</option>
                                            @foreach(BASEMENT_RENT_ROLL as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex p0 p10l align-items-center">
                                <div class="w-60 col-12-sp m10r p0 d-flex">
                                    <span class="d-inline-block">{{ __('attributes.rent_roll.room_code') }}</span>
                                </div>
                                <div class="w-40 col-12-sp p0">
                                    <div class="w-100">
                                        <input name="room_code" type="text" value="" class="form-control m0 p13 p8l p8r h-auto fs14 text-left" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.room_status') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w-100">
                                    <label class="container-input fw-normal p30l">{{ __('attributes.rent_roll.room_status_label') }}
                                        <input name="room_status" value="empty" type="checkbox" class="check-status">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.tenant') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w-100">
                                    <input name="tenant" type="text" value="" class="form-control m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.real_estate_type') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w-auto m20r">
                                    <div class="btn wrap-input w230 p0 br4">
                                        <select name="real_estate_type_id" class="option-paginate-1 btn form-control hp100 p3 fs14">
                                            <option value="">---</option>
                                            @for($i = FLAG_ONE; $i < FLAG_TEN; $i++)
                                                <option value="{{$i}}">{{ REAL_ESTATE_TYPE[$i] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <p class="error-message m0" data-error="real_estate_type_id"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.contract_area') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="contract_area" type="text" value="0.00" class="form-control convert-number-double-decimal m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="contract_area"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.monthly_rent') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="monthly_rent" type="text" value="0" class="monthly-rent form-control convert-data m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="monthly_rent"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.monthly_service') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="monthly_service" type="text" value="0" class="form-control convert-data m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="monthly_service"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.deposit') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="deposit" type="text" value="0" class="deposit form-control convert-data m0 p13 p8l p8r h-auto fs14 text-left"/>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.deposit_monthly') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="deposit_monthly" type="text" value="0.0" class="deposit-monthly form-control convert-number-single-decimal m0 p13 p8l p8r h-auto fs14 text-left" readonly/>
                                </div>
                                <p class="error-message m0" data-error="deposit_monthly"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.key_money') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="key_money" type="text" value="0" class="key-money form-control convert-data m0 p13 p8l p8r h-auto fs14 text-left"/>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.key_money_monthly') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="key_money_monthly" type="text" value="0.0" class="key-money-monthly form-control convert-number-single-decimal m0 p13 p8l p8r h-auto fs14 text-left" readonly/>
                                </div>
                                <p class="error-message m0" data-error="key_money_monthly"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.contract_type') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w-auto m20r">
                                    <div class="btn wrap-input w230 p0 br4">
                                        <select name="contract_type" class="option-paginate-1 btn form-control hp100 p3 fs14">
                                            <option value="">---</option>
                                            @foreach(CONTRACT_TYPE as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.contract_signing_date') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="contract_signing_date" type="text" value="" class="date-time form-control m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="contract_signing_date"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.contract_start_date') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="contract_start_date" type="text" value="" max="2020-01-28" class="date-time form-control m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="contract_start_date"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.contract_end_date') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="contract_end_date" type="text" value="" class="date-time form-control m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="contract_end_date"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.money_update') . '('.__('attributes.common.months').')' }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="money_update" type="text" value="0.0" class="form-control convert-number-single-decimal m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="money_update"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.cancellation_notice') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w230 m20r">
                                    <input name="cancellation_notice" type="text" value="0" class="form-control convert-data m0 p13 p8l p8r h-auto fs14 text-left" />
                                </div>
                                <p class="error-message m0" data-error="cancellation_notice"></p>
                            </div>
                        </div>
                        <div class="row m-0 m15t p0">
                            <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block">{{ __('attributes.rent_roll.note') }}</span>
                            </div>
                            <div class="w-70 col-12-sp p0">
                                <div class="w-100">
                                    <textarea name="note" cols="15" rows="5" class="form-control m0 h-auto fs14 text-left"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex col-12 text-center text-lg-right m0 p0">
                <div class="w-auto text-center text-md-right m20r m p0">
                    <a href="{{ buttonBackPages(request()->all(), $propertyId) }}" class="btn custom-btn-default fs15 m0 p18l p18r w-auto">{{ __('attributes.rent_roll.btn_cancel') }}</a>
                </div>
                <div class="w-auto text-center text-md-right m0 p0">
                    <button type="button" id="add-rent-roll" class="btn custom-btn-primary fs15 m0 p18l p18r w-auto">{{ __('attributes.rent_roll.btn_save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/rent-roll.min.js') }}"></script>
@endsection
