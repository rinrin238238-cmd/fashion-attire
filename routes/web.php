<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Public Routes (誰でもアクセス可能)
|--------------------------------------------------------------------------
*/
// お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

// ユーザー登録（FN013用）
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// ログイン・ログアウト（FN019用）
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


/*
|--------------------------------------------------------------------------
| Private Routes (認証済みユーザーのみ：管理画面関連)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // 管理画面トップ（ページネーション・検索）
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin');

    // CSV出力
    Route::get('/admin/export', [ContactController::class, 'export']);

    // 削除処理
    Route::post('/admin/delete', [ContactController::class, 'destroy']);
});
