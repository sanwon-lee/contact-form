<?php

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;

$categoryLabel = 'お問い合わせの種類';

return [
    'User' => [
        User::COL_NAME     => 'お名前',
        User::COL_EMAIL    => 'メールアドレス',
        User::COL_PASSWORD => 'パスワード',
    ],
    'Category' => [
        Category::COL_CONTENT => $categoryLabel,
    ],
    'Contact' => [
        Contact::COL_CATEGORY_ID => $categoryLabel,
        Contact::COL_FIRST_NAME  => '名',
        Contact::COL_LAST_NAME   => '姓',
        Contact::COL_GENDER      => '性別',
        Contact::COL_EMAIL       => 'メールアドレス',
        Contact::COL_TEL         => '電話番号',
        Contact::COL_ADDRESS     => '住所',
        Contact::COL_BUILDING    => '建物名',
        Contact::COL_DETAIL      => 'お問い合わせ内容',
        Contact::COL_CREATED_AT  => '作成日時',
        'full_name'              => 'お名前',
    ],
];
