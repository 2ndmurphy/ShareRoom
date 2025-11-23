<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'room_id' dan 'user_id' akan diisi oleh Seeder
            'title' => fake()->sentence(6),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}
