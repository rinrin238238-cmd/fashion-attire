<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <style>
        /* 全体の背景と基本フォント */
        body {
            background-color: #ffffff;
            color: #5b4636;
            font-family: "Times New Roman", "Shippori Mincho", "serif";
            margin: 0;
            padding: 0;
        }

        /* ヘッダー部分 */
        .header {
            width: 100%;
            padding: 30px 0;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: normal;
            letter-spacing: 2px;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 0;
        }

        .page-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 60px;
            font-weight: normal;
            letter-spacing: 1px;
        }

        form {
            width: 85%;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
        }

        .label {
            width: 250px;
            font-weight: normal;
            font-size: 16px;
            padding-top: 12px;
        }

        .required {
            color: #f4b4b4;
            margin-left: 5px;
        }

        .input-field {
            flex: 1;
        }

        /* 入力欄のデザイン（正解画像に合わせてグレー背景） */
        input,
        select,
        textarea {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #f4f4f4;
            /* 正解の薄いグレー */
            box-sizing: border-box;
            color: #5b4636;
            font-size: 14px;
        }

        /* プレースホルダーの色をさらに薄く */
        ::placeholder {
            color: #ccc;
        }

        .name-field-wrapper {
            display: flex;
            gap: 20px;
        }

        .tel-field-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .tel-field {
            flex: 1;
            text-align: left;
        }

        /* ラジオボタンの調整 */
        .gender-group {
            display: flex;
            gap: 30px;
            padding: 10px 0;
        }

        .gender-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
            accent-color: #8b7969;
            /* ラジオボタンの色 */
        }

        .error-message {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            font-family: sans-serif;
            /* エラーは読みやすく */
        }

        /* 確認ボタン */
        .btn-wrapper {
            text-align: center;
            margin-top: 60px;
        }

        .btn-confirm {
            display: inline-block;
            width: 160px;
            padding: 15px;
            background: #8b7969;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
            font-size: 16px;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
    </header>

    <div class="container">
        <h2 class="page-title">Contact</h2>

        <form action="/confirm" method="post">
            @csrf
            <div class="form-group">
                <div class="label">お名前<span class="required">※</span></div>
                <div class="input-field">
                    <div class="name-field-wrapper">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                    </div>
                    @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">性別<span class="required">※</span></div>
                <div class="input-field">
                    <div class="gender-group">
                        <label class="gender-label"><input type="radio" name="gender" value="1"
                                {{ old('gender', '1') == '1' ? 'checked' : '' }}>男性</label>
                        <label class="gender-label"><input type="radio" name="gender" value="2"
                                {{ old('gender') == '2' ? 'checked' : '' }}>女性</label>
                        <label class="gender-label"><input type="radio" name="gender" value="3"
                                {{ old('gender') == '3' ? 'checked' : '' }}>その他</label>
                    </div>
                    @error('gender')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">メールアドレス<span class="required">※</span></div>
                <div class="input-field">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">電話番号<span class="required">※</span></div>
                <div class="input-field">
                    <div class="tel-field-wrapper">
                        <input type="text" name="tel_1" value="{{ old('tel_1') }}" class="tel-field"
                            placeholder="080">
                        <span>-</span>
                        <input type="text" name="tel_2" value="{{ old('tel_2') }}" class="tel-field"
                            placeholder="1234">
                        <span>-</span>
                        <input type="text" name="tel_3" value="{{ old('tel_3') }}" class="tel-field"
                            placeholder="5678">
                    </div>
                    @error('tel_1')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('tel_2')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('tel_3')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">住所<span class="required">※</span></div>
                <div class="input-field">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">建物名</div>
                <div class="input-field">
                    <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                </div>
            </div>

            <div class="form-group">
                <div class="label">お問い合わせの種類<span class="required">※</span></div>
                <div class="input-field">
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label">お問い合わせ内容<span class="required">※</span></div>
                <div class="input-field">
                    <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="btn-confirm">確認画面へ</button>
            </div>
        </form>
    </div>
</body>

</html>
