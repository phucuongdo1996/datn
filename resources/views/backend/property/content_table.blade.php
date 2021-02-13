<tr>
    <td class="p20b p20t">
        <div class="content-div">
            <div class="row">
                <div class="col-6">
                    <label class="label-list fs16">{{__('attributes.property.house')}} {{ $step }}</label>
                </div>
                <div class="col-6 text-right">
                    <a id="btn-bar{{ $step }}" href="#" class="pointer sidebar-list"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list-house" aria-labelledby="btn-bar{{ $step }}">
                        <a class="dropdown-item edit-property" href="{{ route(USER_PROPERTY_EDIT, ['propertyId' => $property->id, 'screen' => 'property', 'page' => $properties->currentPage()]) }}">{{__('attributes.property.edit_house')}}</a>
                        <a class="dropdown-item" href="{{ route(USER_SINGLE_ANALYSIS, ['propertyId' => $property->id]) }}">{{__('attributes.property.analyze_revenue_expenditure_of_house')}}</a>
                        <a class="dropdown-item" href="{{ route(USER_PROPERTY_SIMPLE_ASSESSMENT, ['propertyId' => $property->id, 'screen' => 'property', 'option_paginate'=> FLAG_SEVEN]) }}">{{__('attributes.property.create_simple_surveys')}}</a>
                        @if($property->rentRolls->toArray())
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_RENT_ROLL_INDEX, ['propertyId' => $property->id]) }}">{{__('attributes.property.list_short_term_rental_status')}}</a>
                        @else
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_RENT_ROLL_CREATE, ['propertyId' => $property->id, 'screen' => 'property', 'page'=> $properties->currentPage()]) }}">{{__('attributes.property.list_short_term_rental_status')}}</a>
                        @endif
                        @if($property->monthlyBalances->toArray())
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, ['propertyId' => $property->id]) }}">{{__('attributes.property.monthly_revenue_expenditure_table')}}</a>
                        @else
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_CREATE, ['propertyId' => $property->id, 'screen' => 'property', 'page'=> $properties->currentPage()]) }}">{{__('attributes.property.monthly_revenue_expenditure_table')}}</a>
                        @endif
                        @if($property->annualPerformances->toArray())
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX, ['propertyId' => $property->id]) }}">{{__('attributes.property.year_achievements_table')}}</a>
                        @else
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE, ['propertyId' => $property->id, 'screen' => 'property', 'page'=> $properties->currentPage()]) }}">{{__('attributes.property.year_achievements_table')}}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route(USER_MOVE_REPAIR_HISTORY, ['propertyId' => $property->id, 'screen' => 'property', 'page'=> $properties->currentPage()]) }}">{{__('attributes.property.history_edit')}}</a>
                        @if($property->businessPlan)
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_BUSINESS_PLAN_EDIT, ['propertyId' => $property->id, 'screen' => 'property']) }}">{{__('attributes.property.business_plan')}}</a>
                        @else
                            <a class="dropdown-item" href="{{ route(USER_PROPERTY_BUSINESS_PLAN_CREATE, ['propertyId' => $property->id, 'screen' => 'property']) }}">{{__('attributes.property.business_plan')}}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route(USER_ESSENTIAL, ['id' => $property->id, 'screen' => 'property']) }}">{{__('attributes.property.essential_house')}}</a>
                        <a class="dropdown-item" href="#">{{__('attributes.property.team_chat')}}</a>
                        <a class="dropdown-item" href="#">{{__('attributes.property.support_free')}}</a>
                        <a class="dropdown-item" href="{{ route(USER_PROPERTY_SEARCH) }}">{{__('attributes.property.comparative_bank_comparison')}}</a>
                        <a class="dropdown-item text-red btn-delete-house" data-id="{{ $property->id }}" href="#">{{__('attributes.property.delete_house')}}</a>
                    </div>
                </div>
            </div>
            <div class="div-img-list">
                @if(empty($property->avatar_thumbnail))
                    <img class="img-list" src="{{ asset('images/default.jpg')  }}" alt="">
                @else
                    <img class="img-list object-fit-contain" src="{{ asset( PATH_THUMBNAIL_HOUSE . $property->avatar_thumbnail )  }}" alt="">
                @endif
            </div>
        </div>
    </td>
    <td class="border-top p20t p20b">
        @forelse($property->subUserProperty as $subUser)
            <div class="div-grey text-center break-all property-code m5t m5b">
                {{ $subUser->profileUser->person_charge_last_name . $subUser->profileUser->person_charge_first_name }}
            </div>
        @empty
            <div class="div-grey text-center break-all property-code m5t m5b">
            </div>
        @endforelse
    </td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">{{ $property->status ? STATUS_HOUSE[$property->status] ?? '' : '' }} </div></td>
    @if(in_array($currentUser->role, [BROKER, EXPERT]))
        <td class="border-top p20t p20b"><div class="div-grey text-center break-all proprietor display-center">{{ $property->proprietor }}</div></td>
    @endif
    <td class="border-top"></td>
    <td><div class="div-grey text-center">{{ $property->receive_house_date ? date("Y/m/d", strtotime($property->receive_house_date)) : "ー" }} </div></td>
    <td><div class="div-grey text-right">{{ $property->money_receive_house ? number_format($property->money_receive_house) . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen')}}</div></td>
    <td><div class="div-grey text-center break-all house-name display-center">{{ $property->house_name }}</div></td>
    <td><div class="div-grey text-center break-all address-city display-center">{{ addressFormat($property->address_city, $property->address_district, $property->address_town) }}</div></td>
    <td><div class="div-grey text-center break-all detail-real-estate-type display-center">{{ isset($property->realEstateType->name) ? $property->realEstateType->name : "ー" }}</div></td>
    <td><div class="div-grey text-center">{{ isset($property->detailRealEstateType->name) ? $property->detailRealEstateType->name : "ー" }} </div></td>
    <td><div class="div-grey text-center">{{ isset($property->main_application) ? MAIN_APPLICATION[$property->main_application] : "ー" }}</div></td>
    <td><div class="div-grey text-center break-all house-material display-center">{{ materialFormat($property->houseMaterial ? $property->houseMaterial->name : null, $property->houseRoofType ? $property->houseRoofType->name : null) }} </div></td>
    <td><div class="div-grey text-center">{{ materialFormat($property->basement, $property->storeys) }}</div></td>
    <td><div class="div-grey text-right">{{ $property->ground_area ? number_format((float)$property->ground_area, 2, '.', ',') . trans('attributes.common.m2') : '0.00 '. trans('attributes.common.m2') }} </div></td>
    <td><div class="div-grey text-right">{{ $property->total_area_floors ?number_format((float)$property->total_area_floors, 2, '.', ',') . trans('attributes.common.m2') : '0.00 '. trans('attributes.common.m2') }} </div></td>
    <td class="p20b"><div class="div-grey text-center">{{ $property->construction_time ? date("Y/m/d", strtotime($property->construction_time)) : 'ー' }} </div></td>
    <td class="border-top"></td>
    <td><div class="div-grey text-center">{{ !empty($property->landRight) ? $property->landRight->name : 'ー' }} </div></td>
    <td><div class="div-grey text-center">{{ !empty($property->buildingRight) ? $property->buildingRight->name : 'ー' }} </div></td>
    <td><div class="div-grey text-center">{{ $property->total_tenants ? number_format($property->total_tenants) : '0' }}</div></td>
    <td><div class="div-grey text-right">{{ $property->area_may_rent ? number_format($property->area_may_rent, 2)  . ' ' . trans('attributes.common.m2') : '0.00 '. trans('attributes.common.m2') }} </div></td>
    <td><div class="div-grey text-center">{{ $property->floor_rate_for_rent ? number_format((float)$property->floor_rate_for_rent, 2, '.', ',') . '%' : '0.00' . '%'}} </div></td>
    <td><div class="div-grey text-right">{{ $property->area_rental_operating ? number_format($property->area_rental_operating, 2)  . ' ' . trans('attributes.common.m2') : '0.00 ' . trans('attributes.common.m2') }} </div></td>
    <td><div class="div-grey text-center">{{ $property->rental_percentage ? number_format((float)$property->rental_percentage, 2, '.', ',') . '%' : '' }} </div></td>
    <td class="p20b"><div class="div-grey text-right">{{ $property->deposits ? number_format($property->deposits)  . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen') }} </div></td>
    <td class="border-top"></td>
    <td><div class="div-grey text-center break-all type-rental display-center">{{ !empty($property->typeRental) ? $property->typeRental->name : 'ー' }}</div></td>
    <td><div class="div-grey text-right">{{ $property->area_rent ? number_format($property->area_rent, 2)  . ' ' . trans('attributes.common.m2') : '0.00 ' . trans('attributes.common.m2') }} </div></td>
    <td><div class="div-grey text-center">{{ $property->rental_period_from ? date("Y/m/d", strtotime($property->rental_period_from)) : 'ー' }} </div></td>
    <td><div class="div-grey text-center">{{ $property->rental_period_to ? date("Y/m/d", strtotime($property->rental_period_to)) : 'ー' }} </div></td>
    <td><div class="div-grey text-center">{{ $property->date_lease ? date("Y/m/d", strtotime($property->date_lease)) : 'ー' }} </div></td>
    <td><div class="div-grey text-center break-all deposit-host display-center">{{ !empty($property->typeRental) ? ($property->deposit_host == "" ? trans('attributes.common.no_stipulation') : $property->deposit_host) : "ー" }} </div></td>
    <td><div class="div-grey text-center break-all prize-money display-center">{{ !empty($property->typeRental) ? ($property->prize_money == "" ? trans('attributes.common.no_stipulation') : $property->prize_money) : "ー" }} </div></td>
    <td><div class="div-grey text-center break-all room-cede-fee display-center">{{ !empty($property->typeRental) ? ($property->room_cede_fee == "" ? trans('attributes.common.no_stipulation') : $property->room_cede_fee) : "ー" }} </div></td>
    <td><div class="div-grey text-center break-all fee-rebuild-rented-house display-center">{{ !empty($property->typeRental) ? ($property->fee_rebuild_rented_house == "" ? trans('attributes.common.no_stipulation') : $property->fee_rebuild_rented_house) : "ー" }} </div></td>
    <td><div class="div-grey text-center break-all contract-update-fee display-center">{{ !empty($property->typeRental) ? ($property->contract_update_fee == "" ? trans('attributes.common.no_stipulation') : $property->contract_update_fee) : "ー" }} </div></td>
    <td class="p20b"><div class="div-grey text-center break-all notes display-center">{{ $property->notes ? $property->notes : 'ー' }} </div></td>
    <td class="border-top">
        <div class="div-grey text-center">
            {{ dateTimeFormatBorrowing($property->date_year_registration_revenue, $property->date_month_registration_revenue) }}
        </div>
    </td>
    <td class="border-top p20t"><div class="div-grey text-right">{{ $property->total_revenue ? number_format($property->total_revenue)  . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen') }} </div></td>
    <td><div class="div-grey text-right">{{ $property->total_cost ? number_format($property->total_cost)  . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen') }} </div></td>
    <td><div class="div-grey text-center">{{ $property->cost_ratio ? number_format((float)$property->cost_ratio, 2, '.', ',') . '%' : '0.00' . '%' }} </div></td>
    <td class="p20b"><div class="div-grey text-right">{{ $property->operating_revenue_expenditure ? number_format($property->operating_revenue_expenditure)  . ' ' . trans('attributes.common.yen') : '0 '. trans('attributes.common.yen') }} </div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">{{ $property->synthetic_point ? round($property->synthetic_point) . ' points' : '0 points' }}</div></td>
    <td class="border-top">
        <div class="content-div">
            <div class="text-right fs14 row margin-auto div-input">
                <input type="text" name="net_profit" class="form-control input-net-profit fs14 col-10 text-right convert-number-double-decimal" value="{{ $property->net_profit ? number_format($property->net_profit, FLAG_TWO) : '0.00'}}" data-error="net_profit{{$property->id}}" data-id="{{$property->id}}">
                <span class="col-1">%</span>
            </div>
            <p class="error-message error-net-profit error-list-house m0" data-error="net_profit{{$property->id}}"></p>
            <p class="error-message error-property-id error-list-house m0" data-error="property_id{{$property->id}}"></p>
        </div>
    </td>
    <td class="p20b"><div class="div-grey text-right" data-id="amount_assessed_taxing{{$property->id}}" >{{ $property->amount_assessed_taxing ? number_format($property->amount_assessed_taxing)  . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen')}} </div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">{{ $property->surface_yield ? number_format((float)$property->surface_yield, 2, '.', ',') . '%' : '0.00' . '%' }} </div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">{{ $property->noi_yield ? number_format((float)$property->noi_yield, 2, '.', ',') . '%' : '0.00' . '%' }} </div></td>
    <td class="border-top p20t"><div id="date-dif-{{ $property->id }}" data-value="{{ dateDif($property->loan_date) }}" class="div-grey text-center">{{ $property->loan_date ? date("Y/m/d", strtotime($property->loan_date)) : 'ー' }} </div></td>
    <td><div class="div-grey text-center loan-bank-name" >{{ $property->loan_bank_name . '/' . $property->bank_branch_name }}</div> </td>
    <td><div id="loan-{{ $property->id }}" data-value="{{ $property->loan }}" class="div-grey text-right">{{ $property->loan ? number_format($property->loan)  . ' ' . trans('attributes.common.yen')  : '0 ' . trans('attributes.common.yen')}} </div></td>
    <td><div id="contract-loan-period-{{ $property->id }}" data-value="{{ $property->contract_loan_period }}" class="div-grey text-center">{{ $property->contract_loan_period }} {{__('attributes.common.year')}} </div></td>
    <td class="p20b"><div id="interest-rate-{{ $property->id }}" data-value="{{ $property->interest_rate }}" class="div-grey text-center">{{ $property->interest_rate ? number_format((float)$property->interest_rate, 2, '.', ',') . '%' : '0.00' . '%' }} </div></td>
    <td class="border-top p20t"><div class="div-grey text-right debt-balance" data-value="{{ $property->id }}">{{ $property->debt_balance ? number_format($property->debt_balance)  . ' ' . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen')}}</div></td>
    <td><div class="div-grey text-right">{{ $property->amount_paid_annually ? number_format($property->amount_paid_annually) . ' '  . trans('attributes.common.yen') : '0 ' . trans('attributes.common.yen')}}</div></td>
    <td class="p20b"><div class="div-grey text-center">{{ $property->dscr ? number_format((float)$property->dscr, 2, '.', ',') . '%' : '0.00' . '%' }} </div></td>
</tr>
