<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // カテゴリー5件作成
        $categories = [
            ['content' => '商品のお届けについて'],
            ['content' => '商品の交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // お問い合わせを35件作成
        Contact::factory(35)->create();
    }
}
