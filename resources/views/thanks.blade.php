<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Thank you</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* 全体的に標準的なフォントへ */
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
        }

        .thanks-container {
            position: relative;
            text-align: center;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* 背景の大きな "Thank you" */
        .thanks-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 200px;
            color: #f4f4f4;
            white-space: nowrap;
            z-index: 1;
            /* 正解画像に合わせた、伝統的なセリフ体 */
            font-family: 'Times New Roman', Times, serif;
            font-weight: normal;
            /* 文字の間隔を広く */
            letter-spacing: 0.1em;
        }

        /* 中央のコンテンツ */
        .thanks-content {
            position: relative;
            z-index: 2;
        }

        .thanks-text {
            /* 太字（Bold）に設定 */
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 30px;
            letter-spacing: 0.05em;
            color: #5b4636;
        }

        /* HOMEボタン */
        .btn-home {
            display: inline-block;
            padding: 12px 35px;
            background-color: #8b7969;
            color: white;
            text-decoration: none;
            font-size: 14px;
            border-radius: 0;
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="thanks-container">
        <div class="thanks-bg">Thank you</div>

        <div class="thanks-content">
            <p class="thanks-text">お問い合わせありがとうございました</p>
            <a href="/" class="btn-home">HOME</a>
        </div>
    </div>
</body>

</html>
