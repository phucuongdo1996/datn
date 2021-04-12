@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/common.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dota/list_item.min.css') }}">
@endsection
@section('content')
    @include('layouts.header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        <div class="p5r">
                            <div class="item-block h-100 m5l p15">
                                <div class="row m-0">
                                    <div class="col-12 m10b">
                                        <p class="fs20 fw-bold m-0">TƯỚNG SỞ HỮU</p>
                                    </div>
                                </div>
                                <div id="category-item-dota">
                                    <ul>
                                        <a href="{{ route(DOTA_LIST_SET) }}">
                                            <li class="item-category @if(!isset($params['hero_id'])) choose-category @endif">Tất cả</li>
                                        </a>
                                        @foreach($listHero as $hero)
                                            <a href="{{ route(DOTA_LIST_SET, ['hero_id' => $hero['id']]) }}">
                                                <li class="item-category @if(isset($params['hero_id']) && $hero['id'] == $params['hero_id']) choose-category @endif">{{ $hero['name'] }}</li>
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t" style="">
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $listSet->links() }}
                                    </div>
                                    <div style="height: 800px; overflow-y: auto; overflow-x: hidden">
                                        <div class="row m-0">
                                            @forelse($listSet as $item)
                                                @include('dota.product_item', ['type' => 'collection'])
                                            @empty
                                                <div class="col-12 d-flex justify-content-center p15l p15b">
                                                    <span class="fs20">Không có dữ liệu phù hợp</span>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div id="paginate" class="d-flex justify-content-end p20t p10b">
                                        {{ $listSet->links() }}
                                    </div>
                                </div>
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
    <script src="{{ asset('/dist/js/top_index.min.js') }}"></script>
    <script src="{{ asset('/js/dota/dota.js') }}"></script>
@endsection
