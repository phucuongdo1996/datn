@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.admin_manager.information.add_title') }}</h3>
                        </div>
                    </div>
                </div>
                @include('partials.flash_messages')

                <div class="col-8 p0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">{{ trans('attributes.article_photo.post_information') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p0">
                            <div class="row m0">
                                <div class="col-3 border-right date-information">{{ trans('attributes.admin_manager.topics.post_date') }}</div>
                                <div class="col-7 date-information">{{ dateTimeFormat($data['created_at']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="form-information" method="POST" action="{{ route(ADMIN_MANAGE_INFORMATION_UPDATE) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <div class="col-8 m30b p0">
                        <div class="m0 diagram-analysis">
                            <div class="diagram-block bd-radius-sp p0">

                                <div class="p30">
                                    <div class="d-flex m15b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.title') }}</p>
                                    </div>

                                    <div class="wp100 col-12-sp p0 m30b">
                                        <input type="text" name="title" value="{{ old('title') ?? $data['title'] }}" class="form-control m0 p13 p8l p8r h-auto fs14 text-left @error('title') input-error @enderror"/>
                                        @error('title')<p class="error-message p5t m0">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="wp100 col-12-sp p0 m30b">
                                        <textarea class="d-none" id="text-content" name="content">{{ old('content') ?? $data['content'] }}</textarea>
                                    </div>

                                    <div class="d-flex m15b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.category') }}</p>
                                    </div>

                                    <div class="wp100 col-12-sp p0">
                                        <div class="btn wrap-input-option wp100 p0 br4">
                                            <select name="category" class="option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                                @foreach(INFORMATION_CATEGORIES as $item)
                                                    <option class="m20r m20l" value="{{ $item }}" {{ (old('category') ?? $data['category']) == $item ? 'selected' : ''  }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="form-condition-1" class="col-8 m0 m30b p0 text-right group-button-top">
                        <button id="submit-information" type="button" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l m10t-sp m0lr-sp min-w100">{{ trans('attributes.my_page.topic.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('dist/js/information_add.min.js') }}"></script>
@endsection
