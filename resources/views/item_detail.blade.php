@extends('layouts.app')

@section('content')
    <style>
        /* 詳細ページ専用のスタイル */
        .container-detail {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            gap: 60px;
            padding: 0 40px;
            align-items: flex-start;
        }

        .item-image-box {
            flex: 0 0 45%;
            background: #fdfdfd;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .item-image-box img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 36px;
            margin: 0;
            font-weight: bold;
        }

        .brand-name {
            font-size: 16px;
            margin-top: 8px;
            color: #666;
        }

        .price {
            font-size: 28px;
            margin: 25px 0;
            font-weight: bold;
        }

        .price span {
            font-size: 16px;
            font-weight: normal;
            margin-left: 5px;
        }

        .purchase-btn {
            display: block;
            width: 100%;
            background: #ff4d4d;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 40px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .purchase-btn:hover {
            background: #ff3333;
        }

        .section-title {
            font-size: 22px;
            margin: 50px 0 20px;
            font-weight: bold;
            color: #000;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .description {
            line-height: 1.8;
            white-space: pre-wrap;
            font-size: 16px;
            color: #444;
        }

        .category-tag {
            background: #f0f0f0;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            color: #333;
            margin-right: 8px;
        }
    </style>

    <div class="container-detail">
        {{-- 画像エリア --}}
        <div class="item-image-box">
            @if ($item->image)
                @if (str_starts_with($item->image, 'http'))
                    <img src="{{ $item->image }}" alt="{{ $item->name }}">
                @else
                    @php
                        $imagePath = str_contains($item->image, 'items/') ? $item->image : 'items/' . $item->image;
                    @endphp
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item->name }}">
                @endif
            @else
                <div style="font-size: 14px; color: #999;">No Image</div>
            @endif
        </div>

        {{-- 詳細情報エリア --}}
        <div class="item-details">
            <h1 class="item-name">{{ $item->name }}</h1>
            <div class="brand-name">{{ $item->brand ?? 'ブランド情報なし' }}</div>
            <div class="price">¥{{ number_format($item->price) }} <span>(税込)</span></div>

            {{-- 購入ボタン --}}
            @if (isset($isSold) && $isSold)
                <button class="purchase-btn" style="background: #bbb; cursor: not-allowed;" disabled>売り切れました</button>
            @else
                <a href="{{ route('item.purchase', $item->id) }}" class="purchase-btn">購入手続きへ</a>
            @endif

            <h2 class="section-title">商品説明</h2>
            <div class="description">{{ $item->description }}</div>

            <h2 class="section-title">商品の情報</h2>
            <div style="margin-bottom: 20px;">
                <strong style="display:block; margin-bottom:10px;">カテゴリー</strong>
                @forelse($item->categories as $category)
                    <span class="category-tag">{{ $category->content }}</span>
                @empty
                    <span style="color:#999;">なし</span>
                @endforelse
            </div>
            <div>
                <strong style="display:block; margin-bottom:10px;">商品の状態</strong>
                <span>{{ $item->condition }}</span>
            </div>
        </div>
    </div>
@endsection
