<?php

use App\Models\User;

return [
    'user' => [
        User::COL_NAME => 'お名前',
        User::COL_EMAIL => 'メールアドレス',
        User::COL_PASSWORD => 'パスワード',
        User::COL_CREATED_AT => '作成日時',
        User::COL_UPDATED_AT => '更新日時',
    ],
];
