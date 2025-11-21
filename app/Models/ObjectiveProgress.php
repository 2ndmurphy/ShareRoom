<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectiveProgress extends Model
{
    protected $table = "objective_progress";
    
    protected $fillable = [
        'objective_id',
        'user_id',
        'status',
    ];

    public function objective()
    {
        return $this->belongsTo(RoomObjective::class, 'objective_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
