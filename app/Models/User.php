<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'mentor_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mentorProfile()
    {
        return $this->hasOne(MentorProfile::class);
    }

    /**
     * Relasi untuk Room yang DIBUAT oleh User (sebagai Mentor)
     * (1-to-N)
     */
    public function roomsAsMentor()
    {
        return $this->hasMany(Room::class, 'mentor_id');
    }

    /**
     * Relasi untuk Room yang DIIKUTI oleh User (sebagai Member)
     * (N-to-N)
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_members')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    /**
     * Relasi 1:N (Satu User bisa menulis banyak Post)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Post, User>
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function objectiveProgress()
    {
        return $this->hasMany(ObjectiveProgress::class);
    }
}
