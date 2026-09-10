<header
    style="background-color: #000; padding: 15px 40px; display: flex; align-items: center; justify-content: space-between;">
    {{-- ロゴ --}}
    <a href="/" style="text-decoration: none;">
        <h1 style="color: #fff; margin: 0; font-size: 24px; font-weight: bold;">COACHTECH</h1>
    </a>

    {{-- 検索窓：ここがポイント！ --}}
    <div style="flex-grow: 1; margin: 0 40px; max-width: 600px;">
        <form action="{{ route('index') }}" method="GET" style="width: 100%; display: flex;">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？"
                style="width: 100%; padding: 10px 15px; border-radius: 4px; border: none; outline: none; font-size: 14px;">
        </form>
    </div>

    {{-- ナビゲーション --}}
    <nav style="display: flex; gap: 20px; align-items: center;">
        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit"
                    style="background: none; border: none; color: #fff; cursor: pointer; font-size: 14px;">ログアウト</button>
            </form>
            {{-- ここを「マイリスト」に修正 --}}
            <a href="{{ route('mylist') }}" style="color: #fff; text-decoration: none; font-size: 14px;">マイリスト</a>
        @else
            <a href="/login" style="color: #fff; text-decoration: none; font-size: 14px;">ログイン</a>
            <a href="/register" style="color: #fff; text-decoration: none; font-size: 14px;">会員登録</a>
        @endif
        <a href="/sell"
            style="background-color: #fff; color: #000; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold;">出品</a>
    </nav>
</header>
