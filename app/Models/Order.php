<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'post_code',
        'address',
        'building',
        'payment_method',
    ];

    // 商品との繋がり
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // ユーザーとの繋がり
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
