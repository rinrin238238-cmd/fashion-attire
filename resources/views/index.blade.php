@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 20px;">

        {{-- タブ切り替え --}}
        <div class="tabs" style="display: flex; gap: 40px; border-bottom: 1px solid #eee; margin-bottom: 30px;">
            <a href="{{ route('index', ['keyword' => request('keyword')]) }}"
                class="tab {{ request('tab') !== 'mylist' ? 'active' : '' }}"
                style="padding: 12px 0; cursor: pointer; font-weight: bold; text-decoration: none;
                   color: {{ request('tab') !== 'mylist' ? '#ff4d4d' : '#888' }};
                   border-bottom: {{ request('tab') !== 'mylist' ? '3px solid #ff4d4d' : 'none' }};">
                おすすめ
            </a>
            <a href="{{ route('index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}"
                class="tab {{ request('tab') === 'mylist' ? 'active' : '' }}"
                style="padding: 12px 0; cursor: pointer; font-weight: bold; text-decoration: none;
                   color: {{ request('tab') === 'mylist' ? '#ff4d4d' : '#888' }};
                   border-bottom: {{ request('tab') === 'mylist' ? '3px solid #ff4d4d' : 'none' }};">
                マイリスト
            </a>
        </div>

        {{-- 商品グリッド --}}
        <div class="item-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px;">
            @forelse ($items as $item)
                <div class="item-card" style="text-decoration: none; color: inherit;">
                    <div class="item-image-wrapper"
                        style="position: relative; width: 100%; aspect-ratio: 1/1; background: #f4f4f4; border-radius: 4px; overflow: hidden;">

                        @if ($item->orders && $item->orders->count() > 0)
                            <div class="sold-tag"
                                style="position: absolute; top: 0; left: 0; background-color: rgba(255, 77, 77, 0.9); color: white; padding: 4px 15px; font-weight: bold; font-size: 13px; z-index: 5;">
                                Sold</div>
                        @endif

                        <a href="{{ route('item.show', ['item_id' => $item->id]) }}">
                            @if (str_starts_with($item->image, 'http'))
                                {{-- S3のURL --}}
                                <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                {{-- ★修正：items/ フォルダが含まれているか判定して出し分ける --}}
                                @php
                                    $imagePath = str_contains($item->image, 'items/')
                                        ? $item->image
                                        : 'items/' . $item->image;
                                @endphp
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </a>
                    </div>
                    <div class="item-name" style="margin-top: 10px; font-size: 15px; font-weight: bold;">
                        {{ $item->name }}
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                    商品が登録されていません。
                </div>
            @endforelse
        </div>
    </div>
@endsection
