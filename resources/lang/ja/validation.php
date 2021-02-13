<?php

return [
    'register' => [
        'email' => [
            'invalidate' => 'メールアドレスの形式になっていません。',
            'required' => '必須入力項目です。',
            'max' => 'メールは60文字以内です',
            'unique' => '入力されたメールアドレスは登録されています。ログインしてサービスを使用してください。',
            'unique_edit' => '入力されたメールアドレスは使用できません。他のメールアドレスをご入力ください。',
            'home_network_domain' => 'キャリアのメールアドレスはご使用になれません。',
            'exists' => '入力されたメールアドレスが存在しません。',
            'illegal' => 'メールアドレスが間違っています。',
        ],
        'password' => [
            'required' => '必須入力項目です。',
            'min_max' => 'パスワードは8文字以上、30文字以下でご入力ください。',
            'regex' => 'パスワードに指定できない文字が含まれています。半角英数字のみ設定可能です。',
        ],
    ],

    'profile' => [
        'required' => '必須入力項目です。',
        'characters_japan_double_byte' => '登録不可能な文字が入力されています。全角文字のみ入力可能です。',
        'characters_double_byte_katakana' => '全角カタカナでご入力ください。',
        'characters_double_byte' => '全角、半角英数字、記号（- . , ー、。）のみご入力いただけます。',
        'please_choose' => '選択してください。',
        'address_regex' => '全角、半角英数字、記号（- ー）が入力可能です。',
        'check_url_single_byte' => '半角英数字、記号（ : . /  ）のみご入力いただけます。',
        'license_single_byte' => '半角数字のみご入力いただけます。',
        'nick_name' => '登録不可能な文字が入力されています。
        全角・半角・ハイフン・アンダーバーが入力可能です。',

        'birthday' => [
            'format' => '日付の形式をyyyy/mm/ddでご入力ください。',
        ],
        'email' => [
            'format' => 'メールアドレスの形式になっていません。',
        ],
        'license_address' => [
            'required' => '都道府県を選択してください。',
        ],
        'phone' => [
            'format' => '半角数値でご入力ください。',
        ],
        'zip_code' => [
            'format' => 'ハイフン無しの半角数値7桁でご入力ください。',
        ],
        'avatar' => [
            'extension' => '画像の形式はjpgかpngの許可されています。',
            'max_size' => '画像1枚の容量は5MBまでです。'
        ]
    ],

    'simulation' => [
        'name_required' => '必須入力項目です。',
        'select_required' => '選択してください。',
        'correct_format' => '0.00〜9999999.99の範囲でご入力ください。',
        'interest_correct_format' => '0.00〜99.99の範囲でご入力ください。',
        'integer' => '半角数値でご入力ください。',
        'date_format' => '日付の形式をyyyy/mm/ddでご入力ください。',
        'the_date_is_invalid' => '入力日付が間違っています。',
    ],

    'reset_password' => [
        'exists_1' => '登録されていないメールアドレスです。',
        'exists_2' => 'ご入力されたメールアドレスを再度確認してください。',
        'pw_confirm' => [
            'same_1' => '確認用パスワードが一致していません。',
            'same_2' => '再度ご入力ください。'
        ]
    ],

    'property' => [
        'required' => '必須入力項目です。',
        'please_choose' => '選択してください。',
        'zip_code' => 'ハイフン無しの半角数値7桁でご入力ください。',
        'avatar_image' => '画像の形式はjpgかpngの許可されています。',
        'avatar_max_size' => '画像1枚の容量は5MBまでです。',
        'interest_rate' => '0.00〜99.9の範囲でご入力ください。',
        'interest_rate_100' => '0.00〜100の範囲でご入力ください。',
        'max_rent_rate' => '賃貸可能面積より小さい値をご入力ください。',
    ],

    'business_plan' => [
        'initial_borrowing_period' => '半角数字のみでご入力ください。',
        'expected_interest' => '半角数字とドットのみでご入力ください。',
    ],

    'simple_assessment' => [
        'number_and_dot_one_byte' => '半角の数字とドットでご入力ください。',
        'number_one_byte' => '半角数字のみでご入力ください。',
    ],

    'rent_roll' => [
        'required' => '必須入力項目です。',
        'required_1' => '選択してください。',
        'input_number_dot' => '半角数字とドットのみでご入力ください。',
        'input_number' => '半角数字のみでご入力ください。',
        'format_date' => '日付の形式をyyyy/mm/ddでご入力ください。',
        'date_period_1' => '現行契約開始日と現行契約終了日以前の日付を入力してください。',
        'date_period_2' => '原契約日以降、現行契約終了日以前の日付を入力してください。',
        'date_period_3' => '原契約日と現行契約開始日以降の日付を入力してください。',
    ],

    'annual_performance' => [
        'required' => 'ご選択ください。',
        'between' => '0.00〜100.00の範囲でご入力ください。'
    ],

    'tax' => [
        'number_one_byte' => '半角数字のみでご入力ください。',
        'choose_year' => '年度を選択してください。',
        'choose_month' => '月期を選択してください。'
    ],

    'monthly_balance' => [
        'number_one_byte' => '半角数字のみでご入力ください。',
        'number_and_dot_one_byte' => '半角数字とドットのみでご入力ください。',
        'limit' => '0.0〜100.0の範囲で入力してください。',
        'please_choose' => 'ご選択ください。',
    ],
    'topic' => [
        'title' => 'タイトルに入力してください。'
    ],

    'export_csv' => [
        'please_choose' => 'こちらに選択してください。'
    ],

    'support' => [
      'please_select_one_here' => 'こちらは一つ選択してください。',
      'please_enter_here' => 'こちらに入力してください。',
    ],

    'move_for_trial_user' => '選択されたユーザーはトライアル期間中のため譲渡不可となります。'
];
