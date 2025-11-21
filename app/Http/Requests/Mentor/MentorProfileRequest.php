<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;

class MentorProfileRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     * Memastikan pengguna yang login adalah mentor.
     * @return bool
     */
    public function authorize(): bool
    {
        // Pastikan pengguna sudah login
        if (!$this->user()) {
            return false;
        }

        // Ambil profil (atau buat instance baru jika belum ada)
        // Kita tidak bisa menggunakan firstOrCreate di sini, jadi kita get.
        $profile = $this->user()->mentorProfile;

        // Jika profile belum ada (mentor baru), izinkan (karena akan create)
        if (!$profile) {
            return $this->user()->role === 'mentor';
        }

        // Jika profile sudah ada, pastikan user_id cocok
        return $this->user()->id === $profile->user_id;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request ini.
     * Aturan ini didasarkan pada ERD yang kamu berikan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bio' => ['nullable', 'string', 'max:5000'],
            'experience' => ['nullable', 'string', 'max:100'],

            'skills' => ['sometimes', 'array'],
            'skills.*' => [
                'integer',
                'distinct',
                'exists:skills,id'
            ],

            'new_skills' => ['sometimes', 'array'],
            'new_skills.*' => ['string', 'max:100', 'distinct'],
        ];
    }

    /**
     * Konfigurasi instance validator.
     * Kita gunakan ini untuk validasi kustom (max 20 skills).
     * @return array
     */
    public function after(): array
    {
        return [
            function ($validator) {
                $skillCount = count($this->input('skills', []));
                $newSkillCount = count($this->input('new_skills', []));
                $totalSkills = $skillCount + $newSkillCount;

                $max = 20;
                if ($totalSkills > $max) {
                    $validator->errors()->add(
                        'skills',
                        "Maksimum {$max} skills diperbolehkan. Kamu mengirim {$totalSkills}."
                    );
                }
            }
        ];
    }
}
