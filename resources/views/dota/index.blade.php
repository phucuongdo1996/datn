@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/index.css') }}">
@endsection
@section('content')
    @include('layouts.header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%">
                <div class="row m10b">
                    <div class="col-8">
                        <div class="item-block m5r">
                            <div class="slide-logo" style="max-height: 350px">
                                @foreach(IMAGES_SLIDES as $image)
                                    <img style="max-height: 350px; object-fit: contain; background-color: black" src="{{ asset(URL_SLIDE_IMAGES . $image) }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="item-block h-100 m5l p15" style="max-height: 350px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Mới cập nhật
                                        <a class="m5l" href="" aria-hidden="true" data-placement="left" data-toggle="tooltip" title="Item mới cập nhật !"><i class="question-icon far fa-question-circle"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div style="max-height: 290px; overflow-y: scroll">
                                @foreach($productNews as $item)
                                <div class="row m-0 m10b h90">
                                    <div class="col-4 d-flex h90 zoom-hover">
                                        <img class="object-fit-contain" style="background-color: black" src="{{ asset(getImageUrl($item)) }}" alt="">
                                    </div>
                                    <div class="col-8">
                                        <div class="font-weight-bold">{{ $item['product_base']['name'] }}</div>
                                        <div class="font-weight-bold text-blue">{{ number_format($item['price']) }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m10b">
                    <div class=" row m-0 item-block p15 slide-bottom" style="height: 220px; width: 100%">
                        @foreach($newSets as $item)
                            <a href="" class="background-style position-relative" style="background-image: url({{ asset(URL_DOTA_IMAGES_SET . $item['product_base']['image']) }})">
                                <div class="bg-linear-gradient"></div>
                                <div class="title-carousel-image text-center">
                                    <p class="p5t font-weight-bold">{{ $item['product_base']['name'] }}</p>
                                    <p class="p5t"> - {{ $item['product_base']['hero']['name'] }}</p>
                                    <p class="p5t font-weight-bold text-danger">{{ number_format($item['price']) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="item-block m10b m5r p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Item đang bán</p>
                                    <button class="btn btn-primary"><a class="text-white" href="{{ route(DOTA_LIST_ITEM) }}">Xem thêm >></a></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                            @foreach($newItems as $item)
                                <div class="col-2 p15l p15b">
                                    <div class="d-flex zoom-hover" style="width: 100%; height: 90px">
                                        <img style="object-fit: fill" src="{{ asset(URL_DOTA_IMAGES_ITEM . $item['product_base']['image']) }}" alt="">
                                    </div>
                                    <div class="p5t font-weight-bold">{{ $item['product_base']['name'] }}</div>
                                    <a href="#" class="p5t hero-hover"> - {{ $item['product_base']['hero']['name'] }}</a>
                                    <div class="p5t font-weight-bold text-blue">{{ number_format($item['price']) }}</div>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="item-block m10b m5r p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Set đang bán</p>
                                    <button class="btn btn-primary"><a class="text-white" href="{{ route(DOTA_LIST_SET) }}">Xem thêm >></a></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                                @foreach($newSets as $item)
                                    <div class="col-2 p15l p15b">
                                        <div class="d-flex zoom-hover" style="width: 100%; height: 90px">
                                            <img style="object-fit: fill" src="{{ asset(URL_DOTA_IMAGES_SET . $item['product_base']['image']) }}" alt="">
                                        </div>
                                        <div class="p5t font-weight-bold">{{ $item['product_base']['name'] }}</div>
                                        <a href="#" class="p5t hero-hover"> - {{ $item['product_base']['hero']['name'] }}</a>
                                        <div class="p5t font-weight-bold text-blue">{{ number_format($item['price']) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
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
                                    <div class="row m-0 m10b h90">
                                        <div class="col-4 d-flex h90 zoom-hover">
                                            <img class="object-fit-contain" style="background-color: black" src="{{ asset(getImageUrl($item)) }}" alt="">
                                        </div>
                                        <div class="col-8">
                                            <div class="font-weight-bold">{{ $item['product_base']['name'] }}</div>
                                            <div class="font-weight-bold text-blue">{{ number_format($item['price']) }}</div>
                                        </div>
                                    </div>
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
                                    <div class="row m-0 m10b h90">
                                        <div class="col-4 d-flex h90 zoom-hover">
                                            <img class="object-fit-contain" style="background-color: black" src="{{ asset(getImageUrl($item)) }}" alt="">
                                        </div>
                                        <div class="col-8">
                                            <div class="font-weight-bold">{{ $item['product_base']['name'] }}</div>
                                            <div class="font-weight-bold text-blue">{{ number_format($item['price']) }}</div>
                                        </div>
                                    </div>
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
