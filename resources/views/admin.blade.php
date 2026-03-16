<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>
    <style>
        /* 基本設定：全体は明朝体 */
        body {
            background-color: #ffffff;
            color: #8b7969;
            font-family: "Times New Roman", "Shippori Mincho", "Hiragino Mincho ProN", serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #ffffff;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            position: relative;
            border-bottom: 1px solid #edebe9;
        }

        .logo {
            font-size: 30px;
            font-weight: normal;
            letter-spacing: 3px;
            margin: 0;
        }

        .btn-logout {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: 1px solid #edebe9;
            padding: 5px 20px;
            color: #bfa694;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-family: sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        .page-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 40px;
            font-weight: normal;
            letter-spacing: 2px;
        }

        /* 検索フォーム */
        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 40px;
            font-family: sans-serif;
        }

        .search-input,
        .search-select {
            padding: 12px;
            border: 1px solid #edebe9;
            background-color: #f9f9f9;
            color: #8b7969;
            font-size: 14px;
        }

        .search-input {
            flex: 2;
        }

        .search-select {
            flex: 1;
        }

        .btn-search {
            background-color: #8b7969;
            color: #fff;
            border: none;
            padding: 0 35px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-reset {
            background-color: #f2eee9;
            color: #bfa694;
            border: none;
            padding: 0 30px;
            cursor: pointer;
            text-decoration: none;
            line-height: 45px;
            font-size: 14px;
            text-align: center;
        }

        /* ナビゲーション（エクスポート左、ページネーション右） */
        .table-nav {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 15px;
            font-family: sans-serif;
        }

        .btn-export {
            display: block;
            background-color: #f2eee9;
            color: #8b7969;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        /* ページネーション装飾 */
        .pagination-wrapper nav div:first-child,
        .pagination-wrapper nav p,
        .pagination-wrapper nav div.flex.items-center.justify-between p {
            display: none !important;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            border: 1px solid #edebe9;
            background-color: #fff;
            color: #bfa694;
            text-decoration: none;
            margin-left: -1px;
            font-size: 14px;
        }

        /* ＜ ボタン（前へ） */
        .pagination li:first-child a,
        .pagination li:first-child span {
            color: transparent;
            position: relative;
        }

        .pagination li:first-child a::after,
        .pagination li:first-child span::after {
            content: '<';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            color: #bfa694;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ＞ ボタン（次へ）：5の隣に表示 */
        .pagination li:last-child a,
        .pagination li:last-child span {
            display: block !important;
            color: transparent;
            position: relative;
        }

        .pagination li:last-child a::after,
        .pagination li:last-child span::after {
            content: '>';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            color: #bfa694;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination li.active span {
            background-color: #8b7969;
            color: #fff;
            border-color: #8b7969;
        }

        /* 1〜5の数字と矢印以外を隠す */
        .pagination li:nth-child(n+7):not(:last-child) {
            display: none !important;
        }

        /* テーブル */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-family: sans-serif;
            border: 1px solid #edebe9;
        }

        .admin-table th {
            background-color: #8b7969;
            color: #fff;
            text-align: left;
            padding: 18px;
            font-weight: normal;
            font-size: 15px;
        }

        .admin-table td {
            padding: 18px;
            border-bottom: 1px solid #edebe9;
            background-color: #fff;
            font-size: 14px;
            color: #8b7969;
        }

        .btn-detail {
            border: 1px solid #edebe9;
            background-color: #fff;
            color: #bfa694;
            padding: 8px 20px;
            cursor: pointer;
            font-size: 13px;
        }

        /* モーダル：中身のみゴシック体 */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 60px 80px;
            width: 650px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* ★ モーダル内のみゴシック体 ★ */
            font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
        }

        .close-btn {
            position: absolute;
            right: 25px;
            top: 25px;
            font-size: 24px;
            cursor: pointer;
            color: #8b7969;
            border: 1px solid #edebe9;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 38px;
        }

        .modal-inner-table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }

        .modal-inner-table th {
            width: 40%;
            text-align: left;
            padding: 15px 0;
            font-weight: bold;
            color: #8b7969;
            vertical-align: top;
            font-size: 16px;
        }

        .modal-inner-table td {
            padding: 15px 0;
            color: #8b7969;
            font-size: 16px;
        }

        .btn-delete-submit {
            display: block;
            margin: 0 auto;
            background-color: #ae4323;
            color: #fff;
            border: none;
            padding: 10px 45px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
        <form action="/logout" method="post" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">logout</button>
        </form>
    </header>

    <div class="container">
        <h2 class="page-title">Admin</h2>

        <form class="search-form" action="/admin" method="get">
            <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}">
            <select name="gender" class="search-select">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category_id" class="search-select">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}</option>
                @endforeach
            </select>
            <input type="date" name="date" class="search-select" value="{{ request('date') }}">
            <button type="submit" class="btn-search">検索</button>
            <a href="/admin" class="btn-reset">リセット</a>
        </form>

        <div class="table-nav">
            <a href="/admin/export{{ strstr(request()->fullUrl(), '?') }}" class="btn-export">エクスポート</a>
            <div class="pagination-wrapper">
                {{ $contacts->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                        <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td style="text-align: right;">
                            <button class="btn-detail" data-contact="{{ json_encode($contact) }}">詳細</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <table class="modal-inner-table">
                <tr>
                    <th>お名前</th>
                    <td id="modal-name"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modal-gender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modal-email"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="modal-tel"></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="modal-address"></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="modal-building"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modal-category"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modal-detail"></td>
                </tr>
            </table>
            <form action="/admin/delete" method="post">
                @csrf
                <input type="hidden" name="id" id="modal-id">
                <button type="submit" class="btn-delete-submit">削除</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', () => {
                const contact = JSON.parse(button.getAttribute('data-contact'));
                document.getElementById('modal-name').innerText = contact.last_name + '　' + contact
                    .first_name;
                document.getElementById('modal-gender').innerText = contact.gender == 1 ? '男性' : (contact
                    .gender == 2 ? '女性' : 'その他');
                document.getElementById('modal-email').innerText = contact.email;
                document.getElementById('modal-tel').innerText = contact.tel;
                document.getElementById('modal-address').innerText = contact.address;
                document.getElementById('modal-building').innerText = contact.building || '';
                document.getElementById('modal-category').innerText = contact.category.content;
                document.getElementById('modal-detail').innerText = contact.detail;
                document.getElementById('modal-id').value = contact.id;
                document.getElementById('detailModal').style.display = 'block';
            });
        });

        document.querySelector('.close-btn').onclick = () => {
            document.getElementById('detailModal').style.display = 'none';
        };

        window.onclick = (event) => {
            if (event.target == document.getElementById('detailModal')) {
                document.getElementById('detailModal').style.display = 'none';
            }
        };
    </script>
</body>

</html>
