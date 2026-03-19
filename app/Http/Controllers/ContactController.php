<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    // 1. 入力画面（トップページ）の表示
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(Request $request)
    {
        // 電話番号の合体（ハイフンなしで結合）
        $tel = $request->tel_1 . $request->tel_2 . $request->tel_3;
        $request->merge(['tell' => $tel]);

        $request->validate([
            'last_name'   => 'required',
            'first_name'  => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            // --- 電話番号のバリデーションを詳細化 ---
            'tel_1'       => 'required|numeric|digits_between:1,5',
            'tel_2'       => 'required|numeric|digits_between:1,5',
            'tel_3'       => 'required|numeric|digits_between:1,5',
            'tell'        => 'required|numeric|digits_between:1,11',
            // ------------------------------------
            'address'     => 'required',
            'category_id' => 'required',
            'detail'      => 'required|max:120',
        ], [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            // --- 電話番号の規定エラーメッセージ ---
            'tel_1.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_2.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_3.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tell.required'        => '電話番号を入力してください',
            'tell.numeric'         => '電話番号は半角英数字で入力してください',
            'tell.digits_between'  => '電話番号は11桁以内で入力してください',
            // ------------------------------------
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ]);

        $contact = $request->all();
        return view('confirm', compact('contact'));
    }

    // 3. 完了画面への遷移（データベース保存）
    public function store(Request $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'address', 'building', 'detail']);

        // もし tell が空なら、個別の tel_1,2,3 を繋いでみる（予備処理）
        $tell = $request->tell ?? ($request->tel_1 . $request->tel_2 . $request->tel_3);

        $contact['tel'] = $tell;

        Contact::create($contact);
        return view('thanks');
    }

    // 4. 管理画面の表示（検索機能付き）
    public function admin(Request $request)
    {
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

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    // 5. CSVエクスポート処理
    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->filled('gender')) $query->where('gender', $request->gender);
        if ($request->filled('category_id')) $query->where('category_id', $request->category_id);
        if ($request->filled('date')) $query->whereDate('created_at', $request->date);

        $contacts = $query->get();

        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");
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

    // 6. 削除処理
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
