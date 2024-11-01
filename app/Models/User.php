<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'password',
        'role',
        'is_verified',
        'image',  // Ensure image is included in fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function (User $user) {
            // Ensure that a Student or Teacher is only created if it doesn't already exist
            if ($user->role === 'student' && !$user->student()->exists()) {
                Student::create([
                    'user_id' => $user->id,
                    'student_id' => uniqid('STU-'),
                    'image' => $user->image,
                ]);
            }

            if ($user->role === 'teacher' && !$user->teacher()->exists()) {
                Teacher::create([
                    'user_id' => $user->id,
                    'teacher_id' => uniqid('TEA-'),
                    'image' => $user->image,
                ]);
            }
        });

        static::deleting(function (User $user) {
            // Automatically delete related Student or Teacher when User is deleted
            if ($user->role === 'student') {
                $user->student()->delete();
            } elseif ($user->role === 'teacher') {
                $user->teacher()->delete();
            }
        });
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
