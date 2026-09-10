@extends('layouts.app')

@section('content')
    <div style="max-width: 1000px; margin: 0 auto; padding: 50px 20px;">
        <form action="{{ route('purchase.store', $item->id) }}" method="POST" id="purchase-form"
            style="display: flex; gap: 60px;">
            @csrf

            {{-- 左側：商品情報・支払い・配送先 (FN021) --}}
            <div style="flex: 2;">
                {{-- 1. 商品情報 --}}
                <div style="display: flex; gap: 30px; margin-bottom: 40px; align-items: center;">
                    <div style="width: 180px; height: 180px; background: #f5f5f5; border-radius: 4px; overflow: hidden;">
                        @if ($item->image)
                            <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="padding: 70px 0; text-align: center; color: #999;">No Image</div>
                        @endif
                    </div>
                    <div>
                        <h2 style="margin: 0 0 15px 0; font-size: 28px;">{{ $item->name }}</h2>
                        <p style="font-size: 24px; font-weight: bold; margin: 0;">¥{{ number_format($item->price) }}</p>
                    </div>
                </div>

                {{-- 2. 支払い方法選択 (FN023) --}}
                <div style="margin-bottom: 40px;">
                    <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; font-size: 18px;">支払い方法</h3>
                    <select name="payment_method" id="payment_select" required
                        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; margin-top: 15px; background: #fff;">
                        <option value="" disabled selected>選択してください</option>
                        <option value="コンビニ支払い">コンビニ支払い</option>
                        <option value="カード支払い">カード支払い</option>
                    </select>
                </div>

                {{-- 3. 配送先 (FN024) --}}
                <div style="margin-bottom: 40px;">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        <h3 style="margin: 0; font-size: 18px;">配送先</h3>
                        <a href="{{ route('item.address', $item->id) }}"
                            style="color: #007bff; text-decoration: none; font-size: 14px;">変更する</a>
                    </div>
                    <div style="margin-top: 15px; line-height: 1.8;">
                        <p style="margin: 0;">〒 {{ $address['post_code'] }}</p>
                        <p style="margin: 0;">{{ $address['address'] }}</p>
                        <p style="margin: 0;">{{ $address['building'] }}</p>
                        <input type="hidden" name="post_code" value="{{ $address['post_code'] }}">
                        <input type="hidden" name="address" value="{{ $address['address'] }}">
                        <input type="hidden" name="building" value="{{ $address['building'] }}">
                    </div>
                </div>
            </div>

            {{-- 右側：小計・確定エリア --}}
            <div style="flex: 1;">
                <div style="border: 1px solid #eee; padding: 25px; border-radius: 8px; position: sticky; top: 20px;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                        <tr>
                            <th style="text-align: left; padding: 10px 0; font-weight: normal;">商品代金</th>
                            <td style="text-align: right;">¥{{ number_format($item->price) }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left; padding: 10px 0; font-weight: normal;">支払い方法</th>
                            <td id="display_payment" style="text-align: right; color: #ff4d4d; font-weight: bold;">未選択</td>
                        </tr>
                    </table>
                    {{-- これがフォーム内にあるので、クリックすると storePurchase が動きます --}}
                    <button type="submit"
                        style="width: 100%; background: #ff4d4d; color: #fff; border: none; padding: 15px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer;">
                        購入する
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('payment_select').addEventListener('change', function() {
            document.getElementById('display_payment').innerText = this.value;
        });
    </script>
@endsection
