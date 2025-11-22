<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ambil 'room' dari parameter rute
        $room = $this->route('room');

        // Izinkan HANYA jika ID user == mentor_id di room
        return $this->user() && $this->user()->id == $room->mentor_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Kita gunakan 'type' (dari UI) untuk validasi kondisional
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:65535'],
            
            // 'type' adalah input <select> di form (file, link, text)
            'type' => ['required', 'string', Rule::in(['file', 'link', 'text'])],

            // Wajib jika 'type' = 'file'
            'file_upload' => [
                Rule::requiredIf($this->input('type') === 'file'),
                'nullable',
                'file',
                'max:20480', // 20MB max
            ],

            // Wajib jika 'type' = 'link'
            'link_url' => [
                Rule::requiredIf($this->input('type') === 'link'),
                'nullable',
                'url', // Pastikan format URL valid
                'max:255',
            ],

            // Wajib jika 'type' = 'text'
            'content' => [
                Rule::requiredIf($this->input('type') === 'text'),
                'nullable',
                'string',
            ],
        ];
    }
}
