<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * 1. ここを必ず true に書き換えてください（重要！）
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 2. バリデーションルール (FN013)
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * 3. 規定のエラーメッセージ (FN013)
     * スクショの指示通り「一文字も間違えない」ように設定します
     */
    public function messages()
    {
        return [
            'name.required'     => 'お名前を入力してください',
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスはメール形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
