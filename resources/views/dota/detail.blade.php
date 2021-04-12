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
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m-0 p20l p20r m20b">
                                        <div class="col-6 d-flex" style="height: 450px;">
                                            <img class="w-100 object-fit-contain" src="{{ asset(getImageUrl($product)) }}" alt="">
                                        </div>
                                        <div class="col-6" style="height: 450px;">
                                           <div class="font-weight-bold fs25 m15b">{{ $product->productBase->name }}</div>
                                           <div class="row m-0 fs16 d-flex align-items-center m10b">
                                               <div class="col-3 font-weight-bold fs16 m15r">Tướng sở hữu: </div>
                                               <a href="#" class="d-flex align-items-center">
                                                   <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                       <img class="object-fit-cover w-100" src="{{ isset($product->productBase->hero->image) ? asset(URL_DOTA_HERO_IMAGES . $product->productBase->hero->image) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                                                   </div>{{ $product->productBase->hero->name ?? 'Tất cả tướng' }}</a>
                                           </div>
                                            <div class="row m-0 fs16 d-flex align-items-center m10b">
                                                <div class="col-3 font-weight-bold fs16 m15r">Người bán: </div>
                                                <a href="#" class="d-flex align-items-center">
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset('images/avatar_user/img_avatar.png') }}" alt="">
                                                    </div>{{ $product->user->nick_name }}</a>
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
                                                <div class="btn font-weight-bold fs20 text-blue">{{ number_format($product->price) }}</div>
                                            </div>
                                            <div class="row m-0 fs16 d-flex align-items-center">
                                               <button class="btn btn-primary btn-buy-item">
                                                   <i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm
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
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Guise of the Winged Bolt</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Ten user 1</div>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold text-right text-blue">15,000</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary"><a class="color-white" href="{{ route(DOTA_DETAIL, 2) }}"><i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm</a></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Guise of the Winged Bolt</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Ten user 1</div>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold text-right text-blue">15,000</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary"><i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Guise of the Winged Bolt</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Ten user 1</div>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold text-right text-blue">15,000</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary"><i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Guise of the Winged Bolt</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="d-flex align-items-center font-weight-bold m10l">Ten user 1</div>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold text-right text-blue">15,000</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary"><i class="fas fa-shopping-cart m10r"></i>Mua sản phẩm</button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
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

    <div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content" style="background-color: unset; border: none">
                <div class="modal-body">
                    <div class="loading-wrapper d-flex align-items-center justify-content-center">
                        <div class="loading-bar"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


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

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Mua sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 h100 col-12">
                            <div class="d-flex h100" style="width: 150px">
                                <img class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                            </div>
                            <div style="min-width: 450px; max-width: 550px">
                                <div class="d-flex align-items-center font-weight-bold m10l m10b fs20 justify-content-center">Guise of the Winged Bolt</div>
                                <div class="d-flex align-items-center m10l justify-content-center fs16">Drow ranger</div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12">
                            <div class="row m0 col-12 border p10t p10b">
                                <div class="col-12 font-weight-bold fs16 m10t"> Thông tin thanh toán</div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản hiện có</div>
                                    <div class="form-control col-6 text-right">2,000,000</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Giá sản phẩm (đã bao gồm VAT)</div>
                                    <div class="form-control col-6 text-right">15,000</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản còn lại</div>
                                    <div class="form-control col-6 text-right">1,985,000</div>
                                </div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12 p25l">
                            <input type="checkbox" style="display: block; width: unset">
                            <div class="m10l">Đồng ý và tiến hành thanh toán</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id="pay-submit" type="button" class="btn btn-primary">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 h100 col-12">
                            <div class="d-flex h100" style="width: 150px">
                                <img class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                            </div>
                            <div style="min-width: 450px; max-width: 550px">
                                <div class="d-flex align-items-center font-weight-bold m10l m10b fs20 justify-content-center">Guise of the Winged Bolt</div>
                                <div class="d-flex align-items-center m10l justify-content-center fs16">Drow ranger</div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12">
                            <div class="row m0 col-12 border p10t p10b">
                                <div class="col-12 font-weight-bold fs16 m10t"> Thông tin thanh toán</div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản hiện có</div>
                                    <div class="form-control col-6 text-right">2,000,000</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Giá sản phẩm (đã bao gồm VAT)</div>
                                    <div class="form-control col-6 text-right">15,000</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản còn lại</div>
                                    <div class="form-control col-6 text-right">1,985,000</div>
                                </div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12 p25l">
                            <input type="checkbox" style="display: block; width: unset">
                            <div class="m10l">Đồng ý và tiến hành thanh toán</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id="pay-submit" type="button" class="btn btn-primary">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/dota/detail.js') }}"></script>
@endsection
