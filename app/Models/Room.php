<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'mentor_id',
        'type_id',
        'title',
        'description',
        'mode',
        'location',
        'started_at',
        'end_at',
        'requirements',
        'status',
    ];

    /**
     * Casts untuk tipe data, terutama datetime.
     */
    protected $casts = [
        'started_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * Relasi N:1 ke User (Mentor).
     * Satu Room dimiliki oleh satu Mentor.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function objectives()
    {
        return $this->hasMany(RoomObjective::class);
    }

    /**
     * Relasi 1:N ke RoomMaterial.
     * Satu Room bisa memiliki banyak Materi.
     */
    public function materials()
    {
        return $this->hasMany(RoomMaterial::class);
    }

    /**
     * Relasi 1:N ke post (Satu Room bisa punya banyak Post undangan)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Post, Room>
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
