@extends('layouts.app')

@section('content')
    <style>
        .mypage-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* ★プロフィールエリア：左寄せでまとめる設定 */
        .user-profile {
            display: flex;
            align-items: center;
            /* justify-content: center; を削除して左側に寄せる */
            gap: 30px;
            /* 要素同士の間隔 */
            margin-bottom: 60px;
            padding-left: 50px;
            /* 全体を少し右にずらしてバランス調整 */
        }

        .user-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #ccc;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name-text {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        /* プロフィール編集ボタンをユーザー名のすぐ横に配置 */
        .btn-profile-edit {
            border: 2px solid #ff4d4d;
            color: #ff4d4d;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            white-space: nowrap;
            transition: 0.2s;
        }

        .btn-profile-edit:hover {
            background: #ff4d4d;
            color: #fff;
        }

        /* 商品グリッド */
        .item-list-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .item-box {
            text-decoration: none;
            color: #333;
        }

        .img-wrap {
            width: 100%;
            aspect-ratio: 1/1;
            background: #eee;
            border-radius: 4px;
            overflow: hidden;
        }

        .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-title {
            margin-top: 10px;
            font-weight: bold;
        }

        /* タブ */
        .mypage-tabs {
            display: flex;
            gap: 30px;
            border-bottom: 1px solid #ddd;
        }

        .tab-btn {
            padding-bottom: 10px;
            text-decoration: none;
            color: #999;
            font-weight: bold;
        }

        .tab-btn.active {
            color: #ff4d4d;
            border-bottom: 3px solid #ff4d4d;
        }
    </style>

    <div class="mypage-container">
        <div class="user-profile">
            {{-- アバター --}}
            <div class="user-avatar">
                @if (isset($user->image))
                    <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="">
                @endif
            </div>

            {{-- 名前 --}}
            <div class="user-name-text">{{ $user->name ?? 'ユーザー名' }}</div>

            {{-- プロフィール編集ボタン（名前のすぐ横に来るように配置） --}}
            <a href="{{ route('profile.edit') }}" class="btn-profile-edit">プロフィールを編集</a>
        </div>

        <div class="mypage-tabs">
            <a href="?tab=sell" class="tab-btn {{ request('tab') != 'buy' ? 'active' : '' }}">出品した商品</a>
            <a href="?tab=buy" class="tab-btn {{ request('tab') == 'buy' ? 'active' : '' }}">購入した商品</a>
        </div>

        <div class="item-list-grid">
            @isset($items)
                @foreach ($items as $item)
                    <a href="{{ route('item.show', $item->id) }}" class="item-box">
                        <div class="img-wrap">
                            @php
                                $path = str_contains($item->image, 'items/') ? $item->image : 'items/' . $item->image;
                            @endphp
                            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $path) }}"
                                alt="">
                        </div>
                        <div class="item-title">{{ $item->name }}</div>
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
@endsection
