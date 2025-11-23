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
     * Relasi N:1 ke Room (Induk).
     */
    public function room() 
    {
        return $this->belongsTo(Room::class);
    }
}
