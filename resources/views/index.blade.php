<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <style>
        body {
            background-color: #ffffff;
            color: #5b4636;
            font-family: "Times New Roman", "Shippori Mincho", serif;
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            padding: 30px 0;
            border-bottom: 1px solid #edebe9;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            letter-spacing: 2px;
            margin: 0;
            font-weight: normal;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .page-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 60px;
            font-weight: normal;
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        /* レイアウトの肝：テーブル風の構造 */
        .form-group {
            display: flex;
            margin-bottom: 25px;
            align-items: flex-start;
            /* 上揃え */
        }

        .label-column {
            width: 200px;
            /* 左側のラベル幅を固定 */
            padding-top: 10px;
            font-size: 16px;
        }

        .input-column {
            flex: 1;
            /* 残りの幅をすべて使う */
        }

        .required {
            color: #ff0000;
            margin-left: 5px;
        }

        /* 入力欄のスタイル */
        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: none;
            background-color: #f4f4f4;
            box-sizing: border-box;
            font-size: 15px;
            color: #5b4636;
        }

        .name-wrapper,
        .tel-wrapper {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .tel-input {
            flex: 1;
        }

        /* 性別ラジオボタン */
        .gender-wrapper {
            display: flex;
            gap: 20px;
            padding: 10px 0;
        }

        .gender-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 8px;
            accent-color: #8b7969;
        }

        /* エラーメッセージ（ゴシック体） */
        .error-message {
            color: #ff0000;
            font-size: 13px;
            margin-top: 5px;
            font-family: "Helvetica Neue", Arial, sans-serif;
            font-weight: bold;
        }

        /* 確認ボタン */
        .btn-wrapper {
            text-align: center;
            margin-top: 50px;
        }

        .btn-confirm {
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            padding: 15px 60px;
            font-size: 16px;
            cursor: pointer;
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
                <div class="label-column">お名前<span class="required">※</span></div>
                <div class="input-column">
                    <div class="name-wrapper">
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
                <div class="label-column">性別<span class="required">※</span></div>
                <div class="input-column">
                    <div class="gender-wrapper">
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
                <div class="label-column">メールアドレス<span class="required">※</span></div>
                <div class="input-column">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label-column">電話番号<span class="required">※</span></div>
                <div class="input-column">
                    <div class="tel-wrapper">
                        <input type="text" name="tel_1" value="{{ old('tel_1') }}"> -
                        <input type="text" name="tel_2" value="{{ old('tel_2') }}"> -
                        <input type="text" name="tel_3" value="{{ old('tel_3') }}">
                    </div>
                    @if ($errors->has('tel_1') || $errors->has('tel_2') || $errors->has('tel_3') || $errors->has('tell'))
                        <p class="error-message">
                            {{ $errors->first('tel_1') ?: ($errors->first('tel_2') ?: ($errors->first('tel_3') ?: $errors->first('tell'))) }}
                        </p>
                    @endif
                </div>
                @error('tell')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
    </div>

    <div class="form-group">
        <div class="label-column">住所<span class="required">※</span></div>
        <div class="input-column">
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
            @error('address')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="label-column">建物名</div>
        <div class="input-column">
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        </div>
    </div>

    <div class="form-group">
        <div class="label-column">お問い合わせの種類<span class="required">※</span></div>
        <div class="input-column">
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="label-column">お問い合わせ内容<span class="required">※</span></div>
        <div class="input-column">
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
