<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメントを保存する
     */
    public function store(Request $request, $item_id)
    {
        // バリデーション（空欄チェックなど）
        $request->validate([
            'content' => 'required|max:255',
        ], [
            'content.required' => 'コメントを入力してください',
            'content.max' => 'コメントは255文字以内で入力してください',
        ]);

        // DBに保存
        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'content' => $request->content,
        ]);

        // 元の画面に戻る
        return back()->with('message', 'コメントを投稿しました');
    }
}
