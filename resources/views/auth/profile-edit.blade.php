@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 40px auto; padding: 0 20px; font-family: sans-serif;">
        <h2 style="text-align: center; font-size: 24px; margin-bottom: 30px; font-weight: bold;">プロフィール設定</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 1. ユーザーアイコン設定 --}}
            <div style="display: flex; align-items: center; margin-bottom: 30px; gap: 30px;">
                <div
                    style="width: 100px; height: 100px; background: #eee; border-radius: 50%; overflow: hidden; border: 1px solid #ccc;">
                    <img id="preview" src="{{ $user->image ? asset('storage/' . $user->image) : '' }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <label
                    style="cursor: pointer; color: #ff4d4b; border: 1px solid #ff4d4b; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">
                    画像を選択する
                    <input type="file" name="image" style="display: none;" onchange="previewImage(this);">
                </label>
            </div>

            {{-- 2. 入力項目 --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 16px;">ユーザー名</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                @error('name')
                    <p style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 16px;">郵便番号</label>
                <input type="text" name="post_code" value="{{ old('post_code', $user->post_code) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                @error('post_code')
                    <p style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 16px;">住所</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                @error('address')
                    <p style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 40px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 16px;">建物名</label>
                <input type="text" name="building" value="{{ old('building', $user->building) }}"
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
            </div>

            {{-- 3. 更新ボタン --}}
            <button type="submit"
                style="width: 100%; background-color: #ff4d4b; color: #fff; border: none; padding: 15px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer;">
                更新する
            </button>
        </form>
    </div>

    <script>
        // 画像を選択した瞬間にプレビューを表示するJavaScript
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
