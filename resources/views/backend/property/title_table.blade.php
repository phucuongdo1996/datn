<tr>
    <th class="fixed">
        <div class="content-div"></div>
    </th>
    <th class="fixed border-top remove-bold p20t p20b firefox safari">{!! trans('attributes.property.sub_user_edit') !!}</th>
    <th class="fixed border-top remove-bold p20t p20b firefox safari">{!! trans('attributes.property.status') !!}</th>
    @if(in_array($currentUser->role, [BROKER, EXPERT]))
        <th class="fixed border-top remove-bold firefox">
            <div class="row m0 name-group d-flex min-h38 list-house-proprietor">
                <div class="list-house-proprietor-title btn fs14 centered fw-bold p0" style="border-radius: inherit; background-color: #6E7A94 !important;color: white !important;">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</div>
                <div class="list-house-proprietor-select wrap-input-option fs14 p0" style="z-index: 1;">
                    <select id="select-proprietor" name="proprietor" class="option-paginate-1 btn form-control hp100 p0 p15r p5l filter-list-house">
                        <option class="m20r m20l" value="">{{ trans('attributes.register_info.item_block.label.all') }}</option>
                        <option class="m20r m20l" value="ー" @if(isset($params['proprietor']) && $params['proprietor'] == 'ー') selected @endif>ー</option>
                        @foreach($proprietors as $item)
                            @if(isset($item->proprietor))
                                <option @if(isset($params['proprietor']) && ($params['proprietor'] == $item->proprietor)) selected @endif class="m20r m20l break-all" value="{{ $item->proprietor }}">{{ $item->proprietor }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </th>
    @endif
    <th class="fixed border-top p20t firefox safari">{!! trans('attributes.property.list_basic_house') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.date_of_receipt') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.house_price') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.house_name') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.address') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.main_purpose') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.detailed_description_of_purpose') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.main_application') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.house_structure') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.number_floors') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.ground_area') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.total_area_of_​​floors') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.construction_time') !!}</th>
    <th class="fixed border-top p13t p12b firefox position-ie">{!! trans('attributes.property.items_related_to_benefits') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.authority_rights') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.authority_building') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.total_tenants') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.area_can_for_rent') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.floor_rate_for_rent') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.area_for_rent') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.rental_rate') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.deposit') !!}</th>
    <th class="fixed border-top p13t p12b firefox position-ie">{!! trans('attributes.property.rental_rights') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.rental_type') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.area_for_rents') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.rent_from') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.rent_to_date') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.date_of_current_rental_agreement') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.deposit') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.money') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.room_ceding_fee') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.approval_fee') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.contract_update_fee') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.notes') !!}</th>
    <th class="fixed border-top remove-bold p20t p20b firefox">{!! trans('attributes.property.date_business_registration') !!}</th>
    <th class="fixed border-top remove-bold p20t firefox">{!! trans('attributes.property.operating_revenue') !!}  <div class="number-stage fs12">9</div></th>
    <th class="fixed remove-bold">{!! trans('attributes.property.operating_fee') !!} <div class="number-stage fs12">20</div></th>
    <th class="fixed remove-bold">{!! trans('attributes.property.cost_ratio') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.revenue_and_expenditure_operating') !!} (<div class="number-stage m3l m3r fs12">9</div>-<div class="number-stage m3l m3r fs12">20</div>)</th>
    <th class="fixed border-top remove-bold firefox">{!! trans('attributes.property.assess_revenue_expenditure2') !!}</th>
    <th class="fixed border-top remove-bold firefox safari">{!! trans('attributes.property.reduction_yield') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.assessed_amount') !!}</th>
    <th class="fixed border-top remove-bold firefox">{!! trans('attributes.property.surface_yield') !!}</th>
    <th class="fixed border-top remove-bold firefox">{!! trans('attributes.property.operating_balance') !!}</th>
    <th class="fixed border-top remove-bold p20t firefox">{!! trans('attributes.property.borrowing_day') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.borrowing_financial_institutions') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.borrowing_amount') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.during_initial_borrowing_period') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.borrowed_interest') !!}</th>
    <th class="fixed border-top remove-bold p20t firefox">{!! trans('attributes.property.loan_balance') !!}</th>
    <th class="fixed remove-bold">{!! trans('attributes.property.annual_payment_principal_interes') !!}</th>
    <th class="fixed remove-bold p20b">{!! trans('attributes.property.DSCR') !!}</th>

</tr>
