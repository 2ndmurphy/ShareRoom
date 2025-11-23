<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat 3 User Mentor
        // Factory 'mentor()' akan otomatis membuat profile + skills
        User::factory()->mentor()->create([
            'name' => 'Mentor Satu',
            'email' => 'mentor1@example.com',
        ]);
        User::factory()->mentor()->create([
            'name' => 'Mentor Dua',
            'email' => 'mentor2@example.com',
        ]);
        User::factory()->mentor()->create([
            'name' => 'Mentor Tiga',
            'email' => 'mentor3@example.com',
        ]);

        // 2. Buat 7 User Learner
        User::factory()->create([
            'name' => 'Learner A (Join 2)',
            'email' => 'learnerA@example.com',
        ]);
        User::factory()->create([
            'name' => 'Learner B (Join 1)',
            'email' => 'learnerB@example.com',
        ]);
        User::factory()->create([
            'name' => 'Learner C (Join 0)',
            'email' => 'learnerC@example.com',
        ]);
        
        // Buat 4 learner random lainnya
        User::factory(4)->create();
    }
}
