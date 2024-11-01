<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
        'image',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    // In app/Models/Subject.php

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject', 'subject_id', 'teacher_id');
    }
}
