@extends('layout/base_top')
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="terms" class="sectionWrap">
                <section id="termsOfService" class="section">
                    <div class="sectionInner smallInner">
                        <div class="sectionTitleArea alignC">
                            <h2 class="sectionTitle">利用規約</h2>
                        </div><!-- sectionTitleArea -->

                        <div class="termsListWrap">
                            <div class="termsList">
                                <div class="textArea">
                                    <p class="text">
                                        CYARea!サイト利用規約（以下「本規約」といいます。）は、株式会社レアプレ（住所：東京都台東区台東一丁目16番3号）（以下「当社」といいます。）が提供する投資不動産の経営管理サイト「CYARea!」（以下「本サイト」といいます。）及び本サイトに関するサービス（以下「本サービス」といいます。）における利用に関する条件を、本サービスを利用する利用者と当社との間で定めるものです。利用者は、本規約の内容に同意した場合に限り、本サイトを使用することができます。
                                    </p>
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_1" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第1条 (定義)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea m20t">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本規約において使用される用語は、次の各号において定める意味を有します。
                                            </p>
                                            <ul class="kakkoNumList">
                                                <li><p>「利用者」とは、本サイト及び本サービスの利用者を意味します。</p></li>
                                                <li><p>「利用者情報」とは、当社が、① 当社が直接的に、又は、② 当社システム利用者を通じて当社が間接的に、利用者から取得する情報その他利用者に関する情報を意味します。</p></li>
                                                <li><p>「当社システム利用者」とは、当社から本サイトに連動するバックエンドシステム等の利用許諾を受けている者を意味します。</p></li>
                                                <li><p>「本プライバシーポリシー」とは、本サイトに掲載されたプライバシーポリシーを意味します。</p></li>
                                                <li><p>「コンテンツ」とは、文章、画像、動画、ソフトウェア、プログラム、コードその他の情報を意味します。</p></li>
                                                <li><p>「本コンテンツ」とは、本サービスを通じてアクセスすることができるコンテンツを意味します。</p></li>
                                                <li><p>「提供コンテンツ」とは、利用者が本サービスに提供、送信又はアップロードしたコンテンツを意味します。</p></li>
                                                <li><p>「本有料サービス」とは、別途当社が定める利用料金を支払うことによって利用者が利用することのできる、別途当社が定めるサービスを意味します。</p></li>
                                            </ul>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_2" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第2条 (規約への同意)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                利用者は、本規約の定めに従って本サービスを利用するものとします。利用者は、本規約に有効かつ取消不能な同意をしないかぎり本サービスを利用できないものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者が未成年者である場合は、親権者など法定代理人の同意を得たうえで本サービスを利用するものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サービスを実際に利用することによって本規約に有効かつ取消不能な同意をしたものとみなされます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_3" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第3条 (規約の変更)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                当社は、あらかじめ利用者に通知することなく、いつでも、本規約を変更できるものとします。変更後の本規約は、当社が運営するウェブサイト内又は本サイト内の適宜の場所に掲示された時点からその効力を生じるものとし、利用者は本規約の変更後も本サービスを使い続けることにより、変更後の本規約に有効かつ取消不能な同意をしたものとみなされます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_4" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第4条 (アカウント)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                利用者は、本サービスの利用に際して利用者情報を登録する場合、真実、正確かつ完全な情報を提供しなければならず、常に最新の情報となるよう修正するものとします。① 利用者自ら又は② 当社若しくは当社システム利用者が入力した利用者情報の内容に虚偽又は誤りがあったことにより利用者に損害が生じたとしても、当社又は当社システム利用者は一切責任を負いません。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サービスの利用に際して当社が発行するパスワードを不正に利用されないよう自らの責任で厳重に管理するものとします。当社又は当社システム利用者は、登録されたパスワードを利用して行なわれた一切の行為を、利用者本人の行為とみなすことができるものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                本サービスに登録した利用者は、当社へ依頼することによりアカウントを削除して退会することができるものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、利用者が本規約に違反し又は違反するおそれがあると認めた場合、あらかじめ利用者に通知することなく、アカウントを停止又は削除することができるものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者の本サービスにおけるすべての利用権は、理由を問わず、アカウントが削除された時点で消滅するものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サービスのアカウントを第三者に利用させ、又は貸与、譲渡、名義変更、売買等をしてはならないものとします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_5" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第5条 (利用料金及び支払方法)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                有料登録利用者は、本有料サービス利用の対価として、別途当社が定める利用料金を、別途当社が指定する支払方法により当社に支払うものとします。有料登録利用者は本有料サービスに不具合が生じた場合であっても、本有料サービスの利用料金を支払う義務を負い、当社は有料登録利用者から支払われた利用料金については、いかなる場合であっても返還いたしません。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                有料登録利用者が利用料金の支払いを遅滞した場合、有料登録利用者は年14.6％の割合による遅延損害金を当社に支払うものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                有料登録利用者が支払期日までに利用料金を支払わなかった場合、自動的に無料登録利用者に登録が変更され、本有料サービスの利用ができなくなります。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、事前に本サイト上に記載し、又は有料登録利用者に電子メールにより通知することにより、利用料金を変更することができるものとします。また、利用料金が変更された後に、有料登録利用者が本有料サービスの利用を継続している場合、有料登録利用者は、変更された利用料金に同意したものとみなされます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_6" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第6条 (プライバシー)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>当社は、利用者の個人情報を、本プライバシーポリシーに従って適切に取り扱います。</p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サービスの個人情報の取り扱いに関して、本プライバシーポリシーを確認するものとします。本プライバシーポリシーは、本規約の一部として本規約に組み込まれるものとします。本規約を承諾することで、利用者は、本プライバシーポリシーに同意するものとします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_7" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第7条 (サービスの提供)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                利用者は、本サービスを利用するにあたり、必要な機器及び通信手段を、利用者の費用と責任で用意するものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、当社が必要と判断する場合、あらかじめ利用者に通知することなく、いつでも、本サービスの全部又は一部の内容を変更し、また、その提供を中止することができるものとします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_8" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第8条 (本サイトの利用)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本サイトは、ユーザーが保有不動産等の経営管理に使用する目的でのみ使用することができ、販売、配布又は開発等の目的で使用してはなりません。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サイトを、当社が提供する状態でのみ利用するものとし、本サイトの複製、修正、変更、改変、翻案その他一切の行為を行ってはなりません。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_9" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第9条 (コンテンツ)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                当社は、当社が提供する本コンテンツについて、利用者に対し、本サービスの利用を唯一の目的とする、譲渡禁止、再許諾禁止及び非独占の利用権を付与します。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本コンテンツを、本サービスが予定している利用態様を超えて利用（複製、送信、転載、改変などの行為を含みます。）しないものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、① (a)自ら又は（当社若しくは当社システム利用者が当該利用者から提供を受けた上で）当社若しくは当社システム利用者が、提供コンテンツ又は利用者情報を本サービスに提供、送信又はアップロードすること及び(b)本規約に基づき当該提供コンテンツ又は利用者情報を本サービスの対象とし、利用することについての適法な権利を有していること（当該(a)及び(b)を行うことにつき第三者の同意が必要な場合には当該同意が得られていることを含みます。）、並びに② 当該提供コンテンツ又は利用者情報が第三者の知的財産権その他の第三者の権利を侵害していないことについて、当社に対して、表明し保証するものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者が提供した提供コンテンツに関する著作権は、当該提供を行った利用者に留保されるものとし、当社及び当社システム利用者は、当該提供コンテンツに関する著作権を取得しません。ただし、当該利用者は、当社及び当社システム利用者に対して、① 本サービスの提供、維持もしくは改善又は② 広告、宣伝その他のプロモーション活動（本サービスに関するものであるか否かを問わない。）に必要な範囲において、当該提供コンテンツの利用を無償で、無期限に、地域の限定なく許諾するものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、当社又は当社の指定する第三者に対して、当該利用者が提供した提供コンテンツについての著作者人格権を行使せず、また、当該提供コンテンツについての著作者人格権を有する第三者をして行使させないものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、自己の責任において、自己が提供した提供コンテンツのバックアップを行い、当社は、当該提供コンテンツのバックアップを行う義務を負わないものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、提供コンテンツに関し法令もしくは本規約に違反し、又は違反するおそれがあると認めた場合、その他業務上の必要がある場合、あらかじめ利用者に通知することなく、当該提供コンテンツを削除するなどの方法により、本サービスでの提供コンテンツの利用を制限できます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_10" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第10条 (禁止事項)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                利用者は、本サービスの利用に際して、以下の事項を行ってはなりません。
                                            </p>
                                            <ul class="kakkoNumList keta2">
                                                <li>
                                                    <p>法令、裁判所の判決、決定もしくは命令、又は法令上拘束力のある行政措置に違反する行為。</p>
                                                </li>
                                                <li>
                                                    <p>公の秩序又は善良の風俗を害するおそれのある行為。</p>
                                                </li>
                                                <li>
                                                    <p>当社又は第三者の著作権、商標権、特許権等の知的財産権、名誉権、プライバシー権、その他法令上又は契約上の権利を侵害する行為。</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        過度に暴力的な表現、露骨な性的表現、人種、国籍、信条、性別、社会的身分、門地等による差別につながる表現、自殺、自傷行為、薬物乱用を誘引又は助長する表現、その他反社会的な内容を含み他人に不快感を与える表現を、投稿又は送信する行為。
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>当社又は第三者になりすます行為又は意図的に虚偽の情報を流布させる行為。</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        営業、宣伝、広告、勧誘、その他営利を目的とする行為（当社の認めたものを除きます。）、他の利用者に対する嫌がらせや誹謗中傷を目的とする行為、その他本サービスが予定している利用目的と異なる目的で本サービスを利用する行為。
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>反社会的勢力に対する利益供与その他の協力行為。</p>
                                                </li>
                                                <li>
                                                    <p>宗教活動又は宗教団体への勧誘行為。</p>
                                                </li>
                                                <li>
                                                    <p>他人の個人情報、登録情報、利用履歴情報などを、不正に収集、開示又は提供する行為。</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        本サービスのサーバやネットワークシステムに支障を与える行為、BOT、チートツール、その他の技術的手段を利用してサービスを不正に操作する行為、本サービスの不具合を意図的に利用する行為、その他当社による本サービスの運営又は他の利用者による本サービスの利用を妨害し、これらに支障を与える行為。
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>本サイトを逆アセンブル、逆コンパイル又はリバース・エンジニアリングする行為。</p>
                                                </li>
                                                <li>
                                                    <p>上記(1)から(11)のいずれかに該当する行為を援助又は助長する行為。</p>
                                                </li>
                                                <li>
                                                    <p>その他、当社が不適当と判断した行為。</p>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_11" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第11条 (利用者の責任)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                利用者は、利用者ご自身の責任において本サービスを利用するものとし、本サービスにおいて行った一切の行為及びその結果について一切の責任を負うものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、利用者が本規約に違反して本サービスを利用していると認めた場合、アカウントの停止、提供コンテンツの削除その他当社が必要かつ適切と判断する措置を講じます。ただし、当社は、かかる違反を防止又は是正する義務を負いません。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                利用者は、本サービスを利用したことに起因して（当社がかかる利用を原因とするクレームを第三者より受けた場合を含みます。）、当社が直接的もしくは間接的に何らかの損害（弁護士費用の負担を含みます。）を被った場合、当社の請求にしたがって直ちにこれを賠償するものとします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_12" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第12条 (当社の免責)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                当社は、本サービス（本コンテンツを含みます。）に事実上又は法律上の瑕疵（安全性、信頼性、正確性、完全性、有効性、特定の目的への適合性、セキュリティなどに関する欠陥、エラーやバグ、権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。当社は、利用者に対して、かかる瑕疵を除去して本サービスを提供する義務を負いません。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                当社は、本サービスに起因して利用者に生じたあらゆる損害について一切の責任を負いません。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_13" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第13条 (連絡方法)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本サービスに関する当社から利用者への連絡は、当社が運営するウェブサイト又は本サイト内の適宜の場所への掲示その他、当社が適当と判断する方法により行うものとします。
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                本サービスに関する利用者から当社への連絡は、当社が運営するウェブサイト又は本サイト内の適宜の場所に設置するお問い合わせフォームの送信又は当社が指定する方法により行うものとします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_14" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第14条 (分離可能性)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本規約の条項の一部が適用される強行法規に基づき無効になった場合であっても、本規約のその他の部分の有効性に影響を与えるものではなく、当該無効になった部分を除いて本規約は有効に存続するものとします。当社は、本規約の一部が無効であることが判明した場合には、無効となった条項についてただちに有効な条項に置き換えます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_15" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第15条 (準拠法、裁判管轄)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本規約の準拠法は日本法とします。本サービスに起因又は関連して利用者と当社との間に生じた紛争については東京地方裁判所を第一審の専属的合意管轄裁判所とします。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div id="terms_16" class="termsList">
                                <div class="termsTitleArea">
                                    <h3 class="termsTitle">第16条 (言語)</h3>
                                </div><!-- termsTitleArea -->

                                <div class="textArea">
                                    <ul class="numList">
                                        <li>
                                            <p>
                                                本規約は、日本語により作成されます。
                                            </p>
                                        </li>
                                    </ul><!-- numList -->
                                </div><!-- textArea -->
                            </div><!-- termsList -->

                            <div class="termsList">
                                <div class="textArea">
                                    <p class="revisionDate alignR">最終改定日：2019年12月26日</p>
                                </div><!-- textArea -->
                            </div><!-- termsList -->
                        </div><!-- termsListWrap -->

                        <div class="backBtnArea alignR">
                            <a  href="{{ route(TOP) }}" class="textLink">TOPページへ戻る</a>
                        </div><!-- kvBtnArea -->

                    </div><!-- sectionInner -->
                </section><!-- section -->
            </div>
        </div><!--main-->
    </div><!--mainWrap-->
@endsection
