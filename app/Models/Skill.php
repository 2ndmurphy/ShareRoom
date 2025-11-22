<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi N:N ke MentorProfile
     * Ini adalah relasi baliknya.
     */
    public function mentorProfiles()
    {
        return $this->belongsToMany(MentorProfile::class, 'mentor_skills')
            ->using(MentorSkill::class)
            ->withTimestamps();
    }
}
