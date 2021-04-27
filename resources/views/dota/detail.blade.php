@extends('layouts.base')
@section('styles')

@endsection
@section('content')
    @include('layouts.header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-12">
                        <div class="p5l">
                            <div class="row m-0">
                                <input id="user-id" type="hidden" value="{{ $currentUser ? $currentUser->id : '' }}">
                                <input id="product-base-id" type="hidden" value="{{ $market['product']['product_base_id'] }}">
                                <input id="market-id" type="hidden" value="{{ $market['id'] }}">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m-0 p20l p20r m20b">
                                        <div class="col-6 d-flex" style="height: 450px;">
                                            <img class="w-100 object-fit-contain" src="{{ asset(getImageUrl($market['product'])) }}" alt="">
                                        </div>
                                        <div class="col-6 p30l" style="height: 450px;">
                                           <div class="font-weight-bold fs25 m15b" style="color: {{ SPECIAL_COLOR[$market['product']['special']] }}">{{ $market['product_name'] }} ({{ SPECIAL_TEXT[$market['product']['special']] }})</div>
                                           <div class="row m-0 fs16 d-flex align-items-center m10b">
                                               <div class="col-3 font-weight-bold fs16 m15r">Tướng sở hữu: </div>
                                               <a href="#" class="d-flex align-items-center">
                                                   <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                       <img class="object-fit-cover w-100" src="{{ isset($market['hero_image']) ? asset(URL_DOTA_HERO_IMAGES . $market['hero_image']) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                                                   </div>{{ $market['hero_name'] ?? 'Tất cả tướng' }}</a>
                                           </div>
                                            <div class="row m-0 fs16 d-flex align-items-center m10b">
                                                <div class="col-3 font-weight-bold fs16 m15r">Người bán: </div>
                                                <a href="#" class="d-flex align-items-center">
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset(URL_USER_AVATAR . $market['seller_avatar']) }}" alt="">
                                                    </div>{{ $market['seller_name'] }}</a>
                                            </div>
                                            <div class="row m-0 fs16 d-flex align-items-center m10b">
                                                <div class="col-3 font-weight-bold fs16 m15r">Thuộc tính đặc biệt: </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset('images/special_dota/prismatic_green.png') }}" alt="">
                                                    </div>
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset('images/special_dota/ethereal_gem.png') }}" alt="">
                                                    </div>
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset('images/special_dota/kinetic_gem.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 fs16 d-flex align-items-center m10b">
                                                <div class="col-3 font-weight-bold fs16 m15r">Giá: </div>
                                                <div class="col-6 btn font-weight-bold fs20" style="background-color: #80808091; padding: 8px 20px; border-radius: 10px">
                                                    <i class="fas fa-coins text-gold"></i> {{ number_format($market['price']) }}
                                                </div>
                                            </div>
                                            <div class="row m-0 fs16 d-flex">
                                                <button class="btn btn-load-more m0 btn-buy-item">
                                                    <span><i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0 p20 border m20b">
                                        <div class="col-12">
                                            <div id="history-pay-chart"></div>
                                        </div>
                                    </div>
                                    <div class="row m-0 m20b p20l fs20 font-weight-bold" style="color: #28a745">
                                        Sản phẩm tương tự
                                    </div>
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $sameProducts->appends(request()->query()) }}
                                    </div>
                                    <div class="row m-0">
                                        <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                            <thead>
                                                <tr>
                                                    <th class="w-40">Sản phẩm</th>
                                                    <th class="w-20">Người bán</th>
                                                    <th class="w-20">Giá</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @forelse($sameProducts as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l" style="color: {{ SPECIAL_COLOR[$item->product->special] }}">{{ $item->product->productBase->name }} ({{ SPECIAL_TEXT[$item->product->special] }})</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="icon-user">
                                                                <img src="{{ asset('images/avatar_user/img_avatar.png') }}" alt="">
                                                            </div>
                                                            <div class="d-flex align-items-center font-weight-bold m10l">{{ $item->seller->nick_name }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold text-right">{{ number_format($item->price) }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route(DOTA_DETAIL, $item->id) }}">
                                                            <button class="btn btn-load-more m0">
                                                                <span><i class="fas fa-info-circle m10r"></i>Xem sản phẩm</span>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            Không có dữ liệu
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $sameProducts->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- kvWrap -->
        </div>
    @include('layouts.footer')
@endsection
@section('modal')
    <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Thanh toán thành công !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 col-12">
                            <div class="row m0 col-12 border p10b">
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Số giao dịch</div>
                                    <div class="form-control col-6 text-right">DPC20210301</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Mã sản phẩm</div>
                                    <div class="form-control col-6 text-right">SPKD20210301</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Ngày tạo</div>
                                    <div class="form-control col-6 text-right">{{ date('d/m/Y', time()) }}</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Giá sản phẩm (đã bao gồm VAT)</div>
                                    <div class="form-control col-6 text-right">15,000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <a href="{{ route(USER_LIST_ITEM) }}">
                        <button type="button" class="btn btn-info">Đến kho đồ <i class="fas fa-arrow-right"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xác thực mua item -->
    <div class="modal fade" id="modal-buy-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <form id="form-buy-item" class="modal-content">
                <input type="hidden" name="market_id" value="{{ $market['id'] }}">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Mua sản phẩm</h5>
                    <button type="button" class="close btn btn-zoom-hover" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 h100 col-12">
                            <div class="col-3" style="background-color: black">
                                <img class="w-100 object-fit-contain" src="{{ asset(getImageUrl($market['product'])) }}" alt="">
                            </div>
                            <div class="col-9">
                                <div class="d-flex align-items-center font-weight-bold m10l m15b fs20 justify-content-center" style="color: {{ SPECIAL_COLOR[$market['product']['special']] }}">{{ $market['product_name'] }} ({{ SPECIAL_TEXT[$market['product']['special']] }})</div>
                                <div class="d-flex align-items-center m10l justify-content-center fs18">{{ $market['hero_name'] ?? 'Tất cả tướng' }}</div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12">
                            <div class="row m0 col-12 border p10t p10b fs18">
                                <div class="col-12 font-weight-bold fs20 m10t"> Thông tin thanh toán</div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản hiện có</div>
                                    <div class="form-control col-6 text-right fs20">{{ $currentUser ? number_format($currentUser->money_own) : FLAG_ZERO }}</div>
                                </div>
                                @php($rest = $currentUser ? ($currentUser->money_own - $market['price']) : FLAG_ZERO)
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Giá sản phẩm (đã bao gồm VAT)</div>
                                    <div class="form-control col-6 text-right fs20" style="color: {{ $rest > 0 ? 'green' : 'red' }}">{{ number_format($market['price']) }}</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">

                                    <div class="col-6 d-flex align-items-center">Tài khoản còn lại</div>
                                    <div class="form-control col-6 text-right fs20" style="color: {{ $rest > 0 ? 'green' : 'red' }}">{{ number_format($rest) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12 p25l">
                            @if($rest > 0)
                                <input id="check-submit" name="check_submit" type="checkbox" style="display: block; width: unset; transform: scale(1.5)">
                                <div class="m10l fs16 font-weight-bold pointer-event"><label for="check-submit">Đồng ý và tiến hành rao bán</label></div>
                                <p class="error-message" data-error="check_submit"></p>
                            @else
                                <div class="m10l fs16 font-weight-bold pointer-event"><label class="error-message">Tài khoản hiện có không đủ để thực hiện giao dịch này!</label></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="pay-submit" type="button" class="btn m-0 btn-load-more" disabled><span><i class="fas fa-shopping-cart m5r"></i> Thanh toán</span></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Đăng nhập -->
    <div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content">
                <div class="modal-body" style="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <div class="row" style="min-height: 500px">
                        <div class="col-6 d-flex">
                            <img class="w-100 object-fit-contain" style="border-radius: 20px" src="{{ asset('images/dota_images/bg_login.jpeg') }}" alt="">
                        </div>
                        <form id="form-login" class="col-6">
                            @csrf
                            <div class="d-flex justify-content-center" style="padding-top: 90px; padding-bottom: 30px">
                                <div class="d-flex justify-content-center align-items-center" style="width: 80px; height: 80px; padding: 10px; border-radius: 50%; background-color: grey">
                                    <i class="fas fa-user" style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div>
                                <div class="fail-login" style="display: none;">
                                    <p class="m0">Email hoặc mật khẩu không đúng.</p>
                                    <p class="m0">Vui lòng kiểm tra lại!</p>
                                </div>
                                <input type="text" name="email" class="form-control" placeholder="Tài khoản">
                                <p class="error-message p10t" data-error="email"></p>
                                <input type="password" name="password" class="form-control 15t" placeholder="Mật khẩu">
                                <p class="error-message p10t" data-error="password"></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" id="button-login" class="btn" style="padding: 10px 30px; background-color: grey; border-radius: 32px"><span>Đăng nhập</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/dota/detail.js') }}"></script>
@endsection
