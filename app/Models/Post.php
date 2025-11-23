<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'room_id',
        'user_id',
        'title',
        'content',
    ];

    /**
     * Relasi N:1 ke Room.
     * Satu Post merujuk ke satu Room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relasi N:1 ke User (Author).
     * Satu Post ditulis oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
