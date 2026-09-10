<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            // 出品したユーザーのID
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 商品の基本情報
            $table->string('name');             // 商品名
            $table->string('brand')->nullable(); // ブランド名（空でもOK）
            $table->string('condition');        // 商品の状態
            $table->text('description');        // 商品の説明
            $table->integer('price');           // 販売価格
            $table->string('image')->nullable(); // 商品画像パス

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
