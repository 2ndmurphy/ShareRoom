<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil room yang BISA di-join (bukan 'ended')
        $rooms = Room::where('status', '!=', 'ended')->get();

        // Ambil learner spesifik
        $learnerA = User::where('email', 'learnerA@example.com')->first();
        $learnerB = User::where('email', 'learnerB@example.com')->first();

        // Skenario Learner A: Join 2 Room
        $learnerA_joins = [
            $rooms[0]->id => [
                'joined_at' => now()->subDays(2)
            ],
            $rooms[1]->id => [
                'joined_at' => now()->subDay()
            ],
        ];
        $learnerA->rooms()->attach($learnerA_joins);

        // Skenario Learner B: Join 1 Room
        $learnerB_joins = [
            $rooms[0]->id => [
                'joined_at' => now()
            ],
        ];
        $learnerB->rooms()->attach($learnerB_joins);
    }
}
