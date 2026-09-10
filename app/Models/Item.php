<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order;
use App\Models\Comment;
use App\Models\User;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'condition',
        'description',
        'price',
        'image',
    ];

    /**
     * カテゴリとのリレーション（多対多）
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category');
    }

    /**
     * 注文とのリレーション（1対多）
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * コメントとのリレーション（1対多）
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * お気に入りしたユーザーとのリレーション（多対多）
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * 出品したユーザーとのリレーション（多対1）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
