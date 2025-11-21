<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMaterial extends Model
{
    protected $fillable = [
        'room_id',
        'title',
        'description',
        'file_path',
        'link_url',
        'content',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
