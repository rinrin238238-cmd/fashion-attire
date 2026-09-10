@extends('layouts.app')

@section('content')
    <style>
        /* 会員登録画面専用のスタイル（ヘッダー以外） */
        .auth-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            /* 画像のサイズ感に合わせました */
            font-weight: bold;
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 30px;
        }

        .link-text {
            text-align: center;
            margin-top: 20px;
        }

        .link-text a {
            color: #007bff;
            /* 青色リンク */
            text-decoration: none;
            font-size: 16px;
        }
    </style>

    <div class="auth-container">
        <h2>会員登録</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ユーザー名</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>パスワード確認</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="submit-btn">登録する</button>
        </form>

        <div class="link-text">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </div>
@endsection
