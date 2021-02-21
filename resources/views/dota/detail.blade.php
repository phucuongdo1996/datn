@extends('layout.base_top')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/top/top.css') }}">
@endsection
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-12">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m-0 p20l p20r m20b">
                                        <div class="col-6 d-flex" style="height: 450px;">
                                            <img class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                                        </div>
                                        <div class="col-6" style="height: 450px;">
                                           <div class="font-weight-bold fs25 m15b">Guise of the Winged Bolt</div>
                                           <div class="row m-0 fs16 d-flex align-items-center m10b">
                                               <div class="col-3 font-weight-bold fs16 m15r">Tướng sở hữu: </div>
                                               <a href="#" class="d-flex align-items-center">
                                                   <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                       <img class="object-fit-cover w-100" src="{{ asset('images/hero_dota/drow_ranger.png') }}" alt="">
                                                   </div> Drow Ranger</a>
                                           </div>
                                            <div class="row m-0 fs16 d-flex align-items-center m10b">
                                                <div class="col-3 font-weight-bold fs16 m15r">Người bán: </div>
                                                <a href="#" class="d-flex align-items-center">
                                                    <div class="m10l m10r d-flex" style="width: 60px; height: 40px">
                                                        <img class="object-fit-cover w-100" src="{{ asset('images/hero_dota/drow_ranger.png') }}" alt="">
                                                    </div> Tên User 1</a>
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
                                                <div class="btn font-weight-bold fs20 text-blue">10,000</div>
                                            </div>
                                            <div class="row m-0 fs16 d-flex align-items-center">
                                               <button id="open-modal" class="btn btn-primary">
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

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Mua sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex" style="height: 450px;">
                        <img class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/dist/js/top_index.min.js') }}"></script>
    <script src="{{ asset('/js/top/top.js') }}"></script>
    <script src="{{ asset('/js/dota/detail.js') }}"></script>
@endsection
