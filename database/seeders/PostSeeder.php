<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        foreach ($rooms as $room) {
            // Buat 1 post undangan untuk setiap room
            Post::factory()->create([
                'room_id' => $room->id,
                'user_id' => $room->mentor_id, // Author post adalah mentor room
            ]);
        }
    }
}
