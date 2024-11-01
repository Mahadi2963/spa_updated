<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function viewSubjects()
    {
        $subjects = Subject::whereHas('students', function ($query) {
            $query->where('student_id', Auth::id());
        })->get();

        return view('student.view_subjects', compact('subjects'));
    }

    public function viewMarks()
    {
        $marks = Mark::where('student_id', Auth::id())->get();
        return view('student.view_marks', compact('marks'));
    }

    public function dashboard()
    {
        $marks = Mark::where('student_id', Auth::id())->get();
        return view('dashboard.student', compact('marks'));
    }
}
