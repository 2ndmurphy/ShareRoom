<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomMaterial>
 */
class RoomMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Logika untuk mengisi salah satu dari 3 tipe materi
        $type = fake()->randomElement(['file', 'link', 'text']);
        
        $data = [
            // room_id akan diisi oleh Seeder
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(1),
            'file_path' => null,
            'link_url' => null,
            'content' => null,
        ];

        if ($type === 'file') {
            // Kita hanya memalsukan path-nya, tidak perlu upload file
            $data['file_path'] = 'materials/' . fake()->bothify('??????##') . '.pdf';
        } elseif ($type === 'link') {
            $data['link_url'] = fake()->url();
        } else { // 'text'
            $data['content'] = fake()->paragraphs(3, true); // 'true' = return as string
        }

        return $data;
    }
}
