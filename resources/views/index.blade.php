<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <style>
        /* 指示書に忠実なフォントと色使い */
        body {
            background-color: #ffffff;
            color: #8b7969;
            /* 全体的に茶色系の文字色 */
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
            color: #8b7969;
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

        /* フレックスボックスでラベルと入力を綺麗に整列 */
        .form-group {
            display: flex;
            margin-bottom: 30px;
            /* 項目間の余白を少し広めに */
            align-items: flex-start;
        }

        .label-column {
            width: 250px;
            /* 指示書のバランスに合わせて幅を調整 */
            padding-top: 12px;
            font-size: 16px;
            font-weight: bold;
        }

        .input-column {
            flex: 1;
        }

        .required {
            color: #ff4d4d;
            /* 鮮やかな赤 */
            margin-left: 5px;
        }

        /* 入力欄の共通スタイル */
        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0dfde;
            /* 薄い境界線 */
            background-color: #f4f4f4;
            box-sizing: border-box;
            font-size: 15px;
            color: #5b4636;
        }

        /* 名前と電話番号の横並び調整 */
        .name-wrapper,
        .tel-wrapper {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .name-wrapper input,
        .tel-wrapper input {
            flex: 1;
        }

        /* 性別ラジオボタンのデザイン */
        .gender-wrapper {
            display: flex;
            gap: 30px;
            padding: 10px 0;
        }

        .gender-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #5b4636;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
            accent-color: #8b7969;
            /* ラジオボタンの色を茶色に */
        }

        /* エラーメッセージ（指示書に合わせて目立つように） */
        .error-message {
            color: #ff4d4d;
            font-size: 14px;
            margin-top: 8px;
            font-family: sans-serif;
            /* エラーは読みやすさ優先 */
            font-weight: bold;
        }

        .btn-wrapper {
            text-align: center;
            margin-top: 60px;
        }

        .btn-confirm {
            background-color: #8b7969;
            color: #ffffff;
            border: none;
            padding: 15px 80px;
            font-size: 16px;
            cursor: pointer;
            letter-spacing: 1px;
            transition: opacity 0.3s;
        }

        .btn-confirm:hover {
            opacity: 0.8;
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
                        <input type="text" name="tel_1" value="{{ old('tel_1') }}" placeholder="080"> -
                        <input type="text" name="tel_2" value="{{ old('tel_2') }}" placeholder="1234"> -
                        <input type="text" name="tel_3" value="{{ old('tel_3') }}" placeholder="5678">
                    </div>
                    @if ($errors->has('tel_1') || $errors->has('tel_2') || $errors->has('tel_3') || $errors->has('tell'))
                        <p class="error-message">
                            {{ $errors->first('tel_1') ?: ($errors->first('tel_2') ?: ($errors->first('tel_3') ?: $errors->first('tell'))) }}
                        </p>
                    @endif
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
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
