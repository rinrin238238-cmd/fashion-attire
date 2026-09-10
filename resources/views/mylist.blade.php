@extends('layouts.app')

@section('content')
    <div style="max-width: 1000px; margin: 0 auto; padding: 20px;">
        <div style="display: flex; gap: 20px; border-bottom: 2px solid #eee; margin-bottom: 30px;">
            <a href="{{ route('index') }}" style="text-decoration: none; color: #888; padding: 10px 20px;">おすすめ</a>
            <a href="{{ route('mylist') }}"
                style="text-decoration: none; color: #ff4d4d; padding: 10px 20px; border-bottom: 2px solid #ff4d4d; font-weight: bold;">マイリスト</a>
        </div>

        @if ($items->isEmpty())
            <p style="text-align: center; color: #888; margin-top: 50px;">お気に入り登録した商品はまだありません。</p>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                @foreach ($items as $item)
                    <div style="position: relative; border-radius: 8px; overflow: hidden; background: #fff;">
                        <a href="{{ route('item.show', $item->id) }}" style="text-decoration: none; color: inherit;">

                            <div style="width: 100%; height: 200px; background: #eee; position: relative;">
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div
                                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc;">
                                        No Image</div>
                                @endif

                                {{-- もし購入テーブルや sold_flg がある場合の条件分岐例 --}}
                                @if ($item->is_sold || $item->purchases_count > 0)
                                    <div
                                        style="position: absolute; top: 0; left: 0; width: 0; height: 0; border-style: solid; border-width: 60px 60px 0 0; border-color: #ff4d4d transparent transparent transparent;">
                                    </div>
                                    <span
                                        style="position: absolute; top: 5px; left: 2px; color: #fff; font-weight: bold; font-size: 14px; transform: rotate(-45deg);">Sold</span>
                                @endif
                            </div>

                            <div style="padding: 10px;">
                                <p style="margin: 0; color: #333;">{{ $item->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
