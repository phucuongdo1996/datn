@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
    <div id="main-info-assessment">
        <div class="row row-header m50b">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ trans('attributes.my_page.btn_default.topics_management') }}</h3>
                </div>
            </div>
        </div>
        @include('partials.flash_messages')
        <div id="form-condition-1" class="col-12 text-lg-right m0 m30b p0 text-right group-button-top">
            <div class="d-inline-block">
                <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp m5t" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.my_page.btn_default.title') }}</button>
                <ul class="dropdown-menu list-house-tax m15t fs14">
                    @if(in_array($currentUser->role, [BROKER]))
                        <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.edit_vendor_information') }}</a></li>
                    @elseif(in_array($currentUser->role, [EXPERT]))
                        <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.expert_information_editing') }}</a></li>
                    @endif
                    <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => NAME_ARTICLE_TEXT, 'option_paginate' => $perPage, 'page' => $data->currentPage()])}}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_topics') }}</a></li>
                    <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.topics_management') }}</a></li>
                    <li class="p5"><a href="{{ route(USER_ARTICLE_PHOTO_CREATE, ['screen' => NAME_ARTICLE_TEXT, 'option_paginate' => $perPage, 'page' => $data->currentPage()]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_photo_archive') }}</a></li>
                    <li class="p5"><a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.photo_archive_management') }}</a></li>
                </ul>
            </div>
            <a  href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => NAME_ARTICLE_TEXT, 'option_paginate' => $perPage, 'page' => $data->currentPage()]) }}" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l">{{ trans('attributes.my_page.topics_management.btn_add') }}</a>
            <div class="btn-group m15l">
                <div class="btn label-option fs14 centered fw-bold p10">{{ trans('attributes.common.option_paginate') }}</div>
                <div class="btn wrap-input-option fs14 w-45 p0">
                    <select name="option_paginate" class="option-paginate-1 btn form-control hp100 p0 p15r p5l per-page">
                        @foreach(LIST_OPTION_PAGINATE as $key => $value)
                            <option class="m20r m20l" @if($perPage == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                {{ $data->appends(['option_paginate' => $perPage])->links('partials.text_topic', ['totalPage' => $totalPage]) }}
        </div>

        <div class="row m0 m30b br10 bg-white">
            <div class="table-responsive br10">
                <table id="table-property" class="table table-bordered table-striped border-0 m0">
                    <tr class="table-head">
                        <td class="border-0 wp60"><div>{{ trans('attributes.my_page.topics_management.title_tb') }}</div></td>
                        <td class="border-top-0"><div>{{ trans('attributes.my_page.topics_management.category') }}</div></td>
                        <td class="border-top-0">{{ trans('attributes.my_page.topics_management.mod_date') }}</td>
                        <td class="border-top-0">{{ trans('attributes.my_page.topics_management.update_date') }}</td>
                        <td class="border-top-0"><div class="w20"></div></td>
                    </tr>
                    @forelse($data as $value)

                        <tr class="table">
                            <td class="border-left-0">
                                <a class="topic-title break-all d-none" href="{{ route(USER_ARTICLE_TEXT_EDIT, ['id'=> $value->id,'screen' => 'article_text', 'option_paginate' => $perPage, 'page'=> $data->currentPage()]) }}" id="title-topic{{ $value->id }}">{{ $value->title}}</a>
                            </td>
                            <td class="border-bottom-0 text-left">{{ $value->category->name }}</td>
                            <td class="border-bottom-0 text-left">{{ date('Y/m/d', strtotime($value['created_at'])) }}</td>
                            <td class="border-bottom-0 text-left">{{ date('Y/m/d', strtotime($value['updated_at'])) }}</td>
                            <td class="border-right-0 text-center"><a href="#" data-id="{{ $value->id }}" class="remove_topics"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @empty
                        <td colspan="8" class="text-center">{{ __('attributes.common.no_data') }}</td>
                    @endforelse
                </table>
            </div>
        </div>

        <div id="form-condition-2" class="col-12 text-lg-right m0 m30b p0 text-right group-button-top">
            <a  href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => NAME_ARTICLE_TEXT, 'option_paginate' => $perPage, 'page' => $data->currentPage()]) }}" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l">{{ trans('attributes.my_page.topics_management.btn_add') }}</a>
            <div class="btn-group m15l">
                <div class="btn label-option fs14 centered fw-bold p10">{{ trans('attributes.common.option_paginate') }}</div>
                <div class="btn wrap-input-option fs14 w-45 p0">
                    <select name="option_paginate" class="option-paginate-1 btn form-control hp100 p0 p15r p5l per-page">
                        @foreach(LIST_OPTION_PAGINATE as $key => $value)
                            <option class="m20r m20l" @if($perPage == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                {{ $data->appends(['option_paginate' => $perPage])->links('partials.text_topic', ['totalPage' => $totalPage]) }}
        </div>
    </div>
</div>
    <div class="modal fade" id="modal-delete-topic">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-delete-topic" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-header fs16">
                            {{ trans('messages.topic.confirm_delete') }}
                            <input type="hidden" name="option_paginate" value="{{ $perPage }}">
                            <input type="hidden" name="page" value="{{ $data->currentPage() }}">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="message-text" class="col-form-label">{{ trans('attributes.my_page.topic.divorce') }}</label>--}}
{{--                            <textarea class="form-control" name="divorce"></textarea>--}}
{{--                        </div>--}}
                    <div class="modal-footer">
                        <button type="button" class="btn custom-btn-default" data-dismiss="modal">{{ trans('attributes.button.btn_cancel') }}</button>
                        <button id="button-delete-topic" type="submit" class="btn custom-btn-success">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/list.min.js') }}"></script>
@endsection
