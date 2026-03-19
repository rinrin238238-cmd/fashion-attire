<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Register</title>
    <style>
        /* 背景は薄いベージュ */
        body {
            background-color: #f2eee9;
            color: #8b7969;
            font-family: "Times New Roman", "Shippori Mincho", "Hiragino Mincho ProN", serif;
            margin: 0;
            padding: 0;
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
            font-weight: normal;
            letter-spacing: 3px;
            margin: 0;
        }

        .header-link {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            border: 1px solid #e0dfde;
            padding: 5px 25px;
            text-decoration: none;
            color: #bfa694;
            font-size: 14px;
            font-family: sans-serif;
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
            font-weight: normal;
            letter-spacing: 2px;
        }

        .auth-card {
            background-color: #ffffff;
            width: 550px;
            margin: 0 auto;
            padding: 60px 50px;
            box-sizing: border-box;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            text-align: left;
            margin-bottom: 25px;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", sans-serif;
            color: #8b7969;
        }

        input {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #f4f4f4;
            box-sizing: border-box;
            font-size: 14px;
            font-family: sans-serif;
        }

        /* 登録ボタンのスタイル */
        .btn-register {
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            padding: 10px 40px;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1px;
            display: block;
            margin: 40px auto 0;

        }

        .btn-register:hover {
            opacity: 0.8;
        }

        .error-message {
            color: #ff0000;
            font-size: 12px;
            margin-top: 5px;
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", "Meiryo", sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
        <a href="/login" class="header-link">login</a>
    </header>

    <div class="container">
        <h2 class="page-title">Register</h2>
        <div class="auth-card">
            <form action="/register" method="post">
                @csrf
                <div class="form-group">
                    <label>お名前</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>メールアドレス</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>パスワード</label>
                    <input type="password" name="password" placeholder="例: coachtech1106">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-register">登録</button>
            </form>
        </div>
    </div>
</body>

</html>
