<?php

it('validates contact form inputs according to requirements', function (array $data, array $expectedErrors) {
    $this->post(route('contacts.confirm'), $data)
        ->assertInvalid($expectedErrors);
})->with([
    'name(null)' => [
        'data' => ['first_name' => '', 'last_name' => ''],
        'expectedErrors' => [
            'first_name' => '名を入力してください',
            'last_name'  => '姓を入力してください',
        ]
    ],
    'gender(null)' => [
        'data' => ['gender' => ''],
        'expectedErrors' => ['gender' => '性別を選択してください']
    ],
    'email(null, incorrect)' => [
        'data' => ['email' => 'invalid-email'],
        'expectedErrors' => ['email' => 'メールアドレスはメール形式で入力してください']
    ],
    'tel(not half-width, more than 5 digits)' => [
        'data' => [
            'tel_1' => '１２３',
            'tel_2' => '123456',
        ],
        'expectedErrors' => [
            'tel_1' => '電話番号は半角英数字で入力してください',
            'tel_2' => '電話番号は5桁まで数字で入力してください',
        ]
    ],
    'address, category_id, detail(null)' => [
        'data' => ['address' => '', 'category_id' => '', 'detail' => ''],
        'expectedErrors' => [
            'address'     => '住所を入力してください',
            'category_id' => 'お問い合わせの種類を選択してください',
            'detail'     => 'お問い合わせ内容を入力してください',
        ]
    ],
    'detail(more than 120 words)' => [
        'data' => ['detail' => str_repeat('あ', 121)],
        'expectedErrors' => ['detail' => 'お問い合わせ内容は120文字以内で入力してください']
    ],
]);
