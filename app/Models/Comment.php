<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'content',
    ];

    // コメントしたユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // コメントされた商品とのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
