<thead>
    <tr>
        <th>{{ __('attributes.invite_user.content_4') }}</th>
        <th>{{ __('attributes.admin.csv.nick_name') }}</th>
        <th>{{ __('attributes.profile.body.label.specialty') }}</th>
        <th>{{ __('attributes.business_plan.destination_name') }}</th>
        <th>{{ __('attributes.admin.csv.kata_name') }}</th>
        <th>{{ __('attributes.profile.body.content.gender') }}</th>
        <th>{{ __('attributes.profile.body.content.birth_day') }}</th>
        <th>{{ __('attributes.invite_user.mail_address') }}</th>
        <th>{{ __('attributes.admin.csv.name_trademark') }}</th>
        <th>{{ __('attributes.admin.csv.web') }}</th>
        <th>{{ __('attributes.my_page.company_name') }}</th>
        <th>{{ __('attributes.admin.csv.division') }}</th>
        <th>{{ __('attributes.admin.csv.representative_name') }}</th>
        <th>{{ __('attributes.profile.body.label.license_number') }}</th>
        <th>{{ __('attributes.profile.body.label.phone_number') }}</th>
        <th>{{ __('attributes.profile.body.label.ZIP_code') }}</th>
        <th>{{ __('attributes.profile.body.label.address_city') }}</th>
        <th>{{ __('attributes.profile.body.label.address_district') }}</th>
        <th>{{ __('attributes.profile.body.label.address_2') }}</th>
        <th>{{ __('attributes.admin.csv.address_3') }}</th>
        <th>{{ __('attributes.profile.body.label.introduction') }}</th>
        <th>{{ __('attributes.profile.body.label.how_did_you_know') }}</th>
        <th>{{ __('attributes.profile.body.place_holder.owner') }}</th>
        <th>{{ __('attributes.admin.csv.sub_user_id') }}</th>
        <th>{{ __('attributes.admin.csv.sub_user_mail') }}</th>
        <th>{{ __('attributes.user_detail.content_2') }}</th>
        <th>{{ __('attributes.user_detail.content_3') }}</th>
        <th>{{ __('attributes.user_detail.content_4') }}</th>
        <th>{{ __('attributes.user_detail.content_14') }}</th>
        <th>{{ __('attributes.user_detail.content_15') }}</th>
        <th>{{ __('attributes.admin.csv.additional_member_capacity') }}</th>
        <th>{{ __('attributes.admin.csv.additional_members') }}</th>
        <th>{{ __('attributes.user_detail.content_13') }}</th>
        <th>{{ __('attributes.admin.csv.suspend_primary_users') }}</th>
        <th>{{ __('attributes.admin.csv.other_company_hp') }}</th>
        <th>{{ __('attributes.admin.csv.team_building_situation') }}</th>
    </tr>
</thead>
<tbody>
    @foreach( $users as $key => $user)
        @php($memberStatus = $user['member_status'] == TRIALS ? $user['user_subscription']['trial_status'] : $user['member_status'])
        @php($amount = getAmountFee($user['role'], $memberStatus, $user['total_sub'], isset($user['user_subscription']) ? $user['user_subscription']['discount'] : FLAG_ZERO))
        <tr>
            <td>{{ $user['group_code'] }}</td>
            <td>{{ $user['profile']['nick_name'] }}</td>
            <td>{{ $user['profile']['specialties'] ? characterFormat($user['profile']['specialties']) : '' }}</td>
            <td>{{ $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name']}}</td>
            <td>{{ $user['profile']['person_charge_last_name_kana'] . $user['profile']['person_charge_first_name_kana']}}</td>
            <td>{{ isset($user['profile']['gender']) ? GENDER[$user['profile']['gender']] : '' }}</td>
            <td>{{ isset($user['profile']['birthday']) ? dateTimeFormat($user['profile']['birthday']) : '' }}</td>
            <td>{{ !isset($user['parent_id']) ? $user['email'] : '' }}</td>
            <td>{{ $user['profile']['business_name'] }}</td>
            <td>{{ $user['profile']['website_business_name'] }}</td>
            <td>{{ $user['profile']['company_name'] }}</td>
            <td>{{ $user['profile']['division'] }}</td>
            <td>{{ $user['profile']['company_representative_last_name'] . $user['profile']['company_representative_first_name']}}</td>
            <td>{{ $user['profile']['license_address'] . trans('attributes.profile.body.content.license_number') . '(' . $user['profile']['license'] . ')' . trans('attributes.profile.body.content.license_number_1') . $user['profile']['number_license'] . trans('attributes.profile.body.content.number') }}</td>
            <td>{{ $user['profile']['phone'] ? "'".$user['profile']['phone']."'" : ''}}</td>
            <td>{{ $user['profile']['zip_code'] ? "'".$user['profile']['zip_code']."'" : '' }}</td>
            <td>{{ $user['profile']['address_city'] }}</td>
            <td>{{ $user['profile']['address_district'] }}</td>
            <td>{{ $user['profile']['address_town'] }}</td>
            <td>{{ $user['profile']['address_building'] }}</td>
            <td>{{ $user['profile']['introduction'] }}</td>
            <td>{{ isset($user['profile']['search_tool']) ? $user['profile']['search_tool'] : ''}}</td>
            <td>{{ isset($user['profile']['presenter']) ? $user['profile']['presenter'] : ''}}</td>
            <td>{{ isset($user['parent_id']) ? $user['id'] : '' }}</td>
            <td>{{ isset($user['parent_id']) ? $user['email'] : '' }}</td>
            <td>{{ dateTimeFormat($user['created_at']) }}</td>
            <td>{{ isset($user['user_subscription']['start_date']) ? $user['user_subscription']['start_date'] : '' }}</td>
            <td>{{ isset($user['user_subscription']['finish_date']) ? $user['user_subscription']['finish_date'] : '' }}</td>
            <td>{{ $user['member_status'] == BASIC ? MEMBER_STATUS[BASIC] : '' }}</td>
            <td>{{ $user['member_status'] == PREMIUM ? PLAN_TEXT_NAME[PREMIUM] : '' }}</td>
            <td></td>
            <td>{{ isset($user['parent_id']) ? MONEY_SUB_USER : ($totalMoneySubUser[$user['group_code']] - FLAG_ONE) * MONEY_SUB_USER }}</td>
            <td>{{ $amount['total_amount'] }}</td>
            <td>{{ isset($user['deleted_at']) ? 'true' : 'false' }}</td>
            <td>{{ $user['profile']['website_business_name_other'] ?? '' }}</td>
            <td></td>
        </tr>
    @endforeach
</tbody>
