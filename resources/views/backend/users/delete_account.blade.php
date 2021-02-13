@extends('layout.home.master')

@section('content')
    <div class="container-fluid container-wrapper balance-full-view">
        @include('partials.flash_messages')
        <div class="essential-content">
            <div class="row essential-header media-575-p20l media-575-p20r m0lr-sp">
                <div class="col-lg-12 p0lr-sp">
                    <div>
                        <span class="essential-title fs28">
                            {{ trans('attributes.delete_account.header.title') }}
                        </span>
                    </div>
                    <div>
                        <span class="fs14">
                            {{ trans('attributes.delete_account.header.sub_title_1_1') }}
                            {{ '「'.$currentUser->user_code . ' : ' . $currentUser->email . ' / '}}
                            @if($currentUser->role == INVESTOR)
                                {{ trans('attributes.role.investor') }}
                            @elseif($currentUser->role == BROKER)
                                {{ trans('attributes.role.broker') }}
                            @elseif($currentUser->role == EXPERT)
                                {{ trans('attributes.role.expert') }}
                            @endif
                            {{ '/ 料金プラン」' }}
                            {{ trans('attributes.delete_account.header.sub_title_1_2') }}
                        </span>
                    </div>
                    <div>
                        <span class="fs14">
                            {{ trans('attributes.delete_account.header.sub_title_2') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row m30t essential-body m0lr-sp">
               {{--  <div class="col-lg-12 p0lr-sp">
                    <span class="fs18 fw-bold" style="color: #2c3348">
                        {{ trans('attributes.delete_account.body.title') }}
                    </span>
                </div> --}}
                <div class="col-lg-12 p0lr-sp">
                    <span class="fs14">
                        {{ trans('attributes.delete_account.body.sub_title_1') }}
                    </span>
                </div>
                <div class="col-lg-12 p0lr-sp">
                    <span class="fs14">
                        {{ trans('attributes.delete_account.body.sub_title_2') }}
                    </span>
                </div>
            </div>

            <div class="col-lg-12 m30t text-left media-575-p20l p0">
                <button class="btn custom-btn-danger m5t" data-toggle="modal" data-target="#confirmModal">
                    {{ trans('attributes.button.btn_delete_account') }}
                </button>
            </div>

            <div class="modal fade" id="confirmModal">
                <div class="modal-dialog">
                    <div class="modal-content br8">
                        <div class="modal-header fs16">
                            {{ trans('attributes.delete_account.body.confirm_delete') }}
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn custom-btn-default" data-dismiss="modal">
                                {{ trans('attributes.button.btn_cancel') }}
                            </button>
                            <form action="{{ route(USER_DESTROY) }}" method="POST" class="form-data-submit">
                                @csrf
                                <button type="submit" class="btn custom-btn-success">
                                    {{ trans('attributes.button.btn_OK') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
