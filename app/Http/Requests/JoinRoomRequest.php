<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoinRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan user sudah login
        if (!$this->user()) {
            return false;
        }

        $room = $this->route('room');

        // User tidak boleh join jika dia adalah MENTOR/pemilik room
        if ($this->user()->id === $room->mentor_id) {
            return false;
        }

        // User hanya boleh join jika status room 'waiting'
        if ($room->status !== 'waiting') {
            return false;
        }

        // Jika lolos semua, izinkan
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Pesan kustom jika otorisasi gagal (HTTP 403)
     */
    public function messages(): array
    {
        return [
            // Pesan ini tidak akan terlihat langsung, tapi bagus untuk logging
            'authorization' => 'Anda tidak dapat bergabung dengan room ini (mungkin Anda adalah mentor atau room sudah ditutup).',
        ];
    }
}
