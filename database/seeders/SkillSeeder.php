<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create(['name' => 'Laravel']);
        Skill::create(['name' => 'React']);
        Skill::create(['name' => 'Vue.js']);
        Skill::create(['name' => 'Tailwind CSS']);
        Skill::create(['name' => 'Database Design']);
    }
}
