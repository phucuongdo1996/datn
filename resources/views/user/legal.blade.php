@extends('layout/base_top')
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="legal" class="sectionWrap">
                <section id="privacypolicy" class="section">
                    <div class="sectionInner smallInner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionTitle">{{ __('attributes.legal.title_1') }}<br class="pcH tabH" />{{ __('attributes.legal.title_2') }}</h2>
                        </div><!-- sectionTitleArea -->
                        <div class="legalListWrap">
                            <div class="legalList">
                                <dl>
                                    <dt>{{ __('attributes.legal.distributor') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.distributor_name') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.sales_company') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.sales_company_location') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.representative') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.representative_name') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.contact_information') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text"><a href="mailto:contact&#64;cyarea.jp">contact&#64;cyarea.jp</a><br /><a href="tel:0358124315">03-5812-4315</a></p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.price_quantity') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.set_price_quantity') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.required_price_other_1') }}<br class="pcH spH" />{{ __('attributes.legal.required_price_other_2') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.tax_transfer_fee') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.timing_method_pay_1') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.specify_time_method_pay_1') }}<br><a
                                                    href="{{ route(TERMS, ['move'=> 'terms_5']) }}" class="textLink" target="_blank">{{ __('attributes.legal.specify_time_method_pay_2') }}</a>{{ __('attributes.legal.specify_time_method_pay_3') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.payment_method') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.payment_method_2') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.delivery_time_method_1') }}<br class="pcH spH" />{{ __('attributes.legal.delivery_time_method_2') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.service_usage') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.handle_condition') }}<br class="pcH spH" />{{ __('attributes.legal.deadline') }}<br class="tabH" />{{ __('attributes.legal.shipping_charges') }}<br class="pcH spH" />{{ __('attributes.legal.cancellations') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.cancellation_1') }}<br>{{ __('attributes.legal.cancellation_2') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>{{ __('attributes.legal.handling_conditions') }}</dt>
                                    <dd>
                                        <div class="textArea">
                                            <p class="text">{{ __('attributes.legal.used') }}</p>
                                        </div><!-- textArea -->
                                    </dd>
                                </dl>
                            </div><!-- legalList -->
                        </div><!-- legalListWrap -->
                        <div class="backBtnArea alignR">
                            <a href="{{ route(TOP) }}" class="textLink">{{ __('attributes.legal.link_screen_top') }}</a>
                        </div><!-- kvBtnArea -->
                    </div><!-- sectionInner -->
                </section><!-- section -->
            </div><!-- sectionWrap -->
        </div><!--main-->
    </div><!--mainWrap-->
@endsection
