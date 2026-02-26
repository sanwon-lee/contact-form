<?php

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;

return [
    'User' => [
        User::COL_NAME => 'お名前',
        User::COL_EMAIL => 'メールアドレス',
        User::COL_PASSWORD => 'パスワード',
    ],
    'Category' => [
        Category::COL_CONTENT => 'お問い合わせの種類',
    ],
    'Contact' => [
        Contact::COL_CATEGORY_ID => Category::COL_CONTENT,
        'full_name' => 'お名前',
        Contact::COL_GENDER => '性別',
        'gender_male' => '男性',
        'gender_female' => '女性',
        'gender_other' => 'その他',
        Contact::COL_EMAIL => 'メールアドレス',
        Contact::COL_TEL => '電話番号',
        Contact::COL_ADDRESS => '住所',
        Contact::COL_BUILDING => '建物名',
        Contact::COL_DETAIL => 'お問い合わせ内容',
    ],
];
