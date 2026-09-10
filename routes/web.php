<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- 商品一覧 (おすすめ) ---
Route::get('/', [ItemController::class, 'index'])->name('index');

// --- 認証・詳細 (ログイン不要) ---
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

// --- メール認証関連 ---
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $request->session()->forget('url.intended');
    return redirect()->to('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// --- ログイン必須のルート ---
Route::middleware('auth')->group(function () {
    // 購入・住所変更
    Route::get('/purchase/{item_id}', [ItemController::class, 'purchase'])->name('item.purchase');
    Route::post('/purchase/{item_id}', [ItemController::class, 'storePurchase'])->name('purchase.store');
    Route::get('/purchase/address/{item_id}', [ItemController::class, 'address'])->name('item.address');
    Route::post('/purchase/address/{item_id}', [ItemController::class, 'updateAddress'])->name('item.address.update');

    // 出品
    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

    // プロフィール・マイページ
    Route::get('/mypage', [ItemController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/profile', [ItemController::class, 'profile_edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ItemController::class, 'profile_update'])->name('profile.update');

    // お気に入り (POST)
    Route::post('/item/{item_id}/favorite', [ItemController::class, 'favorite'])->name('favorite');

    // コメント投稿 (POST) ★追加
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');

    // ログアウト
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // 会員登録後のリダイレクト先をプロフィール設定に変更
    Route::get('/home', function () {
        return redirect()->route('profile.edit');
    });
});
