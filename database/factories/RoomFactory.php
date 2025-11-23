<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->sentence(),
            'mode' => fake()->randomElement(['online', 'offline', 'hybrid']),
            'location' => null, // Default null (untuk online)
            'requirements' => fake()->paragraph(2),
            // mentor_id dan type_id akan diisi oleh Seeder
        ];
    }

    // --- State untuk kondisi Room ---

    public function waiting(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'waiting',
            'started_at' => now()->addDays(7),
            'end_at' => now()->addDays(14),
        ]);
    }

    public function started(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'started',
            'started_at' => now()->subDays(3), // Mulai 3 hari lalu
            'end_at' => now()->addDays(11),
        ]);
    }

    public function ended(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'ended',
            'started_at' => now()->subDays(14), // Mulai 2 minggu lalu
            'end_at' => now()->subDays(7),   // Selesai 1 minggu lalu
        ]);
    }
}
