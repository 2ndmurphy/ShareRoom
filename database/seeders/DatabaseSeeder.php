<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan ini sangat penting
        $this->call([
            SkillSeeder::class,         // 1. Buat skills
            RoomTypeSeeder::class,      // 2. Buat tipe room (Project, Sharing)
            UserSeeder::class,          // 3. Buat semua User (Learner & Mentor)
            RoomSeeder::class,          // 4. Mentor membuat Rooms (waiting, started, ended)
            RoomMemberSeeder::class,    // 5. Learner join Rooms
            RoomMaterialSeeder::class,  // 6. Isi Room dengan materi
            PostSeeder::class,          // 7. Buat Post (undangan) untuk Room
        ]);
    }
}
