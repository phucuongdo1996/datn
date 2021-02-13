<div class="item-block-property m15l">
    <div class="m0 m30b diagram-analysisu">
        <div class="col-12 p30 m25b diagram-block">
            <div class="m30b m0l">
                <div class="p0">
                    <p class="fs16 fw-bold m0">{{ trans('attributes.property.items_related_to_benefits') }}</p>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.property.area_can_for_rent') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="area_may_rent" value="{{ $property['area_may_rent'] ? number_format($property['area_may_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control text-right" id="area_may_rent" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.simple_assessment.rentable_ratio') }}<br class="spH" />{{ trans('attributes.essential.body.bed_effective_rate') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="rentable_floor_area_ratio" value="{{ division((float)$property['area_may_rent'] ?? 0 , (float)$property['total_area_floors'] ?? 0)  }} {{ trans('attributes.common.percent') }}" class="disable-field form-control text-center" id="rentable_floor_area_ratio" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.rental_operating_area') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="area_rental_operating" value="{{ $property['area_rental_operating'] ? number_format($property['area_rental_operating'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control text-right" id="area_rental_operating" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.crop_yield') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="rental_percentage" value="{{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}" class="disable-field form-control text-center" id="rental_percentage" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.security_deposit') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="deposit_guarantor" value="{{ $property['deposits'] ? number_format($property['deposits']) : "0" }} {{ trans('attributes.common.yen') }}" class="disable-field form-control text-right" id="deposit_guarantor" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
