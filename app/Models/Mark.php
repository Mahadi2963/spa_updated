<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        // 'subject',
        'predicted_marks',
        'final_grade',
        'present_count',
        'absent_count',
        'classTest_1',
        'lab_test_1',
        'mid_mark',
        'classTest_2',
        'lab_test_2',
        'assignment',
        'external_activity',
        'recommendations',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
