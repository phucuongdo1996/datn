<div id="essential-confirm-screen"
     class="essential container-fluid container-wrapper essential-full-view d-none">
    <div class="essential-content essential-blade-content">
        <div class="row m0 essential-header media-575-p20r media-575-p20l p15lr">
            <h3 class="m0">
                {{ __('attributes.essential_confirm.header.page_title') }}
            </h3>
            <div class="col-12 p0 m13t">
                <div class="row m0">
                    <div class="col-8 text-end">
                        <span class="essential-sub-title">
                            {{ __('attributes.essential.header.page_sub_title') }}
                        </span>
                    </div>
                    <div class="col-4 text-right div-block-button">
                        <button type="button"
                            class="btn custom-btn-default fs15 m5t w70 h35 btn-essential-confirm-back d-none d-sm-inline-block">
                            {{ __('attributes.essential_confirm.header.btn_back') }}
                        </button>
                        <button type="submit"
                            class="btn custom-btn-success fs15 m5t m5l w70 h35 d-none d-sm-inline-block">
                            {{ __('attributes.essential_confirm.header.btn_registration') }}
                        </button>
                        <button type="button" class="btn custom-btn-success fs15 m5t m5l w140 h35 btn-preview-print d-none d-sm-inline-block show-print">
                            {{ trans('attributes.balance.header.btn_preview') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="p15lr">
            <div class="row m0 m30t essential-body">
                <div class="col-lg-12">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.property_name') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-left" id="display-house-name"
                                   value="{{ $property['house_name'] ?? "" }}" disabled>
                            <input type="text" class="form-control essential-input fs14 text-left" id="display-house-name-hidden"
                                   value="{{ trans('attributes.common.private_info') }}" disabled>
                        </div>

                        <div class="col-12 col-xl-2 essential-row-text-center essential-m15t">
                            <span class="essential-text essential-p30l">
                                {{ __('attributes.essential.body.date_of_completion') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-center"
                                   value="{{ $property['construction_time'] ? date("Y/m/d", strtotime($property['construction_time'])) : "ー" }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.residence_indication') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-10 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-left" id="display-address"
                                   value="{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) }}" disabled>
                            <input type="text" class="form-control essential-input fs14 text-left" id="display-address-hidden"
                                   value="{{ $property['address_city'] }} {{ $property['address_district'] }} {{ trans('attributes.common.private_address_info') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.traffic') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-10 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-left" id="traffic" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.price') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-10 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-left" id="price" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.lot_number') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input id="display-apartment-number" type="text" class="form-control essential-input fs14 text-left"
                                   value="{{ $property['apartment_number'] ?? "ー" }}" disabled>
                            <input id="display-apartment-number-hidden" type="text" class="form-control essential-input fs14 text-left"
                                   value="{{ trans('attributes.common.private_info') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.house_number') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input id="display-room-number" type="text" class="form-control essential-input fs14 text-left"
                                   value="{{ $property['room_number'] ?? 'ー' }}" disabled>
                            <input id="display-room-number-hidden" type="text" class="form-control essential-input fs14 text-left"
                                   value="{{ trans('attributes.common.private_info') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.the_main_purpose') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-center"
                                   value="{{ $property['real_estate_type']['name'] ?? "" }}" disabled>
                        </div>
                        <div class="col-12 col-xl-2 essential-row-text-center essential-m15t">
                            <span class="essential-text essential-p30l">
                                {{ __('attributes.essential.body.construction') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-center"
                                   value="{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.use_in_detail') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-center"
                                   value="{{ $property['detail_real_estate_type']['name'] ?? "" }}" disabled>
                        </div>
                        <div class="col-12 col-xl-2 essential-row-text-center essential-m15t">
                            <span class="essential-text essential-p30l">
                                {{ __('attributes.essential.body.number_of_floors') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-center"
                                   value="{{ materialFormat($property['basement'], $property['storeys']) }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.total_land_area') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input id="confirm-ground-area" type="text" class="form-control essential-input fs14 text-right"
                                   value="{{ numberFormatWithUnit($property['ground_area'], trans('attributes.common.square_meters')) }}" disabled>
                        </div>
                        <div class="col-12 col-xl-2 essential-row-text-center essential-m15t">
                            <span class="essential-text essential-p30l">
                                {{ __('attributes.essential.body.building_floor_area') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-4 essential-m10t">
                            <input id="confirm-total-area-floors" type="text" class="form-control essential-input fs14 text-right"
                                   value="{{ numberFormatWithUnit($property['total_area_floors'], trans('attributes.common.square_meters')) }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 m15t">
                    <div class="row m0">
                        <div class="col-12 col-xl-2 essential-row-text-center">
                            <span class="essential-text">
                                {{ __('attributes.essential.body.floor_area_details') }}
                            </span>
                        </div>
                        <div class="col-12 col-xl-10 essential-m10t">
                            <input type="text" class="form-control essential-input fs14 text-left"
                                   id="display-details-of-each-floor-area" disabled>
                            <input type="text" class="form-control essential-input fs14 text-left"
                                   id="display-details-of-each-floor-area-hidden" value="{{ trans('attributes.common.private_info') }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Change layout--}}
        <div class="m30t">
            <div class="row m0">
                <div class="col-12 col-xl-6 p0l p15lr media-1199-p0r">
                    <div class="essential-body-special fill-height">
                        <div class="col-12">
                            <span class="col-12 essential-body-title">
                                {{ trans('attributes.essential.body.matters_concerning_rights') }}
                            </span>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.land_rights') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['land_right']['name'] ?? "ー" }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.building_right') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['building_right']['name'] ?? "ー" }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        年度月期
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    @if($hideAnnualPerformance)
                                        <input type="text" class="form-control essential-input text-center fs14"
                                               value="ー" disabled>
                                    @else
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $params['year'] . trans('attributes.common.year') }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "ー" }}" disabled>
                                    @endif
                                </div>
                            </div>
                        </div>



                        @if(!$hideAnnualPerformance)
                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.leasable_area') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input id="confirm-area-may-rent" type="text" class="form-control essential-input fs14 text-right"
                                           value="{{ $annualPerformance['area_may_rent'] ? number_format($annualPerformance['area_may_rent']) : "0" }}{{ trans('attributes.common.square_meters') }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.rent-a-file_ratio') }}<br>
                                        {{ trans('attributes.essential.body.bed_effective_rate') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ division((float)$annualPerformance['area_may_rent'] ?? 0 ,(float)$property['total_area_floors'] ?? 0) }}{{ trans('attributes.common.percent') }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.rental_operating_area') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input id="confirm-area-rental-operating" type="text" class="form-control essential-input fs14 text-right"
                                           value="{{ numberFormatWithUnit($annualPerformance['area_rental_operating'], trans('attributes.common.square_meters')) }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.occupancy_rate') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $annualPerformance['crop_yield'] ? number_format($annualPerformance['crop_yield'], 2) : "0" }}{{ trans('attributes.common.percent') }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.security_deposit') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-right fs14"
                                           value="{{ $annualPerformance['deposits'] ? number_format($annualPerformance['deposits']) : "0" }} {{ trans('attributes.common.yen') }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.operating_balance') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-right fs14"
                                           value="{{ $annualPerformance['sum_difference'] ? number_format($annualPerformance['sum_difference']) : "0" }} {{ trans('attributes.common.yen') }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.NOI_yield') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14 noi-yield"
                                           value="{{ division((float)$annualPerformance['sum_difference'] ?? 0 , (float)$generalInfo['price'] ?? 0)  }}{{ trans('attributes.common.percent') }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                       {!! trans('attributes.property.assess_revenue_expenditure2') !!}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input id="display-synthetic-point" type="text"
                                           class="form-control essential-input text-center fs14"
                                           value="{{ $annualPerformance['synthetic_point'] ? number_format($annualPerformance['synthetic_point']) : "0" }} {{ trans('attributes.common.points') }}"
                                           disabled>
                                    <input type="text" class="form-control essential-input fs14 text-center" id="display-synthetic-point-hidden"
                                           value="{{ trans('attributes.common.private_point') }}" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-xl-6 p0r p15lr media-1199-p0l media-1199-m30t">
                    <div class="essential-body-special">
                        <div class="col-12">
                            <span class="col-12 essential-body-title">
                                {{ trans('attributes.essential.body.matters_concerning_leasehold') }}
                            </span>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.leasehold_type') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['type_rental']['name'] ?? "ー" }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.leased_land_area') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input id="confirm-display-area-rent" type="text" class="form-control essential-input fs14 text-right"
                                           value="{{ $property['area_rent'] ? number_format($property['area_rent']) : "0" }}{{ trans('attributes.common.square_meters') }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.land_lease_period') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['rental_period_from'] ? date("Y/m/d", strtotime($property['rental_period_from'])) : "ー" }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.during_the_lease_period') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['rental_period_to'] ? date("Y/m/d", strtotime($property['rental_period_to'])) : "ー" }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.current_land_rent_agreement_date') }}<br>
                                        {{ trans('attributes.essential.body.latest_rent_update_date') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['date_lease'] ? date("Y/m/d", strtotime($property['date_lease'])) : "ー" }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.security_deposit') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.money') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money']   }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.nominal_book_change') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.rebuilding_consent_fee') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.update') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-4 essential-row-text-center">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.remarks') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['notes'] ?? "ー" }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p15lr">
            <div class="m30t essential-body">
                <div class="row m0">
                    <div class="col-12">
                        <span class="col-12 essential-body-title">
                            {{ __('attributes.essential.body.exam_preparation') }}
                        </span>
                    </div>

                    <div class="col-12 m15t">
                        <div class="row m0">
                            <div class="col-12 col-xl-2">
                                <span class="essential-text l32h">
                                    {{ __('attributes.essential.body.access_road') }}
                                </span>
                            </div>
                            <div class="col-12 col-xl-10 essential-m10t">
                                <input type="text" class="form-control essential-input fs14 text-left fs14" id="display-near-road" disabled>
                                <input type="text" class="form-control essential-input fs14 text-left fs14" id="display-near-road-hidden" value="{{ trans('attributes.common.private_info') }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 m15t">
                        <div class="row m0">
                            <div class="col-12 col-xl-2">
                                <span class="essential-text">
                                    {{ __('attributes.essential.body.application_area') }}
                                </span>
                            </div>
                            <div class="col-12 col-xl-10 essential-m10t">
                                <textarea id="display-area-used" class="form-control border-0 essential-border-radius-0 text-left fs14"
                                          rows="5" disabled></textarea>
                                <textarea id="display-area-used-hidden" class="form-control border-0 essential-border-radius-0 text-left fs14"
                                          rows="5" disabled>{{ trans('attributes.common.private_info') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 m15t">
                        <div class="row m0">
                            <div class="col-12 col-xl-2">
                                <span class="essential-text">
                                    {{ __('attributes.essential.body.remarks') }}
                                </span>
                            </div>
                            <div class="col-12 col-xl-10 essential-m10t">
                                <textarea id="display-notes" class="form-control border-0 essential-border-radius-0 text-left fs14"
                                          rows="5" disabled></textarea>
                                <textarea id="display-notes-hidden" class="form-control border-0 essential-border-radius-0 text-left fs14"
                                          rows="5" disabled>{{ trans('attributes.common.private_info') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 m15t">
                        <div class="row m0">
                            <div class="col-12 col-xl-2">
                                <span class="essential-text">
                                    {{ __('attributes.essential.body.residential_building_trader') }}<br>
                                    {{ __('attributes.essential.body.memo') }}
                                </span>
                            </div>
                            <div class="col-12 col-xl-10 essential-m10t">
                                <textarea class="form-control border-0 essential-border-radius-0 text-left fs14" rows="3"
                                          id="memo-broker" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p15lr">
            <div class="m30t essential-body">
                <div class="row m0">
                    <div class="col-12">
                        <span class="col-12 essential-body-title">
                            {{ __('attributes.essential.body.location') }}
                        </span>
                    </div>

                    <div class="col-12 m15t">
                        <div class="row m0">
                            <div class="col-6">
                            <span class="essential-sub-title m5b">
                                {{ __('attributes.essential.body.location_map') }}</span>
                                <div class="confirm-image-location-map-1">
                                    <div class="essential-img essential-icon-img border-0">
                                        @if(isset($generalInfo['map_image_1']))
                                            <img id="map-image-1" class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_1']) }}">
                                        @else
                                            <img id="map-image-1" src="{{ asset('images/icon-img.png') }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                            <span class="essential-sub-title m5b">
                                {{ __('attributes.essential.body.public_map') }}</span>
                                <div class="confirm-image-location-map-2">
                                    <div class="essential-img essential-icon-img border-0">
                                        @if(isset($generalInfo['map_image_2']))
                                            <img id="map-image-2" class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_2']) }}">
                                        @else
                                            <img id="map-image-2" src="{{ asset('images/icon-img.png') }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 m10t">
                        <span class="col-12 essential-body-title m15t m5b">
                            {{ __('attributes.essential.body.plan_view') }}
                        </span>
                    </div>

                    <div class="col-12 row m0">
                        <div class="col-6">
                            <div class="border-0 essential-img essential-icon-img essential-confirm-img confirm-img-info">
                                @if(isset($generalInfo['map_image_1']))
                                    <img id="preview-image-1" class="confirm-img-info img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_1']) }}">
                                @else
                                    <img id="preview-image-1" src="{{ asset('images/icon-img.png') }}"
                                         class="confirm-img-info">
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row m0">
                                <div class="col-4">
                                    <div class="border-0 essential-img essential-icon-img essential-confirm-img-sub confirm-img-info">
                                        @if(isset($generalInfo['map_image_2']))
                                            <img id="preview-image-2" class="confirm-img-info img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_1']) }}">
                                        @else
                                            <img id="preview-image-2" src="{{ asset('images/icon-img.png') }}"
                                                 class="confirm-img-info">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-0 essential-img essential-icon-img essential-confirm-img-sub confirm-img-info">
                                        <img id="preview-image-3" src="{{ asset('images/icon-img.png') }}"
                                             class="confirm-img-info">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-0 essential-img essential-icon-img essential-confirm-img-sub confirm-img-info">
                                        <img id="preview-image-4" src="{{ asset('images/icon-img.png') }}"
                                             class="confirm-img-info">
                                    </div>
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col-4 m10t">
                                    <div class="border-0 essential-img essential-icon-img essential-confirm-img-sub confirm-img-info">
                                        <img id="preview-image-5" src="{{ asset('images/icon-img.png') }}"
                                             class="confirm-img-info">
                                    </div>
                                </div>
                                <div class="col-4 m10t">
                                    <div class="border-0 essential-img essential-icon-img essential-confirm-img-sub confirm-img-info">
                                        <img id="preview-image-6" src="{{ asset('images/icon-img.png') }}"
                                             class="confirm-img-info">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p15lr">
            <div class="row m0">
                <div class="col-12 text-right div-block-button media-575-p20r m30t">
                    <button type="button" class="btn custom-btn-default fs15 w70 h35 btn-essential-confirm-back">
                        {{ __('attributes.essential_confirm.header.btn_back') }}
                    </button>
                    <button type="submit"
                            class="btn custom-btn-success m5l fs15 w70 h35">
                        {{ __('attributes.essential_confirm.header.btn_registration') }}
                    </button>
                    <button type="button" class="btn custom-btn-success m5l fs15 w140 h35 btn-preview-print d-none d-sm-inline-block">
                        {{ trans('attributes.balance.header.btn_preview') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
