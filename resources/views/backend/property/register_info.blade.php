@extends('layout.home.master')
@section('styles')
@endsection
@section('content')
<div class="container-fluid container-wrapper">
    @include('partials.flash_messages')
    <div id="main-info-property">
        <form action="" id="form-data-property" enctype="multipart/form-data">
            <input type="hidden" name="synthetic_point">
            <div class="row m-0 p0 media-575-p20l media-575-p20r p15lr">
                <div class="col-6 text-left text-md-left col-md-6 p0 m5t">
                    <h3>{{ __('attributes.register_info.main.title') }}</h3>
                </div>
                <div class="col-6 col-md-6 text-right text-md-right p0">
                    <div class="dropdown dropdown-none-icon">
                        <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp m5t" data-toggle="dropdown">{{ __('attributes.register_info.main.button_copy') }}</button>
                        <div class="dropdown-menu dropdown-menu-right set-scrollbar">
                            @foreach($listProperty as $value)
                                <a href="{{ route(USER_PROPERTY_EDIT, $value['id']) }}" class="dropdown-item find-property pointer">{{$value['house_name']}}</a>
                            @endforeach
                        </div>
                        <button type="button" class="btn br8 custom-btn-success fs15 res-info-property d-none d-sm-inline fs13-sp m10l m5t">{{ __('attributes.register_info.main.button_save') }}</button>
                    </div>
                </div>
            </div>
            <div class=" mt-3 register-new-house">

				<!-- 基本情報 -->
	            <div class="row m-0">
		            <div class="row w-100 m-0">
			            <div class="col-12 col-md-6">
		                    <div class="item-block-property p25">
		                        <div class="row m-0">
		                            <div class="col-12 res_mobile m15b">
		                                <p class="fs16 fw-bold">{{ __('attributes.register_info.item_block.title.basic_info') }}</p>
		                            </div>
		                            <div class="col-5 col-sm-3 col-md-12 col-xl-3 cus-col-image m5b res_mobile">
		                                <div id="image-avatar" class="disable-field avatar dropzone pointer m-0 br0">
		                                    <div class="dz-default dz-message">
		                                        <span><i class="fa fa-picture-o fa-3x" aria-hidden="true"></i></span>
		                                    </div>
		                                </div>
		                                <input type="file" name="avatar" id="input-avatar" style="display: none">
		                                <input type="hidden" name="avatar_url" id="input-avatar-url">
		                            </div>
		                            <div class="col-7 col-sm-9 col-md-12 col-xl-9 cus-col-text">
		                                <p class="m5b fs14">{{ __('attributes.register_info.item_block.label.Property_photo') }}</p>
		                                <p class="fs16 fw-bold m5b">{{ __('attributes.register_info.item_block.label.Select_file') }}</p>
		                                <p class="m5b fs13 hide-text">{{ __('attributes.register_info.item_block.label.drop_image') }}</p>
		                                <p class="m5b fs13 hide-text">{{ __('attributes.register_info.item_block.label.can_upload') }}</p>
		                            </div>
		                            <p class="error-message p5t m-0" data-error="avatar"></p>
		                        </div>
		                        @if(in_array($currentUser->role, [BROKER, EXPERT]))
		                            <div class="row m-0 p15t fs14">
		                                <div class="col-12 col-xl-12">
		                                    <span>{{ trans('attributes.register_info.item_block.label.proprietor') }}</span>
		                                    <input type="text" class="form-control m5t m5b fs14" name="proprietor" value="">
		                                    <p class="error-message p5t m-0" data-error="proprietor"></p>
		                                </div>
		                            </div>
		                        @endif
		                        <div class="row m-0 p5t fs14">
		                            <div class="col-12 col-xl-4 res_mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.status') }}</span>
		                                <select  name="status" class="form-control m5t m5b">
		                                    <option value="">---</option>
		                                    @foreach(STATUS_HOUSE as $key => $value)
		                                        <option value="{{ $key }}" >{{ $value }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message p5t m-0" data-error="status"></p>
		                            </div>
		                            <div class="col-12 col-xl-4 p5t-mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.acquisition_date') }}</span>
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="receive_house_date" value="">
		                                <p class="error-message p5t m-0" data-error="receive_house_date"></p>
		                            </div>
		                            <div class="col-12 col-xl-4 p5t-mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.borrowing_day') }}</span>
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="loan_date" value="">
		                                <p class="error-message p5t m-0" data-error="loan_date"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p5t fs14">
		                            <div class="col-12 col-xl-6 res_mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.borrowing_financial') }}</span>
		                                <input type="text" id="filter-loan-bank" class="form-control m5t" placeholder="{{ __('attributes.property.filter_bank') }}" value="">
		                                <select name="loan_bank_name" class="form-control m5t m5b" id="api-bank">
		                                    <option  value="">---</option>
		                                </select>
		                                <p class="error-message p5t m-0" data-error="loan_bank_name"></p>
		                            </div>
		                            <div class="col-12 col-xl-6 p5t-mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.branch_name') }}</span>
		                                <input type="text" id="filter-bank-branch" class="form-control m5t" placeholder="{{ __('attributes.property.filter_branch_bank') }}" value="">
		                                <select name="bank_branch_name" class="form-control m5t m5b" id="api-bank-branch">
		                                    <option value="">---</option>
		                                </select>
		                                <p class="error-message p5t m-0" data-error="bank_branch_name"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p5t fs14">
		                            <div class="col-12 col-xl-6 res_mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.acquisition_amount') }}</span>
		                                <div class="row">
		                                    <div class="col-10">
		                                        <input type="text" class="form-control m5t m5b money-receive-house fs14 text-right convert-data"
		                                               name="money_receive_house" value="{{ $propertyData['money_receive_house'] ?? '0' }}">
		                                    </div>
		                                    <div class="col-2 centered p0r text-flex-end">
		                                        <span>{{ __('attributes.register_info.item_block.label.unit_circle') }}</span>
		                                    </div>
		                                </div>
		                                <p class="error-message p5t m-0" data-error="money_receive_house"></p>
		                            </div>
		                            <div class="col-12 col-xl-6 p5t-mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.loan_amount') }}</span>
		                                <div class="row">
		                                    <div class="col-10">
		                                        <input type="text" class="form-control m5t m5b fs14 text-right convert-data" name="loan" value="0">
		                                    </div>
		                                    <div class="col-2 centered p0r text-flex-end">
		                                        <span>{{ __('attributes.register_info.item_block.label.unit_circle') }}</span>
		                                    </div>
		                                </div>
		                                <p class="error-message p5t m-0" data-error="loan"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p5t fs14">
		                            <div class="col-12 col-xl-6 res_mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.contract_borrowing') }}</span>
		                                <div class="row">
		                                    <div class="col-10">
		                                        @php($year = range(1, 35))
		                                        <select name="contract_loan_period" class="form-control m5t m5b text-right">
		                                            @foreach($year as $key => $value)
		                                                <option class="text-right" value="{{ $key+1 }}" {{ ($key+1 == 20) ? 'selected' : '' }}>{{ $value }}</option>
		                                            @endforeach
		                                        </select>
		                                    </div>
		                                    <div class="col-2 centered p0r text-flex-end">
		                                        <span>{{ __('attributes.common.year') }}</span>
		                                    </div>
		                                </div>
		                                <p class="error-message p5t m-0" data-error="contract_loan_period"></p>
		                            </div>
		                            <div class="col-12 col-xl-6 p5t-mobile">
		                                <span>{{ __('attributes.register_info.item_block.label.borrowed_interest') }}</span>
		                                <div class="row">
		                                    <div class="col-10">
		                                        <input type="text" class="form-control m5t m5b fs14 text-right convert-number-double-decimal"
		                                               name="interest_rate" value="{{ $propertyData['interest_rate'] ?? '0.00' }}">
		                                    </div>
		                                    <div class="col-2 centered p0r text-flex-end">
		                                        <span>{{ __('attributes.common.percent') }}</span>
		                                    </div>
		                                </div>
		                                <p class="error-message p5t m-0" data-error="interest_rate"></p>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="item-block-property  mt-3 p25 fs14">
		                        <div class="row m-0">
		                            <div class="col-12 m10b">
		                                <p class="fs16 fw-bold m-0   ">{{ __('attributes.register_info.item_block.title.thing_1') }}<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.property_name') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14" name="house_name">
		                                <p class="error-message m-0" data-error="house_name"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.zip_code') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 zip-code" name="zip_code">
		                                <p class="error-message m-0" data-error="zip_code"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.prefectures') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="address_city" class="form-control m5t m5b fs14 address-city">
		                                    <option value="">---</option>
		                                    @foreach($prefectures as $key => $prefecture)
		                                        <option value="{{ $prefecture }}" class="address-city-{{$key}}" data-id="{{$key}}">{{ $prefecture }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="address_city"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.district') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                @foreach($districts as $key => $district)
		                                    <input type="hidden" class="address-district-{{ (int)substr($key, FLAG_ZERO, FLAG_TWO) }}"
		                                           value="{{ $district }}" data-name="{{ $district }}">
		                                @endforeach
		                                <select name="address_district" class="form-control m5t m5b fs14 address-district">
		                                    <option value="">---</option>
		                                </select>
		                                <p class="error-message m-0" data-error="address_district"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.town') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 address-town" name="address_town">
		                                <p class="error-message m-0" data-error="address_town"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.lot_number') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14" name="apartment_number">
		                                <p class="error-message m-0" data-error="apartment_number"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.house_number') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14" name="room_number">
		                                <p class="error-message m-0" data-error="room_number"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.main_purpose') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="real_estate_type_id" class="form-control m5t m5b fs14 real-estate-type " id="read-estate-type">
		                                    <option value="">---</option>
		                                    @foreach($listReadEstateType as $readEstateType)
		                                        <option value="{{ $readEstateType['id'] }}">{{ $readEstateType['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="real_estate_type_id"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.detail') }}</span>
		                            </div>
		                            @foreach($listDetailReadEstateType as $detailReadEstateType)
		                                <input type="hidden" class="detail-real-estate-type-id-{{$detailReadEstateType['real_estate_type_id']}}"
		                                       value="{{ $detailReadEstateType['id'] }}" data-name="{{ $detailReadEstateType['name'] }}">
		                            @endforeach
		                            <div class="col-12 col-xl-7">
		                                <select name="detail_real_estate_type_id" class="form-control m5t m5b fs14 detail-real-estate-type-id">
		                                    <option value="">---</option>
		                                </select>
		                                <p class="error-message m-0" data-error="detail_real_estate_type_id"></p>
		                            </div>
		                        </div>
		                        <div id="div-main_application" class="row m-0 p10t align-items-center pcH">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ trans('attributes.property.main_application') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="main_application" class="form-control m5t m5b fs14">
		                                    <option value="">---</option>
		                                    @foreach(MAIN_APPLICATION as $key => $value)
		                                        <option value="{{ $key }}">{{ $value }}</option>
		                                    @endforeach
		                                </select>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.construction') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="house_material_id" class="form-control m5t m5b fs14">
		                                    <option value="">---</option>
		                                    @foreach($listHouseMaterial as $houseMaterial)
		                                        <option   value="{{ $houseMaterial['id'] }}">{{ $houseMaterial['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="house_material_id"></p>
		                            </div>
		                            <div class="col-12 col-xl-5">
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="house_roof_type_id" class="form-control m5t m5b fs14 w-40">
		                                    <option value="">---</option>
		                                    @foreach($listHouseRoofType as $houseRoofType)
		                                        <option value="{{ $houseRoofType['id'] }}">{{ $houseRoofType['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="house_roof_type_id"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.floor') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <div class="row m-0">
		                                    <div class="col-6 p5r p0l">
		                                        <select name="basement" type="text" class="form-control m5t m5b fs14">
		                                            <option value="{{null}}">---</option>
		                                            @foreach(BASEMENT as $basement)
		                                                <option value="{{ $basement }}">{{ $basement }}</option>
		                                            @endforeach
		                                        </select>
		                                        <p class="error-message m-0" data-error="basement"></p>
		                                    </div>
		                                    <div class="col-6 p0r p5l">
		                                        <select name="storeys" type="text" class="form-control m5t m5b fs14">
		                                            <option value="{{null}}">---</option>
		                                            @foreach(STOREYS as $storey)
		                                                <option value="{{ $storey }}">{{ $storey }}</option>
		                                            @endforeach
		                                        </select>
		                                        <p class="error-message m-0" data-error="storeys"></p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.area') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 w-45 d-inline-block text-right convert-number-double-decimal" name="ground_area" value="0.00"><span class="m10l">{{ __('attributes.common.square_meters') }}</span>
		                                <p class="error-message m-0" data-error="ground_area"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.area_floor') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 w-45 d-inline-block text-right convert-number-double-decimal" name="total_area_floors" value="0.00"><span class="m10l">{{ __('attributes.common.square_meters') }}</span>
		                                <p class="error-message m-0" data-error="total_area_floors"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.date_completion') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="construction_time">
		                                <p class="error-message m-0" data-error="construction_time"></p>
		                            </div>
		                        </div>
		                    </div>
			            </div>
			            <div class="col-12 col-md-6">
			                <div class="item-block-property m-0 p25 fs14">
		                        <div class="row m-0">
		                            <div class="col-12 m10b">
		                                <p class="fs16 fw-bold m-0">{{ __('attributes.register_info.item_block.title.thing_2') }}<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.land_rights') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="land_right_id" class="form-control m5t m5b fs14">
		                                    <option value="">---</option>
		                                    @foreach($listLandRight as $landRight)
		                                        <option value="{{ $landRight['id'] }}">{{ $landRight['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="land_right_id"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.building_right') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="building_right_id" class="form-control m5t m5b fs14">
		                                    <option value="">---</option>
		                                    @foreach($listBuildingRight as $buildingRight)
		                                        <option value="{{ $buildingRight['id'] }}">{{ $buildingRight['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="building_right_id"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.number_tenants') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 text-center convert-data" name="total_tenants" value="0">
		                                <p class="error-message m-0" data-error="total_tenants"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.leasable_area') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 w-45 d-inline-block rental-percentage text-right convert-number-double-decimal" name="area_may_rent" value="0.00"><span class="m10l">{{ __('attributes.common.square_meters') }}</span>
		                                <p class="error-message m-0" data-error="area_may_rent"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.deposit_security') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 w-90 d-inline-block text-right convert-data" name="deposits" value="0"><span class="unit-yen">{{ __('attributes.common.yen') }}</span>
		                                <p class="error-message m-0" data-error="deposits"></p>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="item-block-property  mt-3 p25 fs14">
		                        <div class="row m-0">
		                            <div class="col-12 m10b">
		                                <p class="fs16 fw-bold m-0">{{ __('attributes.register_info.item_block.title.thing_3') }}<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.leasehold_type') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <select name="type_rental_id" class="form-control m5t m5b fs14">
		                                    <option value="">---</option>
		                                    @foreach($listTypeRental as $typeRental)
		                                        <option value="{{ $typeRental['id'] }}">{{ $typeRental['name'] }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="type_rental_id"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.leased_land_area') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b fs14 w-45 d-inline-block text-right convert-number-double-decimal" name="area_rent" value="0.00"><span class="m10l">{{ __('attributes.common.square_meters') }}</span>
		                                <p class="error-message m-0" data-error="area_rent"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.lease_period') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="rental_period_from">
		                                <p class="error-message m-0" data-error="rental_period_from"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.term_to') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="rental_period_to">
		                                <p class="error-message m-0" data-error="rental_period_to"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.current_rent') }}<br>{{ __('attributes.register_info.item_block.label.current_rent_2') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b date-time text-center fs14" name="date_lease">
		                                <p class="error-message m-0" data-error="date_lease"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.deposit_security') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" name="deposit_host" value={{ trans('attributes.common.no_stipulation') }}>
		                                <p class="error-message m-0" data-error="deposit_host"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.money') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" name="prize_money" value={{ trans('attributes.common.no_stipulation') }}>
		                                <p class="error-message m-0" data-error="prize_money"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.book_change') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" name="room_cede_fee" value={{ trans('attributes.common.no_stipulation') }}>
		                                <p class="error-message m-0" data-error="room_cede_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.construction_other') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" name="fee_rebuild_rented_house" value={{ trans('attributes.common.no_stipulation') }}>
		                                <p class="error-message m-0" data-error="fee_rebuild_rented_house"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.update') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" name="contract_update_fee" value={{ trans('attributes.common.no_stipulation') }}>
		                                <p class="error-message m-0" data-error="contract_update_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t d-flex align-items-center">
		                            <div class="col-12 col-xl-5">
		                                <span>{{ __('attributes.register_info.item_block.label.remarks') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b text-center fs14" value="ー" name="notes">
		                                <p class="error-message m-0" data-error="notes"></p>
		                            </div>
		                        </div>
		                    </div>
		                    <div id="scatter-chart" class="item-block-property m30t p25" hidden="true"></div>
			            </div>
		            </div>
	            </div>

				<!-- 収支情報 -->
	            <div class="row m-0 mt-5">
		            <div class="row w-100 m-0">
		                <div class="col-12">
		                    <div id="simulation-result" class="item-block-property p33t p25r p35b p25l">
		                        <div class="row">
		                            <div class="col-12 text-left p0l m10b">
		                                <p class="fs16 fw-bold color-title-chart m-0">{{ __('attributes.register_info.item_block.title.simulation_result') }}</p>
		                                <div id="chart-simulation-add-home" class="m30t h295"></div>
		                                <p class="highcharts-description fs10 highcharts-note m15l" style="display: none">
		                                    {{ __('attributes.simulation_charts.note_1') }}<br/>
		                                    {{ __('attributes.simulation_charts.note_2') }}
		                                </p>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="row w-100 m-0 mt-3">
			            <div class="col-12 col-lg-6 col-xl-4">
		                    <div class="item-block-property p25 fs14">
		                        <div class="row m-0">
		                            <div class="col-12 m10b">
		                                <p class="fs16 fw-bold m-0">{{ __('attributes.register_info.item_block.title.registration_year') }}</p>
		                            </div>
		                        </div>
		                        <div class="row m-0">
		                            <div class="col-6 col-md-4">
		                                @php($dateYear = range('1950', date('Y')))
		                                <select id="date_year_registration_revenue" name="date_year_registration_revenue" class="form-control m5t m5b">
		                                    <option value="">---</option>
		                                    @foreach($dateYear as $year)
		                                        <option data-id="{{ $year }}" value="{{ $year }}">{{ $year }}年</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="date_year_registration_revenue"></p>
		                            </div>
		                            <div class="col-6 col-md-4 p0r">
		                                <select id="date_month_registration_revenue" name="date_month_registration_revenue" class="form-control m5t m5b">
		                                    <option value="">---</option>
		                                    @foreach(MONTH as $key => $month)
		                                        <option data-id="{{ $key }}" value="{{ $key }}">{{ $month }}</option>
		                                    @endforeach
		                                </select>
		                                <p class="error-message m-0" data-error="date_month_registration_revenue"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0">
		                            <p id="balance-period"></p>
		                        </div>
		                    </div>
		                    <div class="item-block-property p25 fs14 mt-3">
		                        <div class="row m-0">
		                            <div class="col-11 m10b">
		                                <p class="fs16 fw-bold m-0">{{ __('attributes.register_info.item_block.title.operating_revenue') }}<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
		                            </div>
		                            <div class="col-1 d-flex align-items-end justify-content-end">
		                                <p class="fs12 m-0">({{ __('attributes.common.yen') }})</p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">0</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" disabled class="disable-field form-control m5t m5b revenue_land_taxes operating-revenue text-right convert-data fs14" min="0" name="revenue_land_taxes" value="0">
		                                <p class="error-message m-0" data-error="revenue_land_taxes"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">1</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income_2') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_room_rentals" value="0">
		                                <p class="error-message m-0" data-error="revenue_room_rentals"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">2</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.service_revenue') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_service_charges" value="0">
		                                <p class="error-message m-0" data-error="revenue_service_charges"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">3</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_revenue') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_utilities" value="0">
		                                <p class="error-message m-0" data-error="revenue_utilities"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">4</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.parking_lot_revenue') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_car_deposits" value="0">
		                                <p class="error-message m-0" data-error="revenue_car_deposits"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">5</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.key_money_royalties') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="turnover_revenue" value="0">
		                                <p class="error-message m-0" data-error="turnover_revenue"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">6</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.renewal_fee') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_contract_update_fee" value="0">
		                                <p class="error-message m-0" data-error="revenue_contract_update_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">7</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_income') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="revenue_other" value="0">
		                                <p class="error-message m-0" data-error="revenue_other"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">8</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.etc') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-revenue text-right convert-data fs14" min="0" name="bad_debt" value="0">
		                                <p class="error-message m-0" data-error="bad_debt"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">9</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" disabled value="0" class="disable-field form-control m5t m5b fw-bold fs18 operating_expenses total-revenue convert-data text-right" name="total_revenue">
		                                <p class="error-message m-0 " data-error="total_revenue"></p>
		                            </div>
		                        </div>
		                    </div>
			            </div>
			            <div class="col-12 col-lg-6 col-xl-4 mt-3 mt-lg-0">
		                    <div class="item-block-property p25 fs14">
		                        <div class="row m-0">
		                            <div class="col-11 m10b">
		                                <p class="fs16 fw-bold m-0">{{ __('attributes.register_info.item_block.title.operating_cost') }}<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
		                            </div>
		                            <div class="col-1 d-flex align-items-end justify-content-end">
		                                <p class="fs12 m-0">({{ __('attributes.common.yen') }})</p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">10</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.management_fee') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="maintenance_management_fee" value="0">
		                                <p class="error-message m-0" data-error="maintenance_management_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">11</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_expenses') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="electricity_gas_charges" value="0">
		                                <p class="error-message m-0" data-error="electricity_gas_charges"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">12</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.repair_fee') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="repair_fee" value="0">
		                                <p class="error-message m-0" data-error="repair_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">13</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.intact_reply_fee') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="recovery_costs" value="0">
		                                <p class="error-message m-0" data-error="recovery_costs"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">14</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.property_management_fee') }}<br>{{ __('attributes.register_info.item_block.label.property_management_fee_1') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="property_management_fee" value="0">
		                                <p class="error-message m-0" data-error="property_management_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">15</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="find_tenant_fee" value="0">
		                                <p class="error-message m-0" data-error="find_tenant_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">16</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.taxes_dues') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="tax" value="0">
		                                <p class="error-message m-0" data-error="tax"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">17</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.insurance_premium') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="loss_insurance" value="0">
		                                <p class="error-message m-0" data-error="loss_insurance"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">18</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.land_payment') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="land_rental_fee" value="0">
		                                <p class="error-message m-0" data-error="land_rental_fee"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">19</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_expenses') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class="form-control m5t m5b operating-fee text-right convert-data fs14" name="other_costs" value="0">
		                                <p class="error-message m-0" data-error="other_costs"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">20</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" disabled value="0" class="disable-field form-control m5t m5b fw-bold fs18 operating_expenses total-cost text-right convert-data" name="total_cost">
		                                <p class="error-message m-0" data-error="total_cost"></p>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="item-block-property p25 fs14  mt-3">
		                        <div class="row m-0">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="number-li">21</span>
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.operating_balance') }}</span>
		                                <span class="d-flex align-items-center m10l">(<span class="number-li m5r m5l">9</span>-<span class="number-li m5r m5l">20</span>)</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="hidden" value="0" disabled class="disable-field form-control m5t m5b fw-bold operating-expenses fs18 text-right convert-data"
		                                       name="operating_expenses">
		                                <input id="operating-expenses" type="text" value="0 円" disabled class="disable-field form-control m5t m5b fw-bold fs18 text-right">
		                                <p class="error-message m-0" data-error="operating_expenses"></p>
		                            </div>
		                        </div>
		                    </div>
			            </div>
			            <div class="col-12 col-lg-12 col-xl-4 mt-3 mt-xl-0">
		                    <div class="item-block-property p25 fs14">
		                        <div class="row m-0 p5t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rental_operating_area') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="text" class=" form-control m5t m5b fw-bold fs18 w-90 d-inline-block rental-percentage text-right convert-number-double-decimal" name="area_rental_operating" value="0.00"><span class="unit-yen">{{ __('attributes.common.square_meters') }}</span>
		                                <p class="error-message m-0" data-error="area_rental_operating"></p>
		                            </div>
		                        </div>
		                        <div class="row m-0 p10t">
		                            <div class="col-12 col-xl-5 d-flex align-items-center">
		                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.crop_yield') }}</span>
		                            </div>
		                            <div class="col-12 col-xl-7">
		                                <input type="hidden" disabled value="0.00" class="disable-field form-control m5t m5b fw-bold fs18 property-rental-percentage convert-data text-right" name="rental_percentage">
		                                <input id="rental-percentage" type="text" disabled value="0.00 %" class="disable-field form-control m5t m5b fw-bold fs18 text-right">
		                                <p class="error-message m-0" data-error="rental_percentage"></p>
		                            </div>
		                        </div>
		                    </div>
		                    <div id="spiderweb-chart" class="item-block-property  mt-3 p25"></div>
							<button type="button" class="btn custom-btn-success res-info-property w-100 h54 fs15 fs14-sp mt-3">{{ __('attributes.register_info.main.button_save_content') }}</button>
			            </div>
	                </div>
	            </div>


            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/highcharts/exporting.js')}}"></script>
    <script src="{{ asset('js/highcharts/highcharts-regression.js')}}"></script>
    <script src="{{ asset('js/regression/regression.js') }}"></script>
    <script src="{{ asset('dist/js/register-property.min.js') }}"></script>
@endsection
