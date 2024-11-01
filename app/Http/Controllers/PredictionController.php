<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Prediction;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    /**
     * Predict marks for a specific student.
     */
    public function predictMarks(Request $request, $studentId)
    {
        // Check if user has permission (Admin, Teacher, or Student)
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'teacher', 'student'])) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
        }

        // Fetch student and related marks
        $student = Student::findOrFail($studentId);
        $marks = Mark::where('student_id', $studentId)->get();

        // Send mark data for prediction
        $predictedData = $this->predictWithML($marks);

        // Save predicted marks to the predictions table
        foreach ($predictedData as $subjectId => $predictedMark) {
            Prediction::updateOrCreate(
                ['student_id' => $student->id, 'subject_id' => $subjectId],
                [
                    'teacher_id' => $user->id,
                    'predicted_marks' => $predictedMark,
                    'prediction_date' => now(),
                    'additional_info' => json_encode(['source' => 'PredictionModel'])
                ]
            );
        }

        return redirect()->back()->with('message', 'Marks predicted successfully.');
    }

    // Simulate the prediction process
    private function predictWithML($marks)
    {
        $predictedData = [];
        foreach ($marks as $mark) {
            $predictedData[$mark->subject_id] = mt_rand(40, 100); // Replace with actual ML logic
        }
        return $predictedData;
    }
}
