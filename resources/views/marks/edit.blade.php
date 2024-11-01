@extends('layouts.teacherlayout')

@section('content')



<div class="content">

    <div class="container mt-4">
        <h2>Edit Mark</h2>

        <!-- Display Error Message -->
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Form for editing marks -->
        <form action="{{ route('marks.update', $mark->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Student selection (if needed) -->
            <div class="form-group">
                <label for="student">Student</label>
                <select class="form-control" id="student" name="student_id" required>
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $mark->student_id ? 'selected' : '' }}>
                        {{ $student->user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Subject selection (if needed) -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <select class="form-control" id="subject" name="subject_id" required>
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $mark->subject_id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Predicted Marks -->
            <div class="form-group">
                <label for="predicted_marks">Predicted Marks</label>
                <input type="number" class="form-control" id="predicted_marks" name="predicted_marks"
                    value="{{ $mark->predicted_marks }}">
            </div>

            <!-- Final Grade -->
            <div class="form-group">
                <label for="final_grade">Final Grade</label>
                <input type="text" class="form-control" id="final_grade" name="final_grade"
                    value="{{ $mark->final_grade }}">
            </div>

            <!-- Present Count -->
            <div class="form-group">
                <label for="present_count">Present Count</label>
                <input type="number" class="form-control" id="present_count" name="present_count"
                    value="{{ $mark->present_count }}" required>
            </div>

            <!-- Absent Count -->
            <div class="form-group">
                <label for="absent_count">Absent Count</label>
                <input type="number" class="form-control" id="absent_count" name="absent_count"
                    value="{{ $mark->absent_count }}" required>
            </div>

            <!-- Class Test 1 -->
            <div class="form-group">
                <label for="classTest_1">Class Test 1</label>
                <input type="number" class="form-control" id="classTest_1" name="classTest_1"
                    value="{{ $mark->classTest_1 }}" required>
            </div>

            <!-- Lab Test 1 -->
            <div class="form-group">
                <label for="lab_test_1">Lab Test 1</label>
                <input type="number" class="form-control" id="lab_test_1" name="lab_test_1"
                    value="{{ $mark->lab_test_1 }}" required>
            </div>

            <!-- Mid Mark -->
            <div class="form-group">
                <label for="mid_mark">Mid Mark</label>
                <input type="number" class="form-control" id="mid_mark" name="mid_mark" value="{{ $mark->mid_mark }}"
                    required>
            </div>

            <!-- Class Test 2 -->
            <div class="form-group">
                <label for="classTest_2">Class Test 2</label>
                <input type="number" class="form-control" id="classTest_2" name="classTest_2"
                    value="{{ $mark->classTest_2 }}" required>
            </div>

            <!-- Lab Test 2 -->
            <div class="form-group">
                <label for="lab_test_2">Lab Test 2</label>
                <input type="number" class="form-control" id="lab_test_2" name="lab_test_2"
                    value="{{ $mark->lab_test_2 }}" required>
            </div>

            <!-- Assignment -->
            <div class="form-group">
                <label for="assignment">Assignment</label>
                <input type="number" class="form-control" id="assignment" name="assignment"
                    value="{{ $mark->assignment }}" required>
            </div>

            <!-- External Activity -->
            <div class="form-group">
                <label for="external_activity">External Activity</label>
                <input type="number" class="form-control" id="external_activity" name="external_activity"
                    value="{{ $mark->external_activity }}" required>
            </div>

            <!-- Recommendations -->
            <div class="form-group">
                <label for="recommendations">Recommendations</label>
                <textarea class="form-control" id="recommendations" name="recommendations"
                    rows="3">{{ $mark->recommendations }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Mark</button>
            <a href="{{ route('marks.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</div>

<br><br><br><br>

@endsection