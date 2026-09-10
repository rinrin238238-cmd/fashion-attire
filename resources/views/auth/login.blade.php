@extends('layouts.app')

@section('content')
    <div style="max-width: 400px; margin: 80px auto; padding: 20px;">
        <h2 style="text-align: center; font-size: 24px; margin-bottom: 30px;">ログイン</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            {{-- メールアドレス --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                @error('email')
                    <p style="color: #ff4d4d; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">パスワード</label>
                <input type="password" name="password"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                @error('password')
                    <p style="color: #ff4d4d; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- ログインボタン --}}
            <button type="submit"
                style="width: 100%; background-color: #ff4d4d; color: #fff; padding: 12px; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; margin-bottom: 20px;">
                ログインする
            </button>

            {{-- 会員登録へのリンク --}}
            <div style="text-align: center;">
                <a href="{{ route('register') }}" style="color: #007bff; text-decoration: none; font-size: 14px;">
                    会員登録はこちら
                </a>
            </div>
        </form>
    </div>
@endsection
