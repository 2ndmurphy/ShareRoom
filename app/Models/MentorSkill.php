<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorSkill extends Model
{
    protected $fillable = [
        'mentor_profile_id',
        'skill_id',
    ];

    public function mentorProfile()
    {
        return $this->belongsTo(MentorProfile::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
