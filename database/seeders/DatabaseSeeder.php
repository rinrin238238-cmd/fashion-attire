<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ユーザーがいないと商品が登録できないので、先にユーザーを作る
        \App\Models\User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // 作成した商品シーダーを呼び出す
        $this->call([
            ItemsTableSeeder::class,
        ]);
    }
}
