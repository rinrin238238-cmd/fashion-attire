<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Login</title>
    <style>
        body {
            background-color: #f2eee9;
            color: #8b7969;
            font-family: "Times New Roman", serif;
            margin: 0;
        }

        .header {
            background-color: #ffffff;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            position: relative;
            border-bottom: 1px solid #edebe9;
        }

        .logo {
            font-size: 30px;
            letter-spacing: 3px;
            margin: 0;
            font-weight: normal;
        }

        .header-link {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            border: 1px solid #e0dfde;
            padding: 5px 20px;
            text-decoration: none;
            color: #bfa694;
            font-size: 14px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 0;
            text-align: center;
        }

        .page-title {
            font-size: 26px;
            margin-bottom: 40px;
            letter-spacing: 2px;
            font-weight: normal;
        }

        .auth-card {
            background-color: #ffffff;
            width: 550px;
            margin: 0 auto;
            padding: 60px 50px;
            box-sizing: border-box;
        }

        .form-group {
            text-align: left;
            margin-bottom: 25px;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            /* ラベルもゴシック体にするのが一般的 */
            font-family: "Helvetica Neue", Arial, sans-serif;
        }

        input {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #f4f4f4;
            box-sizing: border-box;
            color: #5b4636;
        }

        .btn-submit {
            margin-top: 30px;
            width: 120px;
            padding: 12px;
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        /* 規定のエラーメッセージ用スタイル */
        .error-message {
            color: #ff0000;
            font-size: 13px;
            margin-top: 5px;
            /* 必須：ゴシック体指定 */
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif;
            font-weight: bold;
        }

        /* 認証失敗エラー用の特別な枠（お好みで調整） */
        .login-error-wrapper {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
        <a href="/register" class="header-link">register</a>
    </header>
    <div class="container">
        <h2 class="page-title">Login</h2>
        <div class="auth-card">

            @error('login_error')
                <div class="login-error-wrapper">
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror

            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <span class="label">メールアドレス</span>
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <span class="label">パスワード</span>
                    <input type="password" name="password" placeholder="例: coachtech1106">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
