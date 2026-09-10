<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #fff;
        }

        /* ヘッダー全体：画像通りのゆとりを持たせる */
        .header {
            background: #000;
            height: 82px;
            display: flex;
            align-items: center;
            padding: 0 40px;
            /* 指定の left: 40px */
            justify-content: space-between;
        }

        /* ロゴエリア：幅を370pxに固定 */
        .header-logo {
            width: 370px;
            flex-shrink: 0;
        }

        .header-logo img {
            height: 36px;
            /* 指定の高さ */
            display: block;
        }

        /* 検索バーエリア：中央に浮かせるためのコンテナ */
        .header-search-container {
            flex: 1;
            display: flex;
            justify-content: center;
            /* 検索窓をロゴとナビの間に配置 */
            padding: 0 20px;
        }

        .header-search-container form {
            width: 100%;
            max-width: 500px;
            /* 指定の width: 500 */
            height: 50px;
            /* 指定の height: 50 */
            margin: 0;
        }

        .search-input {
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 5px;
            border: none;
            outline: none;
            font-size: 24px;
            /* 指定の 24px */
            text-align: center;
            font-family: 'Inter', sans-serif;
        }

        /* ナビゲーションエリア：幅を463pxに固定して要素を均等配置 */
        .header-nav {
            width: 463px;
            flex-shrink: 0;
        }

        .header-nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
            justify-content: space-between;
            /* 要素を463pxの中で綺麗に散らす */
        }

        .header-nav li {
            display: flex;
            align-items: center;
        }

        .header-nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 400;
            font-size: 24px;
            /* 指定の 24px */
            white-space: nowrap;
        }

        /* 出品ボタン：100x50 */
        .btn-sell {
            background: #fff !important;
            color: #000 !important;
            width: 100px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-size: 24px !important;
        }

        /* 画面幅が1400px以下になった時の微調整（文字サイズを落として崩れを防ぐ） */
        @media screen and (max-width: 1400px) {
            .header-logo {
                width: auto;
                margin-right: 20px;
            }

            .header-nav {
                width: auto;
            }

            .header-nav ul {
                gap: 20px;
            }

            .search-input,
            .header-nav a,
            .btn-sell {
                font-size: 18px !important;
            }

            .header-search-container form {
                max-width: 400px;
            }
        }

        @media screen and (max-width: 1000px) {
            .header-search-container {
                display: none;
            }
        }
    </style>

    <header class="header">
        <div class="header-logo">
            <a href="/"><img src="{{ asset('img/logo.png') }}" alt="COACHTECH"></a>
        </div>

        {{-- ★会員登録・ログイン画面以外の場合のみ表示する --}}
        @if (!Request::is('register') && !Request::is('login'))
            <div class="header-search-container">
                <form action="{{ route('index') }}" method="GET">
                    <input type="text" name="keyword" class="search-input" placeholder="なにをお探しですか？">
                </form>
            </div>

            <nav class="header-nav">
                <ul>
                    @auth
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
                        </form>
                        <li><a href="{{ route('mypage') }}">マイページ</a></li>
                    @else
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                        <li><a href="{{ route('register') }}">会員登録</a></li>
                    @endauth
                    <li><a href="{{ route('item.create') }}" class="btn-sell">出品</a></li>
                </ul>
            </nav>
        @endif
    </header>

    <main>@yield('content')</main>
    </body>

</html>
