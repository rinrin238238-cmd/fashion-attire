<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Register</title>
    <style>
        /* 背景は正解画像通りの薄いベージュ */
        body {
            background-color: #f2eee9;
            color: #8b7969;
            /* タイトルなどは明朝体 */
            font-family: "Times New Roman", "Shippori Mincho", "Hiragino Mincho ProN", serif;
            margin: 0;
            padding: 0;
        }

        /* ヘッダー部分は白背景 */
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

        /* 右上の login ボタン */
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

        /* 中央の白い入力エリア */
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

        /* ラベルと入力欄はゴシック体へ切り替え */
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

        /* 登録ボタン */
        .btn-submit {
            margin-top: 30px;
            width: 90px;
            padding: 12px;
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1px;
            font-family: sans-serif;
        }

        .btn-submit:hover {
            opacity: 0.8;
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
                    <span class="label">お名前</span>
                    <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <span class="label">メールアドレス</span>
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <span class="label">パスワード</span>
                    <input type="password" name="password" placeholder="例: coachtech1106">
                </div>
                <button type="submit" class="btn-submit">登録</button>
            </form>
        </div>
    </div>
</body>

</html>
