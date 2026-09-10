@extends('layouts.app')

@section('content')
    <style>
        /* 出品画面専用のスタイル */
        .container-small {
            max-width: 600px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin: 40px 0 20px;
            color: #555;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .image-upload-box {
            border: 2px dashed #ccc;
            padding: 40px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        .category-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .category-checkbox {
            display: none;
        }

        .category-label {
            padding: 6px 18px;
            border: 1px solid #ff4d4d;
            color: #ff4d4d;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.2s;
        }

        .category-checkbox:checked+.category-label {
            background: #ff4d4d;
            color: #fff;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .error-message {
            color: #ff4d4d;
            font-size: 13px;
            margin-top: 5px;
            font-weight: bold;
        }

        .submit-btn {
            width: 100%;
            background: #ff4d4d;
            color: #fff;
            padding: 16px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            margin-top: 40px;
        }
    </style>

    <div class="container-small">
        <h1>商品の出品</h1>
        <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>商品画像</label>
                <label for="image-input" class="image-upload-box">
                    <span class="upload-label">画像を選択する</span>
                    <input type="file" name="image" id="image-input" style="display:none">
                </label>
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="section-title">商品の詳細</div>
            <div class="form-group">
                <label>カテゴリー</label>
                <div class="category-group">
                    @foreach ($categories as $category)
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="cat{{ $category->id }}"
                            class="category-checkbox">
                        {{-- content を name に書き換え --}}
                        <label for="cat{{ $category->id }}" class="category-label">{{ $category->name }}</label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label>商品の状態</label>
                <select name="condition">
                    <option value="">選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
            </div>

            <div class="section-title">商品名と説明</div>
            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>商品の説明</label>
                <textarea name="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="section-title">販売価格</div>
            <div class="form-group">
                <label>販売価格</label>
                <input type="number" name="price" value="{{ old('price') }}">
            </div>

            <button type="submit" class="submit-btn">出品する</button>
        </form>
    </div>
@endsection
