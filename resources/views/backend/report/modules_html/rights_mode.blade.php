<div class="item-block-property m15r">
    <div class="m0 m30b diagram-analysisu">
        <div class="col-12 p30 m25b diagram-block">
            <div class="m30b m0l">
                <div class="p0">
                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.rights_mode') }}</p>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.land_rights') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="land_rights" value="{{ $property['land_right']['name'] ?? "ー" }}" class="disable-field form-control text-center" id="land_right_id" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.building_rights') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="building_right" value="{{ $property['building_right']['name'] ?? "ー" }}" class="disable-field form-control text-center" id="building_right_id" disabled>
                    </div>
                </div>
            </div>
            <div class="row m-0 p0 p10t">
                <div class="col-4 col-12-sp p0 d-flex align-items-center">
                    <span class="d-inline-block">{{ trans('attributes.balance.body.total_number_of_tenants') }}</span>
                </div>
                <div class="col-8 col-12-sp p0">
                    <div class="col-12 p0">
                        <input name="total_tenants" value="{{ number_format($property['total_tenants']) }}" class="disable-field form-control text-center" id="total_tenants" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
