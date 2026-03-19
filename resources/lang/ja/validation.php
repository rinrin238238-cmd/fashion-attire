<?php

return [
    'required' => ':attributeを入力してください',
    'email'    => ':attributeは「ユーザー名@ドメイン」の形式で入力してください',
    'min'      => [
        'string' => ':attributeは:min文字以上で入力してください',
    ],
    'confirmed' => ':attributeが一致しません',
    'unique'    => 'この:attributeは既に登録されています',
    'attributes' => [
        'name'     => 'お名前',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
    ],
];
