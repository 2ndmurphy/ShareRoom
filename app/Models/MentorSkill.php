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

    /**
     * Relasi N:N ke Skill
     * Ini adalah relasi baru yang kita tambahkan.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'mentor_skills', 'mentor_profile_id', 'skill_id')
                    ->withTimestamps();
    }
}
