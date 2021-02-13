@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.home.user.information.title_detail') }}</h3>
                        </div>
                    </div>
                </div>

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
                                <div class="col-7 date-information">{{ date('Y/m/d', strtotime($information['created_at'])) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 m30b p0 m30t">
                    <div class="m0 diagram-analysis">
                        <div class="diagram-block bd-radius-sp p0">
                            <div class="p30 user_topics_wrap mp_r informationList">
                                <div class="d-flex m25b m0l">
                                    <p class="fs16 fw-bold m0 break-all">{{ $information['title'] }}</p>
                                </div>
                                <div class="mt-1 topics_article">
                                    <dd class="category"><span class="categoryLabel fs14 {{ $information['category'] == INFORMATION_CATEGORIES[FLAG_ZERO] ? 'cateBg_news' : 'cateBg_event' }}">{{ $information['category'] }}</span>
                                </div>
                                <div class="col-12-sp p0 mt-1">
                                    <div class="content_wrap">
                                        {!! $information['content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex col-8 text-center text-lg-right m0 p0 m30b">
                    <div class="w-auto text-center text-md-right m0 mr-auto p0">
                        @php($request = request()->all())
                        @if(isset($request['screen']))
                            <a href="{{ route(USER_INFORMATION) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                        @else
                            <a href="{{ route(USER_HOME) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

