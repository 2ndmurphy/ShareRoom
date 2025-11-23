<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return $this->user() &&
            $this->user()->role === 'mentor' &&
            $this->user()->mentor_status === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => ['required', 'integer', 'exists:room_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:65535'],
            
            // Menggunakan Enum dari ERD
            'mode' => ['required', 'string', Rule::in(['online', 'offline', 'hybrid'])],
            
            // 'location' wajib diisi JIKA modenya 'offline' ATAU 'hybrid'.
            'location' => [
                Rule::requiredIf(fn () => in_array($this->input('mode'), ['offline', 'hybrid'])),
                'nullable', // Boleh null jika mode 'online'
                'string',
                'max:255'
            ],
            
            'started_at' => ['required', 'date', 'after:now'],
            'end_at' => ['required', 'date', 'after:started_at'],
            'requirements' => ['nullable', 'string', 'max:65535'],
        ];
    }

    /**
     * Pesan kustom untuk validasi
     */
    public function messages(): array
    {
        return [
            'type_id.required' => 'Tipe room wajib dipilih.',
            'type_id.exists' => 'Tipe room tidak valid.',
            'location.required' => 'Lokasi wajib diisi jika mode "Offline" atau "Hybrid".',
            'started_at.after' => 'Waktu mulai harus setelah waktu sekarang.',
            'end_at.after' => 'Waktu selesai harus setelah waktu mulai.',
        ];
    }
}
