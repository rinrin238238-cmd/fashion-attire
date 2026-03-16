<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
// ★CSV出力に必要なので追加
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    // --- 既存の index, confirm, store メソッドはそのまま ---

    // ★ ここから追加：エクスポート処理
    public function export(Request $request)
    {
        // 検索条件を適用してデータを取得
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        // CSVを生成してレスポンスとして返す
        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // Excelの文字化け防止用

            // ヘッダー行
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->category->content,
                    $contact->detail
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('YmdHis') . '.csv"',
        ]);
    }
    public function destroy(Request $request)
    {
        // 送られてきたIDのデータを削除
        \App\Models\Contact::find($request->id)->delete();

        // 管理画面にリダイレクト
        return redirect('/admin');
    }
}
