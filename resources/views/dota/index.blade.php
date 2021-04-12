@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/common.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dota/index.css') }}">
@endsection
@section('content')
    @include('layouts.header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%">
                <div class="row m10b">
                    <div class="col-9">
                        <div class="item-block m5r p15">
                            <div class="slide-logo" style="max-height: 450px">
                                @foreach(IMAGES_SLIDES as $image)
                                    <img style="max-height: 450px; object-fit: contain; background-color: black" src="{{ asset(URL_SLIDE_IMAGES . $image) }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="item-block h-100 m5l p15" style="max-height: 480px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Mới cập nhật
                                        <a class="m5l" href="" aria-hidden="true" data-placement="left" data-toggle="tooltip" title="Item mới cập nhật !"><i class="question-icon far fa-question-circle"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div style="max-height: 420px; overflow-y: scroll">
                                @foreach($productNews as $item)
                                    @include('dota.product_item_horizontal')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m10b">
                    <div class=" row m-0 item-block p15 slide-bottom background-invi" style="height: 220px; width: 100%">
                        @foreach($newSets as $item)
                            <a href="{{ route(DOTA_DETAIL, $item['id']) }}" class="background-style position-relative" style="background-image: url({{ asset(URL_DOTA_IMAGES_SET . $item['product_base']['image']) }})">
                                <div class="bg-linear-gradient"></div>
                                <div class="title-carousel-image text-center">
                                    <p class="p5t font-weight-bold">{{ mb_strimwidth($item['product_base']['name'], 0, 25, ' ...') }}</p>
                                    <p class="p5t">{{ $item['product_base']['hero']['name'] }}</p>
                                    <p class="p5t font-weight-bold text-danger">$ {{ number_format($item['price']) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-9">
                        <div class="item-block m10b m5r p15 background-invi" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Item đang bán</p>
                                    <button class="btn btn-primary"><a class="text-white" href="{{ route(DOTA_LIST_ITEM) }}">Xem thêm >></a></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                                @foreach($newItems as $item)
                                    @include('dota.product_item', ['type' => 'array'])
                                @endforeach
                            </div>
                        </div>

                        <div class="item-block m10b m5r p15 background-invi" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Set đang bán</p>
                                    <button class="btn btn-primary"><a class="text-white" href="{{ route(DOTA_LIST_SET) }}">Xem thêm >></a></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                                @foreach($newSets as $item)
                                    @include('dota.product_item', ['type' => 'array'])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="item-block m10b m5l p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Bán chạy nhất
                                        <a class="m5l" href="" aria-hidden="true" data-placement="left" data-toggle="tooltip" title="Item mới cập nhật !"><i class="question-icon far fa-question-circle"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div style="max-height: 550px; overflow-y: scroll">
                                @foreach($productBestseller as $item)
                                    @include('dota.product_item_horizontal')
                                @endforeach
                            </div>
                        </div>

                        <div class="item-block m10b m5l p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Đáng chú ý
                                        <a class="m5l" href="" aria-hidden="true" data-placement="left" data-toggle="tooltip" title="Item mới cập nhật !"><i class="question-icon far fa-question-circle"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div style="max-height: 550px; overflow-y: scroll">
                                @foreach($productRemarkable as $item)
                                    @include('dota.product_item_horizontal')
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div><!-- kvWrap -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.slide-logo').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                dots: false,
                arrows: false,
            });

            $('.slide-bottom').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                dots: false,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>
@endsection
