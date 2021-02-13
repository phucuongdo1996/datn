<?php

return [
    'no_data' => 'データがありません。',
    'notification' => [
        'verified_mail' => '認証メールをご確認ください。',
        'authentication_done' => 'このメールアドレスは認証済みです。',
        'active_fail_1' => 'システムでの処理中にエラーが発生しました。',
        'active_fail_2' => '時間を開けて再度お試しください。',
        'active_error_expiry_time_1' => '認証URLの有効期限が切れてしまいました。',
        'active_error_expiry_time_2' => '再度会員情報の入力を行ってください。',
        'active_fail_notification_1' => '以下のメールアドレスは認証済みです。',
        'active_fail_notification_2' => '続いてサービスを利用するための情報を入力しましょう。',
        'accuracy_email_change_1' => 'メールアドレスの変更確認メールを入力されたメールアドレスに送信いたしました。',
        'accuracy_email_change_2' => '確認URLをクリックするとメールアドレスが変更されます。'
    ],

    "login" => [
        "success" => "ログインできました。",
        "failed" => "入力されたIDかパスワードが間違っています。再度ご確認をお願いします。",
        "account_block" => "入力したアカウントが削除されました。",
        "main_user_free" => "メインユーザーアカウントのステータス変更により現在利用できません",
    ],

    'topic' => [
        'create_success' => 'トピックスの投稿ができました。',
        'edit_success' => 'トピックスの編集ができました。',
        'confirm_delete' => 'クリック後 記事を削除します。よろしいですか？'
    ],

    'photo' => [
        'create_success' => 'フォトアーカイブの投稿ができました。',
        'edit_success' => 'フォトアーカイブの編集ができました。',
    ],

    'change_sub_user_role' => [
        'success' => '権限設定の保存ができました。'
    ],

    'something_wrong' => 'システムでの処理中にエラーが発生しました。時間を開けて再度お試しください。',
    'confirm_delete' => '本当に削除してもよろしいですか。',
    'confirm_delete_article_photo' => 'クリック後 画像を削除します。よろしいですか？',
    'delete_topic_not_reason' => 'を非公開にしました。',
    'email' => [
        'title' => '【CYARea!】管理者によりお客様のアカウントが停止されました。',
        'mr' => '様',
        'administrator_has_suspended_your_account' => 'CYARea!管理者によりお客様のアカウントが停止されました。',
        'email_user' => 'メールアドレス',
        'role' => '会員種別',
        'member_status' => '会員状態',
        'reason_for_stopping' => '【停止理由】',
        'message1' => '※このメールアドレスは送信専用となります。',
        'message2' => 'ご返信いただいてもお答えできませんのでご了承ください。',
        'message3' => 'ご不明点がある場合は、お問い合わせフォームよりご連絡ください。',
        'block_user_success' => 'このユーザーは利用停止になっています',
        'delete_photo' => [
            'title' => '【CYARea!】管理者によりお客様のフォトアーカイブ投稿が削除されました。',
            'admin' => 'CYARea!管理者により',
            'deleted' => 'が削除されました。',
            'delete_success' => 'フォトアーカイブを削除しました。',
            'reason_for_stopping' => '【削除理由】',
        ],
        'topic' => [
            'subject1' => '【CYARea!】管理者により',
            'subject2' => ' が削除されました。',
            'delete_success' => 'トピックスを削除しました。',
        ],
        'edit_property' => [
            'title' => '【CYARea!】管理者により物件情報が変更されました。',
            'avatar' => 'プロフィール画像が変更できました。',
            'reason_for_stopping' => '【変更理由】',
            'deleted' => 'が変更されました。',
        ],
        'sub_user' => [
            'subject' => '【CYARea!】管理者によりお客様のサブユーザーが削除されました。',
            'title' => 'CYARea!管理者によりお客様のサブユーザーが削除されました。',
            'name' => 'サブユーザー氏名',
            'email' => 'メールアドレス',
        ],
    ],
    'admin' => [
        'move_property_success' => '物件を譲渡できました。',
        'move_property_fail' => '物件を譲渡できませんでした。',
        'update_profile_success' => 'プロフィールが変更できました。',
        'update_member_status_success' => '会員状態が変更できました。',
        'update_future_date_success' => '請求開始年月日が変更できました。',
        'update_profile_fail' => 'プロフィールが変更できませんでした。',
        'move_sub_user_success' => 'サブユーザー譲渡できました。',
        'move_sub_user_fail' => 'サブユーザー譲渡できませんでした。',
        'manage_support_success' => '有料サポートのデータが保存できました。',
        'information' => [
            'add_success' => 'お問合せが追加できました。',
            'add_fail' => 'お問合せが追加できませんでした。',
            'edit_success' => 'お問合せが編集できました。',
            'edit_fail' => 'お問合せが編集できませんでした。',
            'delete_success' => 'お問合せが削除できました。',
            'delete_fail' => 'お問合せが削除できませんでした。',
        ]
    ],

    'unblock' => [
        'success' => '利用停止ユーザーの復旧ができました。',
        'fail' => '利用停止ユーザーの復旧ができませんでした。',
    ],

    'pay_api' => [
        'create' => [
            'success' => 'クレジットカードの登録ができました。',
            'fail' => 'クレジットカードの登録ができませんでした。'
        ],

        'delete' => [
            'success' => 'クレジットカードの削除ができました。',
            'fail' => 'クレジットカードの削除ができませんでした。'
        ],

        'change_default' => [
            'success' => '利用するカードが変更できました。',
            'fail' => '利用するカードが変更できませんでした。',
        ],

        'downgrade' => [
            'success' => 'に変更できました。',
            'fail' => 'に変更できませんでした。',
        ],

        'check_card' => [
            'text_1' => 'クレジットカードの情報をまだ登録していませんのでプランのアップグレードができません。',
            'text_2' => '今はカード情報の登録ページに遷移します。よろしいでしょうか？。'
        ],

        'confirm_end_trial' => 'トライアル期間外のため追加料金が発生しますが変更を行いますか？',

        'downgrade_free' => [
            'title' => 'フリープランに変更すると以上の機能が変更できなくなります:',
            'text_1' => '物件情報の登録・閲覧',
            'text_2' => '物件別収支分析の登録',
            'text_3' => 'ポートフォリオ分析の登録・閲覧・出力',
            'text_4' => '資金繰状況一覧',
            'text_5' => 'レポート管理',
            'text_6' => '確定申告書書式の作成',
            'text_7' => '物件概要書の登録・閲覧・出力',
            'text_8' => 'チャット、資料共有機能の使用[実装予定]',
            'text_9' => 'チームビルディング[実装予定]',
        ],

        'downgrade_fee' => [
            'title' => 'ベーシックプランに変更すると以上の機能が変更できなくなります:',
            'text_1' => 'CYARea!登録物件データ(Bank)の閲覧',
            'text_2' => 'チャット、資料共有機能における容量拡張[実装予定]',
            'text_3' => 'イベント・セミナー開催登録',
            'text_4' => '不動産売却媒介契約サービスの登録[実装予定]',
            'text_5' => '借換／融資希望物件登録（提携金融機関）[実装予定]',
        ]
    ],

    'pay' => [
        'subject_email' => 'CYARea!でのお支払手続きが完了いたしました。',
        'notification1' => 'CYARea!をいつもご利用いただき誠にありがとうございます。',
        'notification2' => 'お客様のご利用プランにより、お支払手続きが完了いたしました。',
        'breakdown' => '内訳：',
        'number_sub_user' => '人 × ',
        'sub_user' => 'サブユーザー',
        'total_billed_amount' => '合計ご請求額',
        'billing_date' => 'ご請求開始日',
        'next_billing_date' => '次回ご請求日',
        'plan' => 'プラン',
        'admin_notification' => '様のお支払手続きいが完了しました。',
        'error' => [
            'subject_error' => 'CYARea!へのご入金が確認できませんでした。',
            'notification2' => 'にご入金が確認できませんでしたので、',
            'notification3' => 'サービスのご利用を一時的に中断させていただいております。',
            'notification4' => '登録されておりますクレジットカード情報を再度ご確認いただき、',
            'notification5' => 'お問い合わせフォームよりご連絡ください。',
        ],
    ],

    'sub_user' => [
        'edit_property_permission_denied' => 'この物件は編集できません。物件情報変更の権限設定が必要です。',
        'delete_property_permission_denied' => 'この物件は削除できません。物件情報削除の権限設定が必要です。',
        'report_permission_denied' => 'こちらのページは利用権限がありません。',
    ],

    'sub_user_property' => [
        'success' => '権限設定の保存ができました。',
        'fail' => '権限設定の保存ができませんでした。',
    ],

    'rent_roll' => [
        'success' => '賃貸借状況の物件が削除できました。',
        'fail' => '権限設定の保存ができませんでした。',
    ],

    'cant_print' => '無料会員登録いただくと印刷機能が使用できます。',
    'footer_check_card' => 'ご請求は請求開始日より1か月ごとのサイクルとなります。',
    'card_allow' => [
        'main' => 'ご利用可能なクレジットカード',
        'sub_1' => '※JCB/Amex/Diners/Discoverにつきましては現在審査中です。',
        'sub_2' => 'ご不便をおかけしますが、今しばらくお待ちください。',
        'sub_3' => 'ご利用可能になりましたら改めてご案内いたします。'
    ]
];
