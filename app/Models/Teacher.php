<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'teacher_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
