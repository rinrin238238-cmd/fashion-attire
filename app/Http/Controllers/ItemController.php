<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // --- 商品一覧 ---
    // --- 商品一覧 (indexメソッドのみ差し替え) ---
    public function index(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->query('keyword');

        // 1. 基本のクエリを作成（with('orders')でSold判定も保持）
        $query = Item::with('orders');

        // 2. キーワードがあれば絞り込みを追加
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        // 3. タブ切り替え（マイリストの場合はお気に入り商品のみ）
        if ($request->query('tab') === 'mylist' && $user) {
            $items = $user->favoriteItems()
                ->where('name', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $items = $query->get();
        }

        return view('index', compact('items'));
    }
    // --- 商品詳細 ---
    public function show($item_id)
    {
        $item = Item::with(['categories', 'comments.user'])->findOrFail($item_id);
        $favoriteCount = $item->favoritedBy()->count();
        $commentCount = $item->comments()->count();
        $isSold = $item->orders()->exists();
        return view('item_detail', compact('item', 'isSold', 'favoriteCount', 'commentCount'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('item_create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'condition' => 'required',
            'category_ids' => 'required|array',
            'image' => 'required|file',
        ]);

        $path = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
            'image' => $path,
        ]);

        if ($request->has('category_ids')) {
            $item->categories()->attach($request->category_ids);
        }

        return redirect()->route('index')->with('message', '商品を出品しました');
    }

    // --- 購入関連 (エラー修正済み版) ---
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        $address = [
            'post_code' => $user->post_code,
            'address' => $user->address,
            'building' => $user->building,
        ];

        return view('purchase', compact('item', 'user', 'address'));
    }

    public function storePurchase(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        // 1. 注文情報をDBに保存
        Order::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $request->payment_method,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        // 2. Stripe決済画面へのリダイレクト処理
        // ★修正ポイント： env() を使って直接 .env の値を読み込みます
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('index'),
            'cancel_url' => route('item.purchase', ['item_id' => $item_id]),
        ]);

        return redirect($session->url, 303);
    }
    public function address($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();
        return view('address_edit', compact('item', 'user'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $user = Auth::user();
        $user->update([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        return redirect()->route('item.purchase', ['item_id' => $item_id]);
    }

    // --- お気に入り ---
    public function favorite($item_id)
    {
        $user = Auth::user();
        if ($user->favoriteItems()->where('item_id', $item_id)->exists()) {
            $user->favoriteItems()->detach($item_id);
        } else {
            $user->favoriteItems()->attach($item_id);
        }
        return back();
    }

    // --- マイページ・プロフィール ---
    public function mypage(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page', 'sell');
        if ($page === 'buy') {
            $items = Item::whereHas('orders', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();
        } else {
            $items = Item::where('user_id', $user->id)->get();
        }
        return view('mypage', compact('user', 'items', 'page'));
    }

    public function profile_edit()
    {
        $user = Auth::user();
        return view('auth.profile-edit', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $user = Auth::user();

        // ここでカラム名が正しく指定されている必要があります
        $user->update([
            'name' => $request->name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('mypage')->with('message', 'プロフィールを更新しました');
    }
}
