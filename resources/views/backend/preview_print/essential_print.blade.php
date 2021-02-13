@extends('modal.preview.common_preview')
@section('title', __('attributes.essential_confirm.header.page_title') )
@section('content_preview')
    <div class="background-print">
    <div id="preview-print-essential" class="container fs12 p0r p0l">
        <div>
            <span class="essential-sub-title">{{ trans('attributes.essential.header.page_sub_title') }}</span>
            <div class="">
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.property_name') }}</div>
                            <div class="col-content-1 essential-pre border text-center" id="preview-display-house-name">{{ $property['house_name'] ?? "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.date_of_completion') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "" }}</div>
                        </div>
                    </div>
                </div>

                <div class="row m-0 m5t">
                    <div class=" col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.residence_indication') }}</div>
                    <div class="col-content-2 essential-pre border text-center" id="preview-display-address">{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) == "ー" ? "" : addressFormat($property['address_city'], $property['address_district'], $property['address_town'])}}</div>
                </div>
                <div class="row m-0 m5t">
                    <div class=" col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.traffic') }}</div>
                    <div id="preview-print-traffic" class="col-content-2 essential-pre border"></div>
                </div>
                <div class="row m-0 m5t">
                    <div class=" col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.price') }}</div>
                    <div id="preview-print-price" class="col-content-2 essential-pre border"></div>
                </div>
                <div class="row m-0 m5t">
                    <div class=" col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.lot_number') }}</div>
                    <div class="col-content-2 essential-pre border" id="preview-display-apartment-number"></div>
                </div>
                <div class="row m-0 m5t">
                    <div class=" col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.house_number') }}</div>
                    <div class="col-content-2 essential-pre border" id="preview-display-room-number"></div>
                </div>

                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.the_main_purpose') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['real_estate_type']['name'] ?? "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.construction') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['house_material']['name'] ?? "" }}</div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ __('attributes.essential.body.use_in_detail') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['detail_real_estate_type']['name'] ?? "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ __('attributes.essential.body.number_of_floors') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ materialFormat($property['basement'], $property['storeys'], true) }}</div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.total_land_area') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2" id="preview-print-ground-area-unit"></div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.building_floor_area') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2" id="preview-print-total-area-floors-unit"></div>
                        </div>
                    </div>
                </div>

                <div class="row m-0 m5t">
                    <div class="col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.floor_area_details') }}</div>
                    <div class="col-content-2 essential-pre border" id="preview-display-details-of-each-floor-area"></div>
                </div>

                <div class="row m0 m20t">
                    <div class="col-6 p0">
                        <span class="essential-sub-title">{{ trans('attributes.essential.body.matters_concerning_rights') }}</span>
                    </div>
                    <div class="col-6 p0 p5l">
                        <span class="essential-sub-title">{{ trans('attributes.essential.body.matters_concerning_leasehold') }}</span>
                    </div>
                </div>

                {{--Change design--}}
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.land_rights') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['land_right']['name'] }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.leasehold_type') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['type_rental']['name'] ?? "" }}</div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.building_right') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['building_right']['name'] ?? "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.leased_land_area') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2" id="preview-print-area-rent"></div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.leasable_area') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2" id="preview-print-area-may-rent"></div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.land_lease_period') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['rental_period_from'] ? dateTimeFormat($property['rental_period_from']) : "" }}</div>
                        </div>
                    </div>
                </div>


                <div class="row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.rent-a-file_ratio') . trans('attributes.essential.body.bed_effective_rate') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ isset($annualPerformance['area_may_rent']) ? (division((float)$annualPerformance['area_may_rent'] ?? 0 ,(float)$property['total_area_floors'] ?? 0) . trans('attributes.common.percent')) : "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.during_the_lease_period') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['rental_period_to'] ? dateTimeFormat($property['rental_period_to']) : "" }}</div>
                        </div>
                    </div>
                </div>

                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.rental_operating_area') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2" id="preview-print-area-rental-operating"></div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.current_land_rent_agreement_date') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "" }}</div>
                        </div>
                    </div>
                </div>

                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.occupancy_rate') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2">{{ isset($annualPerformance['crop_yield']) ? numberFormatWithUnit($annualPerformance['crop_yield'], trans('attributes.common.percent')) : "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.security_deposit') }}</div>
                            <div class="col-content-1 essential-pre border text-center pr-2">{{ $property['deposit_host'] == "" ? "" : $property['deposit_host'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.security_deposit') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2">{{ isset($annualPerformance['deposits']) ? numberFormatWithUnit($annualPerformance['deposits'], trans('attributes.common.yen')) : "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.money') }}</div>
                            <div class="col-content-1 essential-pre border text-center pr-2">{{ $property['prize_money'] == "" ? "" : $property['prize_money'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="essential-break-inside row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.operating_balance') }}</div>
                            <div class="col-content-1 essential-pre border text-right pr-2">{{ isset($annualPerformance['sum_difference']) ? numberFormatWithUnit($annualPerformance['sum_difference'], trans('attributes.common.yen')) : "" }}</div>
                        </div>
                    </div>
                    <div class="essential-break-inside col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.nominal_book_change') }}</div>
                            <div class="col-content-1 essential-pre border text-center pr-2">{{ $property['room_cede_fee'] == "" ? "" : $property['room_cede_fee'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.NOI_yield') }}</div>
                            <div class="col-content-1 essential-pre border text-center" id="noi-yield">{{ isset($annualPerformance['sum_difference']) ? division((float)$annualPerformance['sum_difference'], (float)$generalInfo['price']) . trans('attributes.common.percent') : "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.rebuilding_consent_fee') }}</div>
                            <div class="col-content-1 essential-pre border text-center pr-2">{{ $property['fee_rebuild_rented_house'] == "" ? "" : $property['fee_rebuild_rented_house'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t 2-col min-h-100">
                    <div class="col-6 p0 p5r">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{!! trans('attributes.property.assess_revenue_expenditure2') !!}</div>
                            <div class="col-content-1 essential-pre border text-center centered" id="preview-display-synthetic-point">{{ isset($annualPerformance['synthetic_point']) ? number_format($annualPerformance['synthetic_point']) : "" }}</div>
                        </div>
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0 h-100">
                            <div class="col-label-1 essential-pre font-weight-bold border centered-vertical">{{ trans('attributes.essential.body.update') }}</div>
                            <div class="col-content-1 essential-pre border text-center pr-2 centered">{{ $property['contract_update_fee'] == "" ? "" : $property['contract_update_fee'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="essential-break-inside row m-0 m5t 2-col">
                    <div class="col-6 p0 p5r">
                    </div>
                    <div class="col-6 p0 p5l">
                        <div class="row m-0">
                            <div class="col-label-1 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.remarks') }}</div>
                            <div class="col-content-1 essential-pre border text-center">{{ $property['notes'] ?? "" }}</div>
                        </div>
                    </div>
                </div>

                <div class="essential-break-inside row m-0 m5t">
                    <div class="col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.access_road') }}</div>
                    <div class="col-content-2 essential-pre border" id="preview-display-near-road"></div>
                </div>
                <div class="essential-break-inside row m-0 m5t">
                    <div class="col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.application_area') }}</div>
                    <div class="col-content-2 essential-pre border">
                        <div class="no-border w-100 text-area-print" id="preview-display-area-used"></div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t">
                    <div class="col-label-2 essential-pre font-weight-bold border">{{ trans('attributes.essential.body.remarks') }}</div>
                    <div class="col-content-2 essential-pre border">
                        <div class="no-border w-100 text-area-print" id="preview-display-notes"></div>
                    </div>
                </div>
                <div class="essential-break-inside row m-0 m5t">
                    <div class="col-label-2 essential-pre font-weight-bold border">
                        {{ trans('attributes.essential.body.residential_building_trader') }}<br>
                        {{ trans('attributes.essential.body.memo') }}</div>
                    <div class="col-content-2 essential-pre border">
                        <div class="no-border w-100 text-area-print" id="preview-print-memo-broker"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="preview-print-essential-image" class="container fs12 p0r p0l">
        <div class="row border ml-0 mr-0" style="padding: 5px">
            <div class="col-12 row m0">
                <div class="col-6 image-map-1">
                    <span class="essential-sub-title">位置図</span>
                    <div class="image-location-map-1 m5t">
                        <div class="essential-img essential-icon-img border-0">
                            @if(isset($generalInfo['map_image_1']))
                                <img id="preview-print-map-image-1" class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_1']) }}">
                            @else
                                <img id="preview-print-map-image-1" src="{{ asset('images/icon-img.png') }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-6 image-map-2">
                    <span class="essential-sub-title">公図</span>
                    <div class="image-location-map-2 m5t">
                        <div class="essential-img essential-icon-img border-0">
                            @if(isset($generalInfo['map_image_2']))
                                <img id="preview-print-map-image-2" class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_2']) }}">
                            @else
                                <img id="preview-print-map-image-2" src="{{ asset('images/icon-img.png') }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="title-imames-info-print" class="col-12 m10t">
                <span class="col-12 essential-sub-title m30t">平面図等</span>
            </div>
            <div id="images-info-print" class="col-12 row m0 m5t"></div>
        </div>
    </div>
</div>
@endsection
