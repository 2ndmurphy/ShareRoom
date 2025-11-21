<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    public function mentorSkills()
    {
        return $this->hasMany(MentorSkill::class);
    }
}
