@extends('layout.home.master')
@section('content')
    <div class="content-wrapper content-home-user">
        <div class="container-fluid container-wrapper container-wrapper-bank">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.admin.photo.archive') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8 order-md-1 flex-fill">
                        <div class="card photoArchive h-100">
                            <div class="card-body p30">
                                <div class="photoArchiveList row">
                                    @forelse($articlePhotos as $articlePhoto)
                                        <a href="#" class="col-md-4 col-6 p10t" data-toggle="modal"
                                           data-target=".photo-{{ $articlePhoto['id'] }}" data-keyboard="true"
                                           data-backdrop="true">
                                            <div class="photo_article_item_edit">
                                                <div class="img background-color-image">
                                                    <img class="object-fit-contain" src="{{ getImageArticle([$articlePhoto['image_1'], $articlePhoto['image_2'], $articlePhoto['image_3']]) }}" alt="">
                                                </div>
                                            </div><!-- photo -->
                                            <div class="detail">
                                                <p class="title">{{ setMaxLength($articlePhoto['caption'], FLAG_ONE_HUNDRED) }}</p>
                                            </div><!-- detail -->
                                            <div class="row detail">
                                                <div class="col-lg-6 col-12"
                                                     style="color: #212529">{{ date('Y/m/d', strtotime($articlePhoto['created_at'])) }}</div>
                                                <div class="col-lg-6 col-12"
                                                     style="border-left: 1px solid #000000; color: #212529">{{ $articlePhoto['profile']['company_name'] }}</div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center w-100">{{ trans('attributes.common.no_data') }}</div>
                                    @endforelse
                                </div><!-- photoArchiveList -->
                            </div><!-- card-body -->
                            <div class="card-footer">
                                {{ $articlePhotos->links('partials.custom_pagination_manager', ['paginator' => $articlePhotos]) }}
                            </div>
                        </div><!-- card -->
                    </div><!-- col-12 -->
                </div><!-- row -->

                <div class="row col-8 m-0 m60t p40b position-relative">
                    <a href="{{ route(USER_HOME) }}" class="btn btn-primary text-center content-zoom-chart">{{ trans('attributes.button.btn_back_home') }}</a>
                </div>
            </div>
        </div>
    </div>
    @include('modal.home.photo_img')
@endsection
