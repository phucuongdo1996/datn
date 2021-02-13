@extends('layout.home.master')
@section('content')
    <div class="content-wrapper content-home-user">
        <div class="container-fluid container-wrapper container-wrapper-bank">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.home.user.information.title_list') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="col-8">
                        <div class="card information">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.home.user.information.title') }}</h3>
                            </div><!-- card-header -->
                            <div class="card-body p30">
                                <div class="informationList">
                                    @forelse($information as $item)
                                        <dl>
                                            <dt class="date fs14">{{ dateTimeFormat($item['created_at']) }}</dt>
                                            <dd class="category"><span class="categoryLabel fs14 {{ $item['category'] == INFORMATION_CATEGORIES[FLAG_ZERO] ? 'cateBg_news' : 'cateBg_event' }}">{{ $item['category'] }}</span>
                                            </dd>
                                            <dd class="text">
                                                <a href="{{ route(USER_INFORMATION_DETAIL, ['id' => $item['id'], 'screen' => INFORMATION_SCREEN]) }}" class="fs14">
                                                    {{ setMaxLength($item['title'], FLAG_TWO_HUNDRED) }}
                                                </a>
                                            </dd>
                                        </dl>
                                    @empty
                                        <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                    @endforelse
                                </div><!-- informationList -->
                            </div><!-- card-body -->
                            <div class="card-footer">
                                {{ $information->links('partials.custom_pagination_manager', ['paginator' => $information]) }}
                            </div>
                        </div><!-- card -->

                    </section>
                </div><!-- row -->

                <div class="row col-8 m-0 m60t p40b position-relative">
                    <a href="{{ route(USER_HOME) }}" class="btn btn-primary text-center content-zoom-chart">{{ trans('attributes.button.btn_back_home') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

