<div class="table-responsive table-pre-property">
<table class="table table-preview">
        <tbody>
        <tr>
            <td class="fw-bold" colspan="3">{{__('attributes.property.property_no')}}</td>
            @for ($i = $start; $i < $length; $i++)
                <td class="text-center"> {{__('attributes.property.house')}} {{ $indexNo + $i }} </td>
            @endfor
        </tr>
        <tr>
            <td class="fw-bold vertical-text" colspan="3">
                {{__('attributes.property.property_image')}}
            </td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td>
                        @if(empty($properties[$k]->avatar_thumbnail))
                            <div class="content-image"></div>
                        @else
                            <div class="content-image">
                                <img class="object-fit-contain" src="{{ !empty($properties[$k]->avatar_thumbnail) ? asset( PATH_THUMBNAIL_HOUSE . $properties[$k]->avatar_thumbnail ) : '' }}" alt="">
                            </div>
                        @endif
                    </td>
                @else
                    <td><div class="content-image"></div></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="3">{!! trans('attributes.property.registered_user') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">
                        @forelse($properties[$k]->subUserProperty as $subUser)
                            <div>{{ $subUser->profileUser->person_charge_last_name . $subUser->profileUser->person_charge_first_name }}</div>
                        @empty
                        @endforelse
                    </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold number-radius" colspan="3">{!! trans('attributes.property.status') !!} </td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->status ? STATUS_HOUSE[$properties[$k]->status] ?? '' : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        @if(in_array($currentUser->role, [BROKER, EXPERT]))
            <tr>
                <td class="fw-bold" colspan="3">{!! trans('attributes.property.owner') !!}</td>
                @for($k = $start; $k < $length; $k++)
                    @if (isset($properties[$k]))
                        <td class="text-center">{{ $properties[$k]->proprietor ?? '' }}</td>
                    @else
                        <td></td>
                    @endif
                @endfor
            </tr>
        @endif
        <tr>
            <td class="fw-bold td-vertical" rowspan="12">{!! trans('attributes.property.list_basic_house') !!}</td>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.date_of_receipt') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->receive_house_date ? date("Y/m/d", strtotime($properties[$k]->receive_house_date)) : "" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.house_price') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->money_receive_house ? number_format($properties[$k]->money_receive_house) . ' ' .trans('attributes.common.yen') : '0 円' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.house_name') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->house_name }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.address2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->address_city . ' ' . $properties[$k]->address_district . ' ' . $properties[$k]->address_town }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.main_purpose') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ isset($properties[$k]->realEstateType->name) ? $properties[$k]->realEstateType->name : "" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.detailed_description_of_purpose') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ isset($properties[$k]->detailRealEstateType->name) ? $properties[$k]->detailRealEstateType->name : "" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.main_application') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ isset($properties[$k]->main_application) ? MAIN_APPLICATION[$properties[$k]->main_application] : "" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.house_structure') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ materialFormat($properties[$k]->houseMaterial ? $properties[$k]->houseMaterial->name : null, $properties[$k]->houseRoofType ? $properties[$k]->houseRoofType->name : null, true) }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.number_floors') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ materialFormat($properties[$k]->basement, $properties[$k]->storeys, true) }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.ground_area') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->ground_area ? number_format($properties[$k]->ground_area, 2) . ' ' . trans('attributes.common.m2') : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.total_area_of_​​floors') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->total_area_floors ? number_format($properties[$k]->total_area_floors, 2) . ' ' . trans('attributes.common.m2') : '' }}  </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.construction_time') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->construction_time ? date("Y/m/d", strtotime($properties[$k]->construction_time)) : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold td-vertical" rowspan="8">{!! trans('attributes.property.items_related_to_benefits') !!}</td>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.authority_rights') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->landRight) ? $properties[$k]->landRight->name : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.authority_building') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->buildingRight) ? $properties[$k]->buildingRight->name : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.total_tenants') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->total_tenants ? number_format($properties[$k]->total_tenants) : '0' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.area_can_for_rent') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->area_may_rent ? number_format($properties[$k]->area_may_rent, 2)  . ' ' . trans('attributes.common.m2') : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.floor_rate_for_rent') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->floor_rate_for_rent ? number_format((float)$properties[$k]->floor_rate_for_rent, 2, '.', ',') . trans('attributes.common.percent') : '0.00%' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.area_for_rent') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->area_rental_operating ? number_format($properties[$k]->area_rental_operating, 2)  . ' ' . trans('attributes.common.m2') : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.rental_rate') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->rental_percentage ? number_format((float)$properties[$k]->rental_percentage, 2, '.', ',') . trans('attributes.common.percent') : '0.00%' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.deposit') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->deposits ? number_format($properties[$k]->deposits)  . ' ' . trans('attributes.common.yen') : '0 円' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold td-vertical" rowspan="11">{!! trans('attributes.property.rental_rights') !!}</td>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.rental_type') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? $properties[$k]->typeRental->name : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.area_for_rents') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->area_rent ? number_format($properties[$k]->area_rent, 2)  . ' ' . trans('attributes.common.m2') : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.rent_from') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->rental_period_from ? date("Y/m/d", strtotime($properties[$k]->rental_period_from)) : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.rent_to_date') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->rental_period_to ? date("Y/m/d", strtotime($properties[$k]->rental_period_to)) : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.date_of_current_rental_agreement2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->date_lease ? date("Y/m/d", strtotime($properties[$k]->date_lease)) : '' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.deposit') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? ($properties[$k]->deposit_host == "" ? trans('attributes.common.no_stipulation') : $properties[$k]->deposit_host) : "ー" }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.money') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? ($properties[$k]->prize_money == "" ? trans('attributes.common.no_stipulation') : $properties[$k]->prize_money) : "ー" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.room_ceding_fee') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? ($properties[$k]->room_cede_fee == "" ? trans('attributes.common.no_stipulation') : $properties[$k]->room_cede_fee) : "ー" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.approval_fee') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? ($properties[$k]->fee_rebuild_rented_house == "" ? trans('attributes.common.no_stipulation') : $properties[$k]->fee_rebuild_rented_house) : "ー" }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.contract_update_fee') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ !empty($properties[$k]->typeRental) ? ($properties[$k]->contract_update_fee == "" ? trans('attributes.common.no_stipulation') : $properties[$k]->contract_update_fee) : "ー" }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold" colspan="2">{!! trans('attributes.property.notes') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->notes }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.date_business_registration') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">
                        {{ $properties[$k]->date_year_registration_revenue ? $properties[$k]->date_year_registration_revenue . trans('attributes.common.year') : ''}}
                        {{ $properties[$k]->date_month_registration_revenue ? MONTH[$properties[$k]->date_month_registration_revenue] : ''}}
                    </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold td-vertical" rowspan="3">{!! trans('attributes.property.item_head') !!}</td>
            <td class="fw-bold">{!! trans('attributes.property.operating_revenue') !!}</td>
            <td class="w-5"><div class="number-border-radius text-center">9</div></td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->total_revenue ? number_format($properties[$k]->total_revenue)  . ' ' . trans('attributes.common.yen') : '0 円' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td class="fw-bold">{!! trans('attributes.property.operating_fee') !!}</td>
            <td class="w-5"><div class="number-border-radius">20</div></td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->total_cost ? number_format($properties[$k]->total_cost)  . ' ' . trans('attributes.common.yen') : '0 円' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="2" class="fw-bold">{!! trans('attributes.property.cost_ratio') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->cost_ratio ? number_format((float)$properties[$k]->cost_ratio, 2, '.', ',') . trans('attributes.common.percent')  : '0.00%' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.revenue_and_expenditure_operating') !!} (<div class="number-border-radius-black">9</div> - <div class="number-border-radius-black">20</div>)</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->operating_revenue_expenditure ? number_format($properties[$k]->operating_revenue_expenditure)  . ' ' . trans('attributes.common.yen') : '0 円' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.assess_revenue_expenditure2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->synthetic_point ? round($properties[$k]->synthetic_point) . ' ' . trans('attributes.common.points') : '0 points' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.reduction_yield2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td data-id="net_profit{{ $properties[$k]->id }}" class="text-center">{{ $properties[$k]->net_profit ? number_format($properties[$k]->net_profit, 2) . trans('attributes.common.percent') : '0.00%' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.assessed_amount') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td  data-id="amount_assessed_taxing{{$properties[$k]->id}}" class="text-right">{{ $properties[$k]->amount_assessed_taxing ? number_format($properties[$k]->amount_assessed_taxing)  . ' ' . trans('attributes.common.yen') : '0 円' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.surface_yield2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->surface_yield ? number_format((float)$properties[$k]->surface_yield, 2, '.', ',') . trans('attributes.common.percent')  : '0.00%' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.operating_balance2') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->noi_yield ? number_format((float)$properties[$k]->noi_yield, 2, '.', ',') . trans('attributes.common.percent')  : '0.00%' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr><tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.borrowing_day') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->loan_date ? date("Y/m/d", strtotime($properties[$k]->loan_date)) : '' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr><tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.borrowing_financial_institutions') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center loan-bank-name loan-bank-branch-pre">{{ $properties[$k]->loan_bank_name . '/' . $properties[$k]->bank_branch_name }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.borrowing_amount') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->loan ? number_format($properties[$k]->loan)  . ' ' . trans('attributes.common.yen')  : '0 円' }} </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.during_initial_borrowing_period') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->contract_loan_period }} {{__('attributes.common.year')}}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.borrowed_interest') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->interest_rate ? number_format((float)$properties[$k]->interest_rate, 2, '.', ','). trans('attributes.common.percent')  : '0.00%' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.loan_balance') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td id="debt-balance-{{ $properties[$k]->id }}" class="text-right"></td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.annual_payment_principal_interes') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-right">{{ $properties[$k]->amount_paid_annually ? number_format($properties[$k]->amount_paid_annually) . ' '  . trans('attributes.common.yen') : '0 円' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        <tr>
            <td colspan="3" class="fw-bold">{!! trans('attributes.property.DSCR') !!}</td>
            @for($k = $start; $k < $length; $k++)
                @if (isset($properties[$k]))
                    <td class="text-center">{{ $properties[$k]->dscr ? number_format((float)$properties[$k]->dscr, 2, '.', ',') . trans('attributes.common.percent') : '0.00%' }}</td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
        </tbody>
    </table>
</div>
