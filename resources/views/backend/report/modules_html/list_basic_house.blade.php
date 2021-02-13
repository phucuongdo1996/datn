<div class="item-block-property m15r">
    <div class="m0 m30b diagram-analysisu">
        <div class="col-12 p30 m25b diagram-block">
            <div class="m30b m0l">
                <div class="p0">
                    <p class="fs16 fw-bold m0">{{ trans('attributes.property.list_basic_house') }}</p>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.property.house_name') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0 centered-vertical w-100">
                        <span name="name" class="fs14 text-center break-all custom-input" readonly="readonly" id="name">{{ $property['house_name'] ?? '' }}</span>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.location') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="address" value="{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) }}" class="disable-field form-control text-center" id="address" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.the_main_purpose') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="uses" value="{{ $property['real_estate_type']['name'] ?? "ー" }}" class="disable-field form-control text-center" id="uses" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.use_in_detail') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="detail_real_estate_type" value="{{ $property['detail_real_estate_type']['name'] ?? "ー" }}" class="disable-field form-control text-center" id="details" disabled>
                    </div>
                </div>
            </div>
            @if($property['real_estate_type_id'] == FLAG_TEN)
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.property.main_application') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="main_application" value="{{ $property['real_estate_type_id'] == FLAG_TEN &&  $property['main_application'] ? MAIN_APPLICATION[$property['main_application']] : "ー" }}" class="disable-field form-control text-center" id="main-application" disabled>
                    </div>
                </div>
            </div>
            @endif
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.construction') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="construction" value="{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}" class="disable-field form-control text-center" id="structure" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.floor') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="floor" value="{{ materialFormat($property['basement'], $property['storeys']) }}" class="disable-field form-control text-center" id="floor" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.total_land_area') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="d-flex">
                        <div class="col-6 p0 p5r">
                            <input name="ground_area" value="{{ $property['ground_area'] ? number_format($property['ground_area'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control text-right" id="ground_area" disabled>
                        </div>
                        <div class="col-6 p0 p5l">
                            <input name="ground_area_unit_1" value="{{ $property['ground_area'] ? number_format($property['ground_area'] * 0.3025, 2) : "0.00" }} {{ trans('attributes.common.unit2') }}" class="disable-field form-control text-right" id="ground_area_unit_1" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.building_floor_area') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="d-flex">
                        <div class="col-6 p0 p5r">
                            <input name="total_floor_area" value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control text-right" id="total_floor_area" disabled>
                        </div>
                        <div class="col-6 p0 p5l">
                            <input name="total_floor_area_unit_2" value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'] * 0.3025, 2) : "0" }} {{ trans('attributes.common.unit2') }}" class="disable-field form-control text-right" id="total_floor_area_unit_2" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.date_of_completion') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="date_of_construction" value="{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "ー" }}" class="disable-field form-control text-center" id="date_of_construction" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
