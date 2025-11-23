<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ambil room dari parameter rute
        $room = $this->route('room');

        // Pastikan user sudah login
        if (!$this->user()) {
            return false;
        }

        // Mentor TIDAK BISA "leave" room mereka sendiri
        // (Mereka harus menghapusnya, itu fitur lain)
        if ($this->user()->id === $room->mentor_id) {
            return false;
        }

        // (Opsional) Kita bisa cek apakah user adalah member,
        // tapi detach() tidak akan error jika user bukan member.
        // Jadi, cek mentor sudah cukup.

        return true; // Izinkan aksi
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
}
