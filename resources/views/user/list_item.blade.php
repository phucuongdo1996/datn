@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        @include('user.menu')
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0 m10b">
                                <form action="{{ route(USER_LIST_ITEM) }}" method="GET" class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m-0">
                                        <div class="col-4 p10lr">
                                            <input class="form-control" type="text" placeholder="Tên sản phẩm..." name="product_name" value="{{ $params['product_name'] ?? '' }}">
                                        </div>
                                        <div class="col-4 p10lr" >
                                            <select class="form-control" name="category_id" id="">
                                                <option value="">Tất cả</option>
                                                @foreach($listCategory as $item)
                                                <option value="{{ $item['id'] }}" @if(isset($params['category_id']) && $params['category_id'] == $item['id']) selected @endif>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 p10lr" >
                                            <select class="form-control" name="hero_id" id="">
                                                <option value="">Tất cả tướng</option>
                                                @foreach($listHero as $item)
                                                    <option value="{{ $item['id'] }}" @if(isset($params['hero_id']) && $params['hero_id'] == $item['id']) selected @endif>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-0 m15t">
                                        <div class="col-12 d-flex align-items-center justify-content-center">
                                            <button type="submit" class="btn btn-load-more"><span><i class="fas fa-search m10r"></i>Kết quả</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $products->appends(request()->query()) }}
                                    </div>
                                    <div style="height: 700px; overflow-y: auto; overflow-x: hidden">
                                        <div class="row m-0">
                                            @forelse($products as $item)
                                                @include('user.product_item')
                                            @empty
                                                <div class="col-12 d-flex justify-content-center p15l p15b">
                                                    <span class="fs20">Không có dữ liệu phù hợp</span>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $products->links() }}
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

    <div class="modal fade" id="modal-sell-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Bán sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-sell-item" class="row">
                        <input name="product_id" type="hidden">
                        <div class="row m0 h100 col-12">
                            <div class="d-flex h100" style="width: 150px">
                                <img id="modal-product-image" class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                            </div>
                            <div style="min-width: 450px; max-width: 550px">
                                <div id="modal-product-name" class="d-flex align-items-center font-weight-bold m10l m10b fs20 justify-content-center">Guise of the Winged Bolt</div>
                                <div id="modal-hero-name" class="d-flex align-items-center m10l justify-content-center fs16">Drow ranger</div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12">
                            <div class="w-100 border">
                                <div class="w-100" id="history-pay-chart-sell"></div>
                            </div>
                        </div>

                        <div class="row m0 m20t col-12 p25l">
                           <div class="col-2 d-flex align-items-center font-weight-bold">Giá bán</div>
                           <div class="col-4">
                               <input name="price" type="text" class="form-control convert-number-double-decimal text-right">
                               <p class="error-message" data-error="price"></p>
                           </div>
                            <div class="col-2 d-flex align-items-center font-weight-bold">Giá thực nhận</div>
                            <div class="col-4">
                                <input type="text" class="form-control convert-number-double-decimal text-right" name="price_real">
                            </div>
                        </div>

                        <div class="row m0 m20t col-12 p25l">
                            <input id="check-submit" name="check_submit" type="checkbox" style="display: block; width: unset; transform: scale(1.5)">
                            <div class="m10l fs16 font-weight-bold pointer-event"><label for="check-submit">Đồng ý và tiến hành rao bán</label></div>
                            <p class="error-message" data-error="check_submit"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="pay-submit" type="button" class="btn m-0 btn-load-more" disabled><span><i class="fas fa-check-circle m10r"></i>Hoàn tất</span></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/user/list_item.js') }}"></script>
@endsection
