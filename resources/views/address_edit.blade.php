@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; padding: 50px 20px;">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 24px;">住所の変更</h2>

        <form action="{{ route('item.address.update', $item->id) }}" method="POST">
            @csrf
            {{-- 郵便番号 --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: bold;">郵便番号</label>
                <input type="text" name="post_code" value="{{ old('post_code', Auth::user()->post_code) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- 住所 --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: bold;">住所</label>
                <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- 建物名 --}}
            <div style="margin-bottom: 40px;">
                <label style="display: block; margin-bottom: 10px; font-weight: bold;">建物名</label>
                <input type="text" name="building" value="{{ old('building', Auth::user()->building) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <button type="submit"
                style="width: 100%; background: #ff4d4d; color: #fff; border: none; padding: 15px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer;">
                更新する
            </button>
        </form>
    </div>
@endsection
