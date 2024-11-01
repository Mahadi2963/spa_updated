<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Mark;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function subjects()
    {
        $subjects = Subject::whereHas('students', function ($query) {
            $query->where('id', Auth::user()->student->id);
        })->get();

        return view('dashboard.subjects', compact('subjects'));
    }

    public function marks()
    {
        $marks = Mark::where('student_id', Auth::user()->student->id)->with('subject')->get();
        return view('dashboard.marks', compact('marks'));
    }

    public function profile()
    {
        $student = Auth::user()->student;
        return view('dashboard.profile', compact('student'));
    }

    public function support()
    {
        return view('dashboard.support');
    }
}
