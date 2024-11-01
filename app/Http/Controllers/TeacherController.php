<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
    public function viewStudents()
    {
        $students = Student::all();
        return view('teacher.viewStudents', compact('students'));
    }

    public function viewSubjects()
    {
        $teacherId = Auth::user()->id;

        // Fetch subjects assigned to the teacher
        $subjects = Subject::join('teacher_subject', 'subjects.id', '=', 'teacher_subject.subject_id')
            ->join('teachers', 'teachers.id', '=', 'teacher_subject.teacher_id')
            ->where('teachers.id', $teacherId)
            ->select('subjects.*') // Select all fields from the subjects table
            ->get();

        return view('teacher.viewSubjects', compact('subjects'));
    }
    public function updateMarks(Request $request, $id)
    {
        $validatedData = $request->validate([
            'predicted_marks' => 'nullable|numeric',
            'final_grade' => 'nullable|string',
            'present_count' => 'required|integer',
            'absent_count' => 'required|integer',
            'classTest_1' => 'required|numeric',
            'Lab_Test1' => 'required|numeric',
            'mid_mark' => 'required|numeric',
            'classTest_2' => 'required|numeric',
            'Lab_Test2' => 'required|numeric',
            'assignment' => 'required|numeric',
            'External_activity' => 'required|numeric',
            'recommendations' => 'nullable|string',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($validatedData);

        return redirect()->back()->with('message', 'Marks updated successfully.');
    }

    public function dashboard()
    {
        $marks = Mark::where('teacher_id', Auth::id())->get();
        return view('teacher.dashboard', compact('marks'));
    }



    //for subject purposes start
    public function viewSubjectDetails($id)
    {
        // Fetch the subject along with its enrolled students
        $subject = Subject::with(['students.user'])->findOrFail($id); // Make sure to load students with their user data
        $students = $subject->students;

        return view('teacher.viewSubjectDetails', compact('subject', 'students'));
    }

    // TeacherController.php

    public function viewStudentDetails($subjectId)
    {
        // Fetch students associated with the given subject ID
        $subject = Subject::with('students')->findOrFail($subjectId);
        $students = $subject->students;

        return view('teacher.viewStudentDetails', compact('subject', 'students'));
    }









    //for subject purposes end
    public function evaluation()
    {
        $teacherId = Auth::id();
        // Fetch subjects assigned to the teacher
        $subjects = Subject::join('teacher_subject', 'subjects.id', '=', 'teacher_subject.subject_id')
            ->where('teacher_subject.teacher_id', $teacherId)
            ->select('subjects.*')
            ->get();

        return view('teacher.evaluation', compact('subjects'));
    }

    public function showStudents($subjectId)
    {
        // Find subject with students enrolled
        $subject = Subject::with('students.user')->findOrFail($subjectId);
        $students = $subject->students;

        return view('teacher.showStudents', compact('subject', 'students'));
    }

    public function viewStudentMarks($studentId)
    {
        // Retrieve marks for the student
        $marks = Mark::where('student_id', $studentId)->get();

        // Check if marks were found or handle accordingly
        if ($marks->isEmpty()) {
            return redirect()->back()->with('error', 'No marks found for the selected student.');
        }

        // dd($marks);

        // Pass the marks to the view
        return view('teacher.viewStudentMarks', compact('marks'));
    }
}
