<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMaterial extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'room_id',
        'title',
        'description',
        'file_path',
        'link_url',
        'content',
    ];

    /**
     * Casts untuk memastikan tipe data ID adalah integer.
     */
    protected $casts = [
        'room_id' => 'integer',
    ];

    /**
     * Relasi N:1 ke Room (Induk).
     */
    public function room() 
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Mendapatkan tipe materi secara dinamis berdasarkan kolom yang terisi.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        if ($this->file_path) {
            return 'file';
        }

        if ($this->link_url) {
            return 'link';
        }

        if ($this->content) {
            return 'text';
        }

        // Fallback default jika (karena alasan tertentu) semua kolom null
        return 'file';
    }
}
