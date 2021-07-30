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
                                           Thêm thẻ Steam code:
                                        </div>
                                    </div>
                                    <form id="form-data" class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input name="steam_code" type="text" class="form-control convert-card-number" placeholder="Mã thẻ nạp">
                                                    <p class="error-message p10t" data-error="steam_code"></p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input name="steam_seri" type="text" class="form-control convert-card-number" placeholder="Số seri">
                                                    <p class="error-message p10t" data-error="steam_seri"></p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <select name="type" id="" class="form-control">
                                                        <option value="">Mệnh giá</option>
                                                        @foreach(STEAM_CODE_VALUE as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="error-message p10t" data-error="type"></p>
                                                </div>
                                            </div>
                                            <div class="col-12 m10t d-flex justify-content-center">
                                                <button id="btn-add-steam-code" type="button" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm thẻ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                           Danh sách thẻ
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <form action="{{ route(ADMIN_ADD_STEAM_CODE) }}" method="GET" class="col-12 row m0">
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input name="steam_code" value="{{ $params['steam_code'] ?? '' }}" type="text" class="form-control convert-card-number not-border-error" placeholder="Mã thẻ, số seri">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <select name="type" id="" class="form-control not-border-error">
                                                        <option value="">Mệnh giá</option>
                                                        @foreach(STEAM_CODE_VALUE as $key => $value)
                                                            <option value="{{ $key }}" @if(isset($params['type']) && $params['type'] == $key) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="paginate" class="d-flex justify-content-end m10t m15t w-100">
                                            {{ $data->appends(request()->query()) }}
                                        </div>
                                        <div class="col-12 row m-0 m15t overflow-auto" style="height: 600px">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-10">STT</th>
                                                    <th class="w-25">Mã thẻ</th>
                                                    <th class="w-25">Số seri</th>
                                                    <th class="w-20">Mệnh giá</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($data as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key+1 }}</td>
                                                        <td class="text-center">
                                                            {{ $item->steam_code }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->steam_seri }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ STEAM_CODE_VALUE[$item->type] }}
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger min-w115 btn-delete-steam-code" data-id="{{ $item->id }}" data-steam-code="{{ $item->steam_code }}"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">
                                                            Không có dữ liệu.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                            <div class="col-6">
                                                <div id="chart-top-sell"></div>
                                            </div>
                                        </div>
                                        <div id="paginate" class="d-flex justify-content-end p20t p10b w-100">
                                            {{ $data->links() }}
                                        </div>
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

    <div class="modal fade" id="modal-delete-steam-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
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
                        <div class="fs20">Xóa mã thẻ steam này ?</div>
                    </div>
                    <div class="row justify-content-center">
                        <div id="delete-steam-code" class="fs20 font-weight-bold">1234 5678 7894</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="steam-code-id">
                    <button id="delete-submit" type="button" class="btn m-0 btn-load-more"><span><i class="fas fa-check-circle m10r"></i>Hoàn tất</span></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/admin/steam_code.js') }}"></script>
@endsection
