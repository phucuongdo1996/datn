@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.my_page.topic.title_screen') }}</h3>
                        </div>
                    </div>
                </div>
                @include('partials.flash_messages')

                <form id="form-topic" method="POST" action="{{ route(USER_ARTICLE_TEXT_UPDATE) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $userProxy->id }}" readonly>
                    <input type="hidden" name="id" value="{{ $topic->id }}" readonly>
                    <input type="hidden" name="page" value="{{ $page }}" readonly>
                    <input type="hidden" name="option_paginate" value="{{ $optionPaginate }}" readonly>
                    <input type="hidden" name="screen" value="{{ $screen }}" readonly>
                    <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                    <div class="col-8 m30b p0">
                        <div class="m0 diagram-analysis">
                            <div class="diagram-block p0">
                                <div class="p30">
                                    <div class="d-flex m15b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.title_edit') }}</p>
                                    </div>
                                    <div class="wp100 col-12-sp p0 m30b">
                                        <input type="text" name="title" value="{{ old('title', $topic->title) }}" class="form-control m0 p13 p8l p8r h-auto fs14 text-left @error('title') input-error @enderror"
                                               @error('title') autofocus @enderror />
                                        @error('title')<span class="text-red error-simulation error_title m5t">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="wp100 col-12-sp p0 m30b">
                                        <textarea class="d-none" id="text-content" name="content">{{ old('content', $topic->content) }}</textarea>
                                    </div>

                                    <div class="d-flex m15b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topic.category') }}</p>
                                    </div>

                                    <div class="wp100 col-12-sp p0">
                                        <div class="btn wrap-input-option wp100 p0 br4">
                                            <select name="category_id" class="option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                                @foreach($categories as $category)
                                                    <option class="m20r m20l" value="{{ $category->id }}" {{ old('category_id', $topic->category_id) == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="form-condition-1" class="col-8 m0 m30b p0 text-right group-button-top">
                        <a id="btn-back-topic" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto m15lm0l r-sp" href="{{ buttonBackTopicPages(['screen' => $screen, 'option_paginate'=> $optionPaginate, 'page'=>$page]) }}">
                            {{ trans('attributes.my_page.topic.back') }}
                        </a>
                        <button id="submit-topic"  type="submit" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l m10t-sp m0lr-sp">{{ trans('attributes.my_page.topic.update') }}</button>
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
