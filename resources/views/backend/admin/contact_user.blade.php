@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-wrapper-rent container-manager-user">
        <div id="main-info-assessment">
            <div class="row row-header mb-5">
                <div class="col-6 text-left text-md-left col-md-6 p0">
                    <h3 class="m0">{{ trans('attributes.contact_user.title') }}</h3>
                </div>
                <div class="col-6 col-md-6 text-right text-md-right p0">
                    <div class="m0">
                        <button type="button" class="btn br8 custom-btn-success fs15 fs13-sp m15r btn-save-support" disabled>{{ trans('attributes.simulation.content.text_btn_save') }}</button>
                        <button type="button" class="btn custom-btn-default w-auto fs15 btn-reset p0" disabled>
                            <a href="{{ route(ADMIN_MANAGE_SUPPORT) }}" class="btn w-auto">{{ trans('attributes.support_user.btn_reset') }}</a>
                        </button>
                    </div>
                </div>
            </div>

            @include('partials.flash_messages')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools d-flex flex-wrap align-items-center">
                                <div class="dropdown mr-1 m2b custom-select-dropdown">
                                    <a class="btn btn-light dropdown-toggle btn-sm title-contact-status w200" href="#" role="button"
                                       id="dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ isset($params['contact_status']) && in_array($params['contact_status'], [(string)NOT_RESPONSE, (string)PROCESSING, (string)PROCESSED, (string)DONE]) ? SUPPORT_STATUS[$params['contact_status']] : trans('attributes.support_user.all_status') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-menu-link">
                                        <a class="dropdown-item contact-status-option" data-id="" href="#">{{ trans('attributes.support_user.all_status') }}</a>
                                        <a class="dropdown-item contact-status-option" data-id="1" href="#">{{ trans('attributes.support_user.un_replied') }}</a>
                                        <a class="dropdown-item contact-status-option" data-id="2" href="#">{{ trans('attributes.support_user.processing') }}</a>
                                        <a class="dropdown-item contact-status-option" data-id="3" href="#">{{ trans('attributes.support_user.supported') }}</a>
                                        <a class="dropdown-item contact-status-option" data-id="4" href="#">{{ trans('attributes.support_user.done') }}</a>
                                    </div>
                                </div>
                                <form action="{{ route(ADMIN_MANAGE_CONTACT) }}" method="GET">
                                    <input type="hidden" name="contact_status" value="{{ isset($params['contact_status']) && in_array($params['contact_status'], array_keys(SUPPORT_STATUS)) ? $params['contact_status'] : '' }}">
                                    <div class="input-group input-group-sm w200 m0">
                                        <input type="text" class="form-control" name="user_name" value="{{ isset($params['user_name']) ? $params['user_name'] : '' }}"
                                               placeholder="{{ trans('attributes.admin_manager.user.user_name') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body p-0 block-support-user">
                            <table id="table-property" class="table table-striped projects table-support-user">
                                <thead>
                                <tr>
                                    <th class="w-5">{{ trans('attributes.borrowing.table.no') }}</th>
                                    <th class="w-10">{{ trans('mail-attributes.support.full_name') }}</th>
                                    <th class="w-10">{{ trans('messages.email.email_user') }}</th>
                                    <th class="w-10">{{ trans('attributes.profile.body.label.phone_number') }}</th>
                                    <th class="w-10">{{ trans('attributes.property.house_name_2') }}</th>
                                    <th class="text-center w-10">{{ trans('attributes.support_user.date_reception') }}</th>
                                    <th class="text-center w-10">{{ trans('attributes.support_user.responsible') }}</th>
                                    <th class="text-center w-10">{{ trans('attributes.support_user.situation') }}</th>
                                    <th class="text-center w-10">{{ trans('attributes.support_user.amount') }}</th>
                                    <th class="text-center w-10">{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <form id="form-data-contact">
                                        @forelse($dataContact as $contact)
                                            <tr>
                                                <td>
                                                    @if($loop->index + 1 < 10)
                                                        {{ '00' . ($loop->index + 1) }}
                                                    @elseif($loop->index + 1 < 100)
                                                        {{ '0' . ($loop->index + 1) }}
                                                    @endif
                                                </td>
                                                <td>{{ $contact['user_name'] }}</td>
                                                <td>{{ $contact['email'] }}</td>
                                                <td>{{ $contact['phone_number'] }}</td>
                                                <td><a href="#" data-toggle="modal" data-target="#content-modal-{{ $contact['id'] }}">{{ $contact['house_name'] }}</a></td>
                                                <td class="text-center">{{ $contact['created_at'] ? date('Y/m/d', strtotime($contact['created_at'])) : 'ー' }}</td>
                                                <td class="text-center">
                                                    <input type="text" name="person_in_charge[]" class="form-control fs14 save-data" data-id="{{ $contact['id'] }}" value="{{ $contact['person_in_charge'] }}">
                                                </td>
                                                <td class="text-center">
                                                    <select class="btn form-control fs14 text-left bg-white save-data" name="state[]" data-id="{{ $contact['id'] }}">
                                                        <option value="">---</option>
                                                        @foreach (SUPPORT_STATUS as $key => $value)
                                                            <option value="{{ $key }}" @if($contact['state'] == $key) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="estimated_amount[]" value="{{ $contact['estimated_amount'] }}" class="form-control fs14 convert-data save-data estimated-amount" data-id="{{ $contact['id'] }}">
                                                </td>
                                                <td class="text-center">{{ $contact['created_at'] == $contact['updated_at'] ? 'ー' : date('Y/m/d', strtotime($contact['updated_at'])) }}</td>
                                                <input type="text" name="status[]" class="d-none status-{{ $contact['id'] }}" value="0">
                                                <input type="text" name="id[]" class="d-none" value="{{ $contact['id'] }}">
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="10" >{{ trans('attributes.admin.photo.no_data') }}</td>
                                            </tr>
                                        @endforelse
                                    </form>

                                    @if(count($dataContact) > 0)
                                        <tr class="table-foot">
                                            <td class="border-0 text-left p0">
                                                <div class="p15 w80 fw-bold bg-general w40">
                                                    <p class="m0">{{ trans('attributes.borrowing.table.total') }}</p>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0" colspan="7"></td>
                                            <td id="sum-estimated" class="border-bottom-0 text-right fw-bold"></td>
                                            <td class="border-bottom-0"></td>
                                        </tr>
                                    @endif
                                    </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $dataContact->appends([
                                'user_name' => isset($param['user_name']) ? $param['user_name'] : '',
                                'contact_status' => isset($param['contact_status']) && in_array($param['contact_status'], array_keys(SUPPORT_STATUS)) ? $param['contact_status'] : ''
                                ])->links('partials.custom_pagination_manager', ['paginator' => $dataContact]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($dataContact as $contact)
    <div class="modal fade show p10r" id="content-modal-{{ $contact['id'] }}" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content br8">
                <div class="modal-header fs16">
                    {{ trans('attributes.support.content') }}
                    <button type="button" class="close close-modal-block" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <textarea class="form-control" rows="8" readonly>{{ $contact['note'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('js')
    <script src="{{ asset('/dist/js/admin_contact_user.min.js') }}"></script>
@endsection

