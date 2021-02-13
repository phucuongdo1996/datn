@extends('layout.home.master')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
        <div id="main-info-assessment">
            @include('partials.flash_messages')

            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.my_page.btn_default.new_topics') }}</h3>
                    </div>
                </div>
            </div>

            <form id="admin-form-topic" method="POST" action="{{ route(ADMIN_TOPIC_UPDATE, $topicData['id']) }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                <input type="hidden" name="user_id" value="{{ $topicData['user']['id'] }}" readonly>
                <input type="hidden" name="id" value="{{ $topicData['id'] }}" readonly>
                <input type="hidden" name="email" value="{{ $topicData['user']['email'] }}" readonly>
                <input type="hidden" name="person_charge_last_name" value="{{ $topicData['user']['profile']['person_charge_last_name'] }}" readonly>
                <input type="hidden" name="person_charge_first_name" value="{{ $topicData['user']['profile']['person_charge_first_name'] }}" readonly>
                <input type="hidden" name="created_at" value="{{ $topicData['created_at'] }}" readonly>
                <input type="hidden" name="screen" value="{{ request('screen') }}" readonly>
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.admin_manager.topics.user_information') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="row m0 br10 bg-white">
                                    <div class="table-responsive">
                                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                            <tr class="table">
                                                <th style="width: 30%" class="border-left-0">{{ trans('attributes.admin_manager.topics.user_name') }}</th>
                                                <td style="width: 70%" class="border-right-0">{{ $topicData['user']['profile']['person_charge_last_name'].$topicData['user']['profile']['person_charge_first_name'] }}</td>
                                            </tr>

                                            <tr class="table">
                                                <th style="width: 30%" class="border-left-0">{{ trans('attributes.admin_manager.topics.last_login_date') }}</th>
                                                <td style="width: 70%" class="border-right-0">{{ dateTimeFormat($topicData['user']['last_login']) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.admin_manager.topics.post_information') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="row m0 br10 bg-white">
                                    <div class="table-responsive">
                                        <table id="table-property" class="table table-bordered table-striped border-0 m0">

                                            <tr class="table">
                                                <th style="width: 30%" class="border-left-0">{{ trans('attributes.admin_manager.topics.post_date') }}</th>
                                                <td style="width: 70%" class="border-right-0">{{ dateTimeFormat($topicData['created_at']) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 m30b p0">
                    <div class="m0 diagram-analysis">
                        <div class="diagram-block p0">
                            <div class="p30">
                                <div class="d-flex m15b m0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.title') }}</p>
                                </div>

                                <div class="wp100 col-12-sp p0 m30b">
                                    <input type="text" name="title" value="{{ old('title', $topicData['title']) }}" placeholder="" class="form-control m0 p13 p8l p8r h-auto fs14 text-left @error('title') input-error @enderror"
                                           @error('title') autofocus @enderror/>
                                    @error('title')<span class="text-red error-simulation error_title m5t">{{ $message }}</span>@enderror
                                </div>

                                <div class="wp100 col-12-sp p0 m30b">
                                    <textarea  class="d-none" id="text-content" name="content">{{ old('content', $topicData['content']) }}</textarea>
                                </div>

                                <div class="d-flex m15b m0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.category') }}</p>
                                </div>

                                <div class="wp100 col-12-sp p0 m30b">
                                    <div class="btn wrap-input-option wp100 p0 br4">
                                        <select name="category_id" class="option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                            @foreach($categories as $category)
                                                <option class="m20r m20l" value="{{ $category['id'] }}" {{ old('category_id', $topicData['category_id']) == $category['id'] ? 'selected' : ''  }}>{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="centered-vertical m15b m0l align-center">
                                    <p class="fs16 fw-bold m0 m10r">{{ trans('attributes.admin_manager.topics.reason_for_change') }}</p>
                                </div>

                                <div class="wp100 col-12-sp p0">
                                    <textarea name="reason_update" cols="15" rows="5" class="form-control m0 h-auto fs14 text-left">{{ $topicData['reason_update'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 text-lg-right m0 m30b p0 text-right group-button-top">
                    <button id="admin-update-topic" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l">{{ trans('attributes.my_page.topic.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('dist/js/topic.min.js') }}"></script>
@endsection
