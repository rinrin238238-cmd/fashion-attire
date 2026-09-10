<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'name' => $this->faker->word() . '（商品名）',
            'price' => $this->faker->numberBetween(500, 10000),
            'description' => 'これはテスト用の商品説明です。',
            'image' => 'https://via.placeholder.com/300x300.png?text=Item',
            'condition' => $this->faker->randomElement(['良好', '目立った傷なし', 'やや傷あり']),
        ];
    }
}
