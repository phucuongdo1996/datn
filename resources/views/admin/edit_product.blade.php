@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.admin_header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        @include('admin.menu')
                    </div>
                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                           Sản phẩm mới cập nhật:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0" style="height: 400px; overflow-y: auto">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productNew as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->product_base_id }}</td>
                                                        <td>{{ $item->productBase->name }}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger min-w115 btn-drop-product" data-id="{{ $item->product_base_id }}" data-table="products_new"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <form action="{{ route(ADMIN_ADD_PRODUCT_NEW) }}" method="POST" class="col-12 row m-0 m15t">
                                            @csrf
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <tbody>
                                                <tr>
                                                    <td class="w-20">
                                                        <select name="product_id" id="" class="form-control select-product-id">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $key }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-60">
                                                        <select name="" id="" class="form-control select-product-name">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-20 text-center">
                                                        <button type="submit" class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                            Sản phẩm bán chạy nhất:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0" style="height: 400px; overflow-y: auto">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productBestSeller as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->product_base_id }}</td>
                                                        <td>{{ $item->productBase->name }}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger min-w115 btn-drop-product" data-id="{{ $item->product_base_id }}" data-table="products_bestseller"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <form action="{{ route(ADMIN_ADD_PRODUCT_BEST_SELLER) }}" method="POST" class="col-12 row m-0 m15t">
                                            @csrf
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <tbody>
                                                <tr>
                                                    <td class="w-20">
                                                        <select name="product_id" id="" class="form-control select-product-id">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $key }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-60">
                                                        <select name="" id="" class="form-control select-product-name">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-20 text-center">
                                                        <button type="submit" class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                            Sản phẩm đáng chú ý:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0" style="height: 400px; overflow-y: auto">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productRemarkable as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->product_base_id }}</td>
                                                        <td>{{ $item->productBase->name }}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger min-w115 btn-drop-product" data-id="{{ $item->product_base_id }}" data-table="products_remarkable"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <form action="{{ route(ADMIN_ADD_PRODUCT_REMARKABLE) }}" method="POST" class="col-12 row m-0 m15t">
                                            @csrf
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <tbody>
                                                <tr>
                                                    <td class="w-20">
                                                        <select name="product_id" id="" class="form-control select-product-id">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $key }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-60">
                                                        <select name="" id="" class="form-control select-product-name">
                                                            @foreach($productBase as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-20 text-center">
                                                        <button type="submit" class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </form>
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

    <div class="modal fade" id="modal-delete-product-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center m15b">
                        <div class="fs20">Loại bỏ sản phẩm này ?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="product-base-id">
                    <input type="hidden" id="table">
                    <button id="delete-submit" type="button" class="btn m-0 btn-load-more"><span><i class="fas fa-check-circle m10r"></i>Hoàn tất</span></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/admin/edit_product.js') }}"></script>
@endsection
