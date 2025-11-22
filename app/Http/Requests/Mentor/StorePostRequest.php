<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Pastikan mentor adalah pemilik room ini.
     */
    public function authorize(): bool
    {
        // Ambil 'room' dari parameter rute
        $room = $this->route('room');

        // Izinkan HANYA jika ID user == mentor_id di room
        return $this->user() && $this->user()->id === $room->mentor_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:65535'],
        ];
    }
}
