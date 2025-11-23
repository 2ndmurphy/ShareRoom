<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentors = User::where('role', 'mentor')->get();
        $types = RoomType::all();

        // Skenario 1: Mentor 1 punya 1 Room 'waiting' (Online)
        Room::factory()->waiting()->create([
            'mentor_id' => $mentors[0]->id,
            'type_id' => $types->random()->id,
            'mode' => 'online',
        ]);

        // Skenario 2: Mentor 2 punya 1 Room 'started' (Offline)
        Room::factory()->started()->create([
            'mentor_id' => $mentors[1]->id,
            'type_id' => $types->random()->id,
            'mode' => 'offline',
            'location' => 'Perpustakaan Sekolah',
        ]);

        // Skenario 3: Mentor 3 punya 2 Room (1 'ended', 1 'hybrid/waiting')
        Room::factory()->ended()->create([
            'mentor_id' => $mentors[2]->id,
            'type_id' => $types->random()->id,
        ]);
        Room::factory()->waiting()->create([
            'mentor_id' => $mentors[2]->id,
            'type_id' => $types->random()->id,
            'mode' => 'hybrid',
            'location' => 'Lab Komputer 401',
        ]);

        // Buat 1 Room 'started' lagi (total 5 room)
        Room::factory()->started()->create([
            'mentor_id' => $mentors[0]->id,
            'type_id' => $types->random()->id,
        ]);
    }
}
