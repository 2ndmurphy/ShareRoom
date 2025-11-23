<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'experience',
        'skills_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi N:N ke Skill
     */
    public function skills()
    {
        return $this->belongsToMany(
            Skill::class,
            'mentor_skills',
            'mentor_profile_id',
            'skill_id'
        )->withTimestamps();
    }
}
