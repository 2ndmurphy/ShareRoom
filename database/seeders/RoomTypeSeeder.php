<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create(['name' => 'Project Based Learning']);
        RoomType::create(['name' => 'Knowledge Sharing']);
        RoomType::create(['name' => 'Bootcamp']);
    }
}
