<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. まずは全データを取得する準備（クエリビルダの開始）
        $query = Contact::with('category');

        // 2. キーワード検索（名前 or メールアドレス）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // 3. 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 4. お問い合わせの種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. 年月日検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 6. 7件ずつページネーション（検索条件を保持したまま）
        $contacts = $query->paginate(7)->appends($request->all());

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
