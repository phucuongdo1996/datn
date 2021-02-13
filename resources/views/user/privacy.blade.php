@extends('layout/base_top')
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
            <div id="main">
                <div id="privacy" class="sectionWrap">
                    <section id="privacypolicy" class="section">
                        <div class="sectionInner smallInner">
                            <div class="sectionTitleArea alignC">
                                <h2 class="sectionTitle">{{ trans('attributes.footer.policy') }}</h2>
                            </div><!-- sectionTitleArea -->

                            <div class="privacyListWrap">
                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_1') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>
                                                    {{ trans('attributes.policy_modal.article_1_1_2') }}
                                                </p>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_2') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_2_1_2') }}</p>
                                                <ul class="kakkoNumList">
                                                    <li><p>{{ trans('attributes.policy_modal.article_2_2_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_2_3_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_2_4_2') }}</p></li>
                                                </ul>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_3') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_3_1_2') }}</p>
                                                <ul class="kakkoNumList">
                                                    <li><p>{{ trans('attributes.policy_modal.article_3_2_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_3_3_2') }}</p></li>
                                                </ul>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_4') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_4_1_2') }}</p>
                                            </li>
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_4_2_2') }}</p>
                                            </li>
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_4_3_2') }}</p>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_5') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_5_1_2') }}</p>
                                                <ul class="kakkoNumList keta2">
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_2_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_3_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_4_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_5_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_6_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_7_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_8_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_9_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_10_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_11_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_12_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_5_13_2') }}</p></li>
                                                </ul>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_6') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_6_1_2') }}</p>
                                                <ul class="kakkoNumList">
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_2_2') }}</p></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <p>
                                                    {{ trans('attributes.policy_modal.article_6_3_2') }}
                                                </p>
                                                <ul class="kakkoNumList">
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_4_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_5_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_6_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_7_2') }}</p></li>
                                                    <li><p>{{ trans('attributes.policy_modal.article_6_8_2') }}</p></li>
                                                </ul>
                                            </li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_7') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_7_1_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_8') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_8_1_2') }}</p></li>
                                            <li><p>{{ trans('attributes.policy_modal.article_8_2_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_9') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_9_1_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_10') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_10_1_2') }}</p></li>
                                            <li><p>{{ trans('attributes.policy_modal.article_10_2_2') }}</p></li>
                                            <li><p>{{ trans('attributes.policy_modal.article_10_3_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_11') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li>
                                                <p>{{ trans('attributes.policy_modal.article_11_1_2') }}</p>
                                            </li>
                                        </ul><!-- numList -->

                                        <div class="grayBgBox">
                                            <div class="companyList">
                                                <h4 class="companyName">{{ trans('attributes.policy_modal.article_11_2_2') }}</h4>
                                                <p class="companyAddress">{{ trans('attributes.policy_modal.article_11_3_2') }}</p>
                                                <p class="contact"><a href="{{ route(USER_CONTACT_CREATE) }}" class="textLink">{{ trans('attributes.policy_modal.article_11_4') }}</a>&emsp;<br class="pcH tabH" />{{ trans('attributes.policy_modal.article_11_4_1') }}</p>
                                            </div><!-- companyList -->
                                        </div><!-- grayBgBox -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_12') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_12_1_2') }}</p></li>
                                            <li><p>{{ trans('attributes.policy_modal.article_12_2_2') }}</p></li>
                                            <li><p>{{ trans('attributes.policy_modal.article_12_3_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="privacyTitleArea">
                                        <h3 class="privacyTitle">{{ trans('attributes.policy_modal.article_13') }}</h3>
                                    </div><!-- privacyTitleArea -->

                                    <div class="textArea">
                                        <ul class="numList">
                                            <li><p>{{ trans('attributes.policy_modal.article_13_1_2') }}</p></li>
                                        </ul><!-- numList -->
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->

                                <div class="privacyList">
                                    <div class="textArea">
                                        <p class="revisionDate alignR">{{ trans('attributes.policy_modal.date') }}</p>
                                    </div><!-- textArea -->
                                </div><!-- privacyList -->
                            </div><!-- privacyListWrap -->

                            <div class="backBtnArea alignR">
                                <a href="{{ route(TOP) }}" class="textLink">TOPページへ戻る</a>
                            </div><!-- kvBtnArea -->
                        </div><!-- sectionInner -->
                    </section><!-- section -->
                </div><!-- sectionWrap -->
            </div><!--main-->
        </div><!--mainWrap-->
@endsection
