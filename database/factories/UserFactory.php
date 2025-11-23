<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // SELALU buat 'learner' sebagai default
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => null, // user learner tidak perlu verif email
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'learner', // default 'learner'
            'mentor_status' => false,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Tentukan state untuk user yang adalah MENTOR
     */
    public function mentor(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'mentor',
            'mentor_status' => true,
            'email_verified_at' => now(),
        ])
            // afterCreating akan dijalankan SETELAH User dibuat
            ->afterCreating(function ($user) {
                // Buat mentor profile
                $profile = $user->mentorProfile()->create([
                    'bio' => fake()->paragraph(),
                    'experience' => fake()->sentence(3),
                ]);

                // Ambil 3 skill acak dari DB dan tautkan
                $skills = Skill::inRandomOrder()->take(3)->pluck('id');
                $profile->skills()->sync($skills);
            });
    }
}
