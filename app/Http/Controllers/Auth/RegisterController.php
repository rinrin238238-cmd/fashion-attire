<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 登録画面の表示
    public function index()
    {
        return view('auth.register');
    }

    // 登録処理
    public function store(RegisterRequest $request)
    {
        // 先ほど作成した RegisterRequest で規定のバリデーションが自動実行されます
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }
}
