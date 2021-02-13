<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/from_customer/login.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
<div id="wrap">
    <div id="mainWrap p0">
        <div id="main">
            <div class="loginWrap">
                <div class="loginContent welcomeContent">
                    <h1><img src="{{ asset('images/login/logo.svg')}}" /></h1>
                    <div class="card">
                        <div class="welcome_header">
                            <p>ようこそ {{ $subUser->profile->person_charge_last_name . $subUser->profile->person_charge_first_name }}{{ trans('attributes.invite_user.gender') }}</p>
                            <p>パスワードを設定して、CYARea!をお使いください。</p>
                        </div>
                        <form action="{{ route(SUB_USER_SET_PASSWORD) }}" method="POST">
                            @csrf
                            <div class="inputWrap">
                                <p>{{ trans('attributes.register.step1.label_email') }}</p>
                                <div class="textInput welcome_user"><input type="mail" placeholder="E-mail" value="{{ $subUser->email }}" disabled="disabled" /></div>
                                <input name="email" type="hidden" value="{{ $subUser->email }}"/>
                            </div>
                            <div class="inputWrap">
                                <p>{{ trans('attributes.register.step1.label_password') }}</p>
                                <div class="textInput"><input name="password" type="password" placeholder="Password" value="" /></div>
                            </div>
                            <div class="inputWrap">
                                <div class="btnInput"><input type="submit" value="パスワードを変更" /></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--main-->
    </div><!--mainWrap-->
    @include('layout.new_footer')
    <div id="modalBg"></div>
    <div id="modalWrap">
        <div id="modalBox">
            <div id="modalClose"><a href="javascript:void(0);"></a></div>

            <div id="modalBoxInner">
                <div id="modal_price_report" class="modalContents">
                    <div class="modalContentsInner">
                        <div class="titleArea">
                            <h4 class="title alignC">レポート管理</h4>
                        </div><!-- titleArea -->

                        <div class="textArea">
                            <p class="text">
                                レポート管理機能では、物件ごとに銀行提出用資料等を作成、管理することができます。<br />
                                対応する機能
                            </p>
                            <ul class="dotsList bold">
                                <li>簡易査定書</li>
                                <li>事業計画表</li>
                                <li>賃貸借状況一覧</li>
                                <li>月次収支表</li>
                                <li>年度実績表</li>
                                <li>修繕履歴表</li>
                            </ul><!-- dotsList -->
                        </div><!-- textArea -->
                    </div><!-- modalContentsInner -->
                </div><!-- modalContents -->


                <div id="modal_price_paySupport" class="modalContents">
                    <div class="modalContentsInner">
                        <div class="titleArea">
                            <h4 class="title alignC">有料サポート</h4>
                        </div><!-- titleArea -->

                        <div class="textArea">
                            <p class="text">
                                レポート管理機能では、物件ごとに銀行提出用資料等を作成、管理することができます。<br />
                                対応する機能
                            </p>
                            <ul class="dotsList bold">
                                <li>簡易査定書</li>
                                <li>事業計画表</li>
                                <li>賃貸借状況一覧</li>
                                <li>月次収支表</li>
                                <li>年度実績表</li>
                                <li>修繕履歴表</li>
                            </ul><!-- dotsList -->
                        </div><!-- textArea -->
                    </div><!-- modalContentsInner -->
                </div><!-- modalContents -->
            </div><!-- modalBoxInner -->
        </div><!-- modalBox -->
    </div><!-- modalWrap -->
</div><!--wrap-->
</body>
</html>
