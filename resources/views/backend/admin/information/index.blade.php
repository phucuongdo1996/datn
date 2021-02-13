@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank container-list-topic">
            <form id="form-manage-list-topic" action="" method="GET">
                <div id="main-info-assessment">
                    <div class="row row-header mb-5">
                        <div class="row m0">
                            <div class="col-12 text-center text-md-left p0">
                                <h3 class="m0">{{ trans('attributes.admin_manager.information.list_title') }}</h3>
                            </div>
                        </div>
                    </div>
                @include('partials.flash_messages')
                <!--profile edit-->
                    <div class="row text-right m30b">
                        <div class="col-12">
                            <a href="{{ route(ADMIN_MANAGE_INFORMATION_CREATE) }}" class="btn btn-primary min-w100">{{ trans('attributes.repair_history.add.btn_add') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.admin.manage_information_title') }}</h3>
                                    <div class="card-tools d-flex align-items-center">
                                        <div class="dropdown mr-1 custom-select-dropdown">
                                            <a id="category-selected" class="btn btn-light dropdown-toggle btn-sm select-dropdown w105"
                                               href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                {{ request('category') && in_array(request('category'), INFORMATION_CATEGORIES) ? request('category') : trans('attributes.admin_manager.topics.category')}}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li class="dropdown-item pointer select-dropdown select-information-category" data-value="ALL">---</li>
                                                @foreach(INFORMATION_CATEGORIES as $item)
                                                    <li class="dropdown-item pointer select-dropdown select-information-category" data-value="{{ $item }}">{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                            <input name="category" type="hidden" class="form-control"
                                                   value="{{ request('category') && in_array(request('category'), INFORMATION_CATEGORIES) ? request('category') : "" }}">
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <input name="title" type="text" class="form-control"
                                                   placeholder="{{ trans('attributes.my_page.topic.title') }}" value="{{ request('title') ?? "" }}">
                                            <div class="input-group-append">
                                                <div id="search-list-information" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="row m0 br10 bg-white">
                                        <div class="table-responsive">
                                            <table id="table-property" class="table table-bordered table-striped border-0 m0 min-w400 enable-overflow-x">
                                                <tr class="table-head">
                                                    <th class="border-top-0 border-left-0 w-50"><div>{{ trans('attributes.my_page.topic.title') }}</div></th>
                                                    <th class="border-top-0 text-center w-20"><div>{{ trans('attributes.admin_manager.topics.category') }}</div></th>
                                                    <th class="border-top-0 text-center w-20"><div>{{ trans('attributes.my_page.topic.create_at') }}</div></th>
                                                    <th class="border-top-0 border-right-0 w-10"><div class="w20"></div></th>
                                                </tr>
                                                @forelse($information as $item)
                                                    <tr class="table">
                                                        <td class="border-left-0"><a href="{{ route(ADMIN_MANAGE_INFORMATION_EDIT, $item['id']) }}">{{ setMaxLength($item['title'], FLAG_TWO_HUNDRED) }}</a></td>
                                                        <td class="border-left-0 text-center color-information-{{ $item['category'] }} text-white">{{ $item['category'] }}</td>
                                                        <td class="border-left-0 text-center">{{ dateTimeFormat($item['created_at']) }}</td>
                                                        <td class="border-left-0 border-right-0 text-center"><div data-id="{{ $item['id'] }}" class="remove_information pointer text-red"><i class="far fa-trash-alt"></i></div></td>
                                                    </tr>
                                                @empty
                                                    <tr class="table">
                                                        <td colspan="4" class="fs13 border-0 break-all text-center">{{ trans('attributes.admin.photo.no_data') }}</td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    {{ $information->appends([
                                        'title' => isset(request()->title) ? request()->title : '',
                                        'category' => isset(request()->category) && in_array(request()->category, INFORMATION_CATEGORIES) ? request()->category : '',
                                        ])->links('partials.custom_pagination_manager', ['paginator' => $information]) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('modal.delete.delete_information')
@endsection
@section('js')
    <script src="{{ asset('dist/js/information_index.min.js') }}"></script>
@endsection
