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

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function objectives()
    {
        return $this->hasMany(RoomObjective::class);
    }

    public function materials()
    {
        return $this->hasMany(RoomMaterial::class);
    }
}
