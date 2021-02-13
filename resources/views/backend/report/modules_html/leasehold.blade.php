<div class="item-block-property m15l">
    <div class="m0 m30b diagram-analysisu">
        <div class="col-12 p30 m25b diagram-block">
            <div class="m30b m0l">
                <div class="p0">
                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.leasehold') }}</p>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.leasehold_type') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="leasehold_type" value="{{ $property['type_rental']['name'] ?? "ー" }}" class="disable-field form-control text-center" id="type_rental_id" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.leased_land_area') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="area_rent" value="{{ $property['area_rent'] ? number_format($property['area_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control text-right" id="area_rent" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.lease_period_own') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="rental_period_from" value="{{ $property['rental_period_from'] ? dateTimeFormat($property['rental_period_from']) : "ー" }}" class="disable-field form-control text-center" id="rental_period_from" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.lease_period_to') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="rental_period_to" value="{{ $property['rental_period_to'] ? dateTimeFormat($property['rental_period_to']) : "ー" }}" class="disable-field form-control text-center" id="rental_period_to" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.current_rent_agreement_date') }}<br class="spH" /><span class="fs12">{{ trans('attributes.balance.body.latest_rent_update_date') }}</span></span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="date_lease" value="{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "ー" }}" class="disable-field form-control text-center" id="date_lease" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.security_deposit') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="deposit_host" value="{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}" class="disable-field form-control text-center" id="deposit_host" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.royalties') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="prize_money" value="{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money'] }}" class="disable-field form-control text-center" id="prize_money" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.nominal_book_change') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="room_cede_fee" value="{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}" class="disable-field form-control text-center" id="room_cede_fee" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.property.approval_fee') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="fee_rebuild_rented_house" value="{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}" class="disable-field form-control text-center" id="fee_rebuild_rented_house" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.update') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="contract_update_fee" value="{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}" class="disable-field form-control text-center" id="contract_update_fee" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
