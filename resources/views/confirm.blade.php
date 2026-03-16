<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Confirm</title>
    <style>
        body {
            background-color: #ffffff;
            color: #8b7969;
            margin: 0;
            padding: 0;
            /* 基本は明朝体 */
            font-family: "Times New Roman", "Shippori Mincho", serif;
        }

        .header {
            width: 100%;
            padding: 30px 0;
            border-bottom: 1px solid #edebe9;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: normal;
            letter-spacing: 4px;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 0;
        }

        .page-title {
            font-size: 26px;
            text-align: center;
            margin-bottom: 50px;
            font-weight: normal;
            letter-spacing: 2px;
        }

        .confirm-table {
            width: 750px;
            margin: 0 auto;
            border-collapse: collapse;
            /* テーブル内だけゴシック体に強制指定 */
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
        }

        .confirm-table th {
            width: 35%;
            background-color: #bfa694;
            color: #ffffff;
            padding: 22px 30px;
            font-weight: normal;
            text-align: left;
            border: 1px solid #edebe9;
            font-size: 15px;
        }

        .confirm-table td {
            padding: 22px 30px;
            text-align: left;
            border: 1px solid #edebe9;
            color: #8b7969;
            font-size: 15px;
            font-weight: normal;
        }

        .btn-wrapper {
            text-align: center;
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            /* ボタン周りもゴシック体 */
            font-family: sans-serif;
        }

        .btn-submit {
            width: 130px;
            padding: 12px;
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .btn-back {
            color: #8b7969;
            text-decoration: underline;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
    </header>

    <div class="container">
        <h2 class="page-title">Confirm</h2>

        <form action="/thanks" method="post">
            @csrf
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>
                        {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        {{ $contact['gender'] == '1' ? '男性' : ($contact['gender'] == '2' ? '女性' : 'その他') }}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        {{ $contact['email'] }}
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        {{ $contact['tel_1'] }}{{ $contact['tel_2'] }}{{ $contact['tel_3'] }}
                        <input type="hidden" name="tel_1" value="{{ $contact['tel_1'] }}">
                        <input type="hidden" name="tel_2" value="{{ $contact['tel_2'] }}">
                        <input type="hidden" name="tel_3" value="{{ $contact['tel_3'] }}">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        {{ $contact['address'] }}
                        <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        {{ $contact['building'] }}
                        <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        {{ \App\Models\Category::find($contact['category_id'])->content }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        {{ $contact['detail'] }}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    </td>
                </tr>
            </table>

            <div class="btn-wrapper">
                <button type="submit" class="btn-submit">送信</button>
                <button type="button" class="btn-back" onclick="history.back()">修正</button>
            </div>
        </form>
    </div>
</body>

</html>
