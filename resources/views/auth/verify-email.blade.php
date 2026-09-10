<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール認証 | COACHTECH</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #000;
        }

        /* ヘッダー: Figma指示値 (高さ82px) */
        .header {
            background: #000;
            padding: 0 50px;
            display: flex;
            align-items: center;
            width: 100%;
            height: 82px;
            box-sizing: border-box;
        }

        /* ロゴ画像の設定: 素材のパスに合わせて適宜修正してください */
        .logo-img {
            height: 40px;
            /* Figma上のロゴの高さに合わせて調整 */
            width: auto;
            display: block;
        }

        /* メインコンテンツ */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 150px;
        }

        /* メッセージ: Figmaの24px Bold */
        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
            font-size: 24px;
            line-height: 1.5;
            color: #000;
        }

        /* 認証ボタン: スクリーンショットのグレーボタン */
        .btn-verify {
            padding: 15px 50px;
            background: #dcdcdc;
            border: 1px solid #999;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* 再送リンク: 青い下線リンク */
        .resend-link {
            background: none;
            border: none;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="/">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" class="logo-img">
        </a>
    </header>

    <div class="container">
        <div class="message">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </div>

        <button class="btn-verify">認証はこちらから</button>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="resend-link">認証メールを再送する</button>
        </form>
    </div>
</body>

</html>
