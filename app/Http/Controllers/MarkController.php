<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    /**
     * Display a listing of marks based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin can view marks for all students
            $marks = Mark::with(['student', 'subject'])->get();
        } elseif ($user->role === 'teacher') {
            // Teacher can view marks for their assigned subjects
            $marks = Mark::whereHas('subject', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with(['student', 'subject'])->get();
        } elseif ($user->role === 'student') {
            // Student can view only their own marks
            $marks = Mark::where('student_id', $user->student->id)->with('subject')->get();
        } else {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
        }

        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new mark.
     * Only accessible by admins and teachers.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'teacher') {
            $students = Student::all(); // Get all students
            $subjects = Subject::all(); // Get all subjects
            return view('marks.create', compact('students', 'subjects'));
        }

        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }

    /**
     * Store a newly created mark in the database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $user->role !== 'teacher') {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
        }

        $request->validate([
            'student_id' => 'required|exists:students,id', // Assuming 'students' table is named correctly
            'subject_id' => 'required|exists:subjects,id', // Assuming 'subjects' table is named correctly
            'marks_obtained' => 'required|numeric|min:0|max:100'
        ]);

        Mark::create($request->all()); // Store the new mark
        return redirect()->route('marks.index')->with('message', 'Mark added successfully.');
    }

    /**
     * Show the form for editing an existing mark.
     * Only accessible by admins and teachers.
     */

    /**
     * Update an existing mark in the database.
     */
    public function update(Request $request, $id)
    {
        $mark = Mark::findOrFail($id);
        $user = Auth::user();

        if (
            $user->role !== 'admin' &&
            !($user->role === 'teacher' && $mark->subject->teacher_id === $user->id)
        ) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
        }

        $request->validate([
            'marks_obtained' => 'required|numeric|min:0|max:100'
        ]);

        $mark->update($request->only('marks_obtained')); // Update the mark with validated data
        return redirect()->route('marks.index')->with('message', 'Mark updated successfully.');
    }

    /**
     * Remove a mark from the database.
     * Only accessible by admins.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
        }

        $mark = Mark::findOrFail($id);
        $mark->delete(); // Delete the mark

        return redirect()->route('marks.index')->with('message', 'Mark deleted successfully.');
    }

    public function edit($id)
    {
        // Fetch the mark by ID
        $mark = Mark::findOrFail($id);

        // Fetch all subjects
        $subjects = Subject::all(); // or use your logic to get specific subjects

        // Retrieve all students
        $students = Student::with('user')->get();

        // Pass the mark and subjects to the view
        return view('marks.edit', compact('mark', 'subjects', 'students'));
    }
}
