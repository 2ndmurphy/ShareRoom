<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        foreach ($rooms as $room) {
            // Buat 3 materi untuk setiap room
            RoomMaterial::factory(3)->create(['room_id' => $room->id]);
        }
    }
}
