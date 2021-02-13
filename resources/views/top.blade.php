@extends('layout.base_top')
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap">
                <div id="kv">
                    <div id="kvTextArea">
                        <div class="kvTitleArea">
                            <h1 class="kvTitle">
                                <span class="subTitle">{{ trans('attributes.top.header.real_estate') }} <span class="en azosans">× {{ trans('attributes.top.header.technology_2') }}</span></span>
                                <span class="mainTitle azosans">{{ trans('attributes.top.header.prop_tech_2') }}</span>
                            </h1>
                            <p class="kvCatch"> {{ trans('attributes.top.body.sub_text_1') }}
                                <br />{{ trans('attributes.top.body.sub_text_2') }}
                            </p><!-- kvCatch -->
                        </div><!-- kvTitleArea -->

                        <div class="kvBtnArea">
                            <a href="{{ route(USER_SIMULATION_CREATE) }}" class="roundBtn green shadow">{{ trans('attributes.top.header.free_trial') }}</a>
                        </div><!-- kvBtnArea -->
                    </div><!-- kvTextArea -->
                </div><!-- kv -->
                <div id="kvImg"><img src="images/top/kv/kv.png" alt="" /></div>
            </div><!-- kvWrap -->

            <div class="sectionWrap">
                <section id="cloudService" class="section">
                    <div class="sectionInner inner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionSubTitle">{!! trans('attributes.top.header.section_sub_title') !!}</h2>
                        </div><!-- sectionTitleArea -->

                        <div class="photoDetailBoxWrap">
                            <div class="photoDetailBox">
                                <div class="photo">
                                    <div class="photoInner"><img src="{{ asset('images/top/cloudService/photo1.jpg') }}" alt="{{ trans('attributes.top.header.photo_detail_boxWrap.photo_1.photo_inner') }}" /></div>
                                </div><!-- photo -->
                                <div class="detail">
                                    <div class="detailInner">
                                        <div class="titleArea">
                                            <h3 class="title">{!! trans('attributes.top.header.photo_detail_boxWrap.photo_1.detail_inner_title') !!}</h3>
                                        </div><!-- titleArea -->
                                        <div class="textArea">
                                            <p class="text">
                                                {{ trans('attributes.top.header.photo_detail_boxWrap.photo_1.detail_inner_text') }}
                                            </p>
                                        </div><!-- textArea -->
                                    </div><!-- detailInner -->
                                </div><!-- detail -->
                            </div><!-- photoDetailBox -->

                            <div class="photoDetailBox">
                                <div class="photo">
                                    <div class="photoInner"><img src="{{ asset('images/top/cloudService/photo2.jpg') }}" alt="{{ trans('attributes.top.header.photo_detail_boxWrap.photo_2.photo_inner') }}" /></div>
                                </div><!-- photo -->
                                <div class="detail">
                                    <div class="detailInner">
                                        <div class="titleArea">
                                            <h3 class="title">{!! trans('attributes.top.header.photo_detail_boxWrap.photo_2.detail_inner_title') !!}</h3>
                                        </div><!-- titleArea -->
                                        <div class="textArea">
                                            <p class="text">
                                                {{ trans('attributes.top.header.photo_detail_boxWrap.photo_2.detail_inner_text') }}
                                            </p>
                                        </div><!-- textArea -->
                                    </div><!-- detailInner -->
                                </div><!-- detail -->
                            </div><!-- photoDetailBox -->

                            <div class="photoDetailBox">
                                <div class="photo">
                                    <div class="photoInner"><img src="{{ asset('images/top/cloudService/photo3.jpg') }}" alt="{{ trans('attributes.top.header.photo_detail_boxWrap.photo_3.photo_inner') }}" /></div>
                                </div><!-- photo -->
                                <div class="detail">
                                    <div class="detailInner">
                                        <div class="titleArea">
                                            <h3 class="title">{!! trans('attributes.top.header.photo_detail_boxWrap.photo_3.detail_inner_title') !!}</h3>
                                        </div><!-- titleArea -->
                                        <div class="textArea">
                                            <p class="text">
                                                {{ trans('attributes.top.header.photo_detail_boxWrap.photo_3.detail_inner_text') }}
                                            </p>
                                        </div><!-- textArea -->
                                    </div><!-- detailInner -->
                                </div><!-- detail -->
                            </div><!-- photoDetailBox -->
                        </div><!-- photoDetailBoxWrap -->

                        <div class="noticeArea">
                            <p>{{ trans('attributes.top.header.notice_area') }}</p>
                        </div><!-- noticeArea -->
                    </div><!-- sectionInner -->
                </section><!-- section -->

                <section id="price" class="section bg_gray">
                    <div class="sectionInner inner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionTitle">{{ trans('attributes.top.header.section_title_area') }}</h2>
                        </div><!-- sectionTitleArea -->

                        <div class="planTblArea">
                            <div class="planTbl pcH">
                                <div class="planTblLine planUserPrice">
                                    <div class="planTblCell bgTrans spSelectCell">
                                        <select name="" class="planTblSelect">
                                            <option value="pricePlanKind_1" selected="selected">{{ trans('attributes.role.investor') }}</option>
                                            <option value="pricePlanKind_2">{{ trans('attributes.top.header.price_plan_kind_2') }}</option>
                                        </select>
                                    </div>
                                </div><!-- planTblLine -->
                            </div><!-- planTbl -->

                            <div class="planTbl">
                                <div class="planTblLine planTblHead">
                                    <div class="planTblCell cellTitle planTitle tabH spH"><p>{{ trans('attributes.top.header.plan_tbl_cell.title') }}</p></div>
                                    <div class="planTblCell planFree">
                                        <p class="catch">{!! trans('attributes.top.header.plan_tbl_cell.plan_free.catch') !!}</p>
                                        <p class="planName">{{ trans('attributes.top.header.plan_tbl_cell.plan_free.name') }}</p>
                                    </div>
                                    <div class="planTblCell planBasic">
                                        <p class="catch">{!! trans('attributes.top.header.plan_tbl_cell.plan_basic.catch') !!}</p>
                                        <p class="planName">{{ trans('attributes.setting.pay.basic') }}</p>
                                    </div>
                                    <div class="planTblCell planPremium">
                                        <p class="catch">{!! trans('attributes.top.header.plan_tbl_cell.plan_premium.catch') !!}</p>
                                        <p class="planName">{{ trans('attributes.user_detail.content_15') }}</p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine planUserPrice">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_user_price.title') }}</p>
                                        <select name="" class="planTblSelect tabH spH">
                                            <option value="pricePlanKind_1" selected="selected">{{ trans('attributes.role.investor') }}</option>
                                            <option value="pricePlanKind_2">{{ trans('attributes.top.header.price_plan_kind_2') }}</option>
                                        </select>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">0</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">0</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_1_detail') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">980</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">2,980</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_2_detail') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">3,000</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">10,000</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_2_detail_2') !!}</p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_1') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_2') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_3') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_sankaku.svg') }}" alt="△" /></p>
                                        <p class="notice">{!! trans('attributes.top.header.plan_tbl_cell.notice') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_4') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_5') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_6') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p><a href="javascript:void(0);" data-modal="modal_price_report" class="modalBtn">{{ trans('attributes.top.header.plan_tbl_cell.title_7') }}<span class="question"><img src="{{ asset('images/top/icon/price_question_circle.svg') }}" alt="？" /></span></a></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_8') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_9') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_10') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine planTblHead pcH">
                                    <div class="planTblCell planFree">
                                        <p class="planName">{{ trans('attributes.top.header.plan_tbl_cell.plan_free.name') }}</p>
                                    </div>
                                    <div class="planTblCell planBasic">
                                        <p class="planName">{{ trans('attributes.setting.pay.basic') }}</p>
                                    </div>
                                    <div class="planTblCell planPremium">
                                        <p class="planName">{{ trans('attributes.user_detail.content_15') }}</p>
                                    </div>
                                </div><!-- planTblLine -->


                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_11') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_18') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title_18') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_19') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title_19') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                        <p class="notice">{!! trans('attributes.top.header.plan_tbl_cell.notice_event') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                        <p class="notice">{!! trans('attributes.top.header.plan_tbl_cell.notice_event') !!}</p>
                                    </div>
                                </div>

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_12') }}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                        <p class="notice">{!! trans('attributes.top.header.plan_tbl_cell.notice_event') !!}</p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.home.menu.ranking_experts') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_16') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_13') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_13_2') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->
                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_14') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_15') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_tbl_cell.title_17') }}<span class="implementation">{{ trans('attributes.top.header.plan_tbl_cell.sub_title') }}</span></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_none.svg') }}" alt="-" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine">
                                    <div class="planTblCell cellTitle">
                                        <p><a href="javascript:void(0);" data-modal="modal_price_paySupport" class="modalBtn">有料サポート<span class="question"><img src="{{ asset('images/top/icon/price_question_circle.svg') }}" alt="？" /></span></a></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                    <div class="planTblCell">
                                        <p class="icon"><img src="{{ asset('images/top/icon/price_maru.svg') }}" alt="〇" /></p>
                                    </div>
                                </div><!-- planTblLine -->

                                <div class="planTblLine planTblHead pcH">
                                    <div class="planTblCell planFree">
                                        <p class="planName">{{ trans('attributes.top.header.plan_tbl_cell.plan_free.name') }}</p>
                                    </div>
                                    <div class="planTblCell planBasic">
                                        <p class="planName">{{ trans('attributes.setting.pay.basic') }}</p>
                                    </div>
                                    <div class="planTblCell planPremium">
                                        <p class="planName">{{ trans('attributes.user_detail.content_15') }}</p>
                                    </div>
                                </div><!-- planTblLine -->
                            </div><!-- planTbl -->

                            <div class="planTbl">
                                <div class="planTblLine planUserPrice">
                                    <div class="planTblCell cellTitle">
                                        <p>{{ trans('attributes.top.header.plan_user_price.title') }}</p>
                                        <select name="" class="planTblSelect tabH spH">
                                            <option value="pricePlanKind_1" selected="selected">{{ trans('attributes.role.investor') }}</option>
                                            <option value="pricePlanKind_2">{{ trans('attributes.top.header.price_plan_kind_2') }}</option>
                                        </select>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">0</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">0</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_1_detail') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">980</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">2,980</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_2_detail') !!}</p>
                                    </div>
                                    <div class="planTblCell">
                                        <div class="pricePlanKind pricePlanKind_1 active">
                                            <p class="price"><span class="priceNum">3,000</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <div class="pricePlanKind pricePlanKind_2">
                                            <p class="price"><span class="priceNum">10,000</span><span class="unit"><span class="tax">({{ trans('attributes.top.body.tax') }})</span><br /><span class="yen">{{ trans('attributes.common.unit_amount_without_space') }}</span></span></p>
                                        </div>
                                        <p class="detail">{!! trans('attributes.top.header.price_plan_kind_2_detail_2') !!}</p>
                                    </div>
                                </div><!-- planTblLine -->
                            </div><!-- planTbl -->

                            <div class="planTbl pcH">
                                <div class="planTblLine planUserPrice">
                                    <div class="planTblCell bgTrans spSelectCell">
                                        <select name="" class="planTblSelect">
                                            <option value="pricePlanKind_1" selected="selected">{{ trans('attributes.role.investor') }}</option>
                                            <option value="pricePlanKind_2">{{ trans('attributes.top.header.price_plan_kind_2') }}</option>
                                        </select>
                                    </div>
                                </div><!-- planTblLine -->
                            </div><!-- planTbl -->
                        </div><!-- planTblArea -->

                    </div><!-- sectionInner -->
                </section><!-- section -->

                <section id="faq" class="section">
                    <div class="sectionInner inner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionTitle">{{ trans('attributes.header.faq') }}</h2>
                        </div><!-- sectionTitleArea -->

                        <div class="faqListWrap">
                            <div class="faqList">
                                <dl>
                                    <dt><a href="javascript:void(0);" class="faqListBtn">{{ trans('attributes.top.body.question_1') }}</a></dt>
                                    <dd>
                                        <p>{{ trans('attributes.top.body.answer_1_detail') }}</p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><a href="javascript:void(0);" class="faqListBtn">{{ trans('attributes.top.body.question_3') }}</a></dt>
                                    <dd>
                                        <p>{{ trans('attributes.top.body.answer_2_detail') }}</p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><a href="javascript:void(0);" class="faqListBtn">{{ trans('attributes.top.body.question_4') }}</a></dt>
                                    <dd>
                                        <p>{{ trans('attributes.top.body.answer_3_detail_1') }} <br> {{ trans('attributes.top.body.answer_3_detail_2') }}
                                            <a style="color: blue" href="/#price">{{ trans('attributes.top.body.answer_3_detail_3') }}</a>{{ trans('attributes.top.body.answer_3_detail_4') }}
                                        </p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><a href="javascript:void(0);" class="faqListBtn">{{ trans('attributes.top.body.question_5') }}</a></dt>
                                    <dd>
                                        <p>{{ trans('attributes.top.body.answer_4_detail_1') }} <br> {{ trans('attributes.top.body.answer_4_detail_2') }} </p>
                                    </dd>
                                </dl>
                            </div><!-- faqList -->
                        </div><!-- faqListWrap -->

{{--                        <div class="moreBtnArea">--}}
{{--                            <a href="#" class="roundBtn green">{{ trans('attributes.my_page.see_more') }}</a>--}}
{{--                        </div><!-- kvBtnArea -->--}}

                    </div><!-- sectionInner -->
                </section><!-- section -->

                <section id="letsTry" class="section bg_gray">
                    <div class="sectionInner inner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionTitle">{!! trans('attributes.top.header.section_title_area_2') !!}</h2>
                        </div><!-- sectionTitleArea -->

                        <div class="tryBtnWrap">
                            <ul class="tryBtnList">
                                <li class="trial">
                                    <a href="{{ route(USER_SIMULATION_CREATE) }}" class="roundBtn green shadow">{{ trans('attributes.top.header.free_trial') }}</a>
                                </li>
                                <li class="registration">
                                    <div class="registrationBalloon">
                                        <div class="registrationBalloonInner">
                                            <p>{{ trans('attributes.top.header.registration_balloon') }}</p>
                                        </div>
                                    </div>
                                        <a href="{{ route(REGISTER_SHOW_SCREEN_REGISTER) }}" class="roundBtn yellow shadow">{{ $currentUser ? trans('attributes.top.header.home') : trans('attributes.header.new_member') }}</a>
                                </li>
                            </ul><!-- tryBtnList -->
                        </div><!-- tryBtnWrap -->
                    </div><!-- sectionInner -->
                </section><!-- section -->
            </div><!-- sectionWrap -->
        </div><!--main-->
    </div><!--mainWrap-->

    <div id="modalBg"></div>
    <div id="modalWrap">
        <div id="modalBox">
            <div id="modalClose"><a href="javascript:void(0);"></a></div>

            <div id="modalBoxInner">
                <div id="modal_price_report" class="modalContents">
                    <div class="modalContentsInner">
                        <div class="titleArea">
                            <h4 class="title alignC">{{ trans('attributes.top.header.plan_tbl_cell.title_7') }}</h4>
                        </div><!-- titleArea -->

                        <div class="textArea">
                            <p class="text">{{ trans('attributes.top.header.modal_price_report.text') }}</p>
                            <ul class="dotsList bold">
                                <li>{{ trans('attributes.home.menu.simple_form') }}</li>
                                <li>{{ trans('attributes.property.business_plan') }}</li>
                                <li>{{ trans('attributes.rent_roll_list.title') }}</li>
                                <li>{{ trans('attributes.home.menu.monthly_re_and_ex_table') }}</li>
                                <li>{{ trans('attributes.home.menu.year_achievement_table') }}</li>
                                <li>{{ trans('attributes.home.menu.repair_table') }}</li>
                            </ul><!-- dotsList -->
                        </div><!-- textArea -->
                    </div><!-- modalContentsInner -->
                </div><!-- modalContents -->

                <div id="modal_price_paySupport" class="modalContents">
                    <div class="modalContentsInner">
                        <div class="titleArea">
                            <h4 class="title alignC">{{ trans('attributes.support.paid_support') }}</h4>
                        </div><!-- titleArea -->

                        <div class="textArea">
                            <p class="text">{{ trans('attributes.top.header.modal_price_report.text') }}</p>
                            <ul class="dotsList bold">
                                <li>{{ trans('attributes.home.menu.simple_form') }}</li>
                                <li>{{ trans('attributes.property.business_plan') }}</li>
                                <li>{{ trans('attributes.rent_roll_list.title') }}</li>
                                <li>{{ trans('attributes.home.menu.monthly_re_and_ex_table') }}</li>
                                <li>{{ trans('attributes.home.menu.year_achievement_table') }}</li>
                                <li>{{ trans('attributes.home.menu.repair_table') }}</li>
                            </ul><!-- dotsList -->
                        </div><!-- textArea -->
                    </div><!-- modalContentsInner -->
                </div><!-- modalContents -->
            </div><!-- modalBoxInner -->
        </div><!-- modalBox -->
    </div><!-- modalWrap -->
@endsection
@section('custom_content')
    @if(!$currentUser || $currentUser->isFreeMember())
    <div id="show-ads" class="modal fade photo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg w500">
            <div class="modal-content" style="background-color: unset; border: unset">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body" style="height: auto">
                    <a href="{{ !$currentUser ? route(REGISTER_SHOW_SCREEN_REGISTER) : route(USER_SETTING_INDEX) }}">
                        <img class="img-preview-map" src="{{ asset('images/image_ads.png') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
    <script src="{{ asset('/dist/js/top_index.min.js') }}"></script>
@endsection
