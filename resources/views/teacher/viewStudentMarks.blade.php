@extends('layouts.teacherlayout')

@section('content')
<div class="content">
    <div class="container mt-4">
        <h2 class="mb-4">Marks for Student</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Predicted Marks</th>
                        <th>Final Grade</th>
                        <th>Present Count</th>
                        <th>Absent Count</th>
                        <th>Class Test 1</th>
                        <th>Lab Test 1</th>
                        <th>Mid Mark</th>
                        <th>Class Test 2</th>
                        <th>Lab Test 2</th>
                        <th>Assig</th>
                        <th>External Activity</th>
                        <th>Reco</th>
                        <th>Actions</th> <!-- New Actions Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($marks as $mark)
                    <tr>
                        <td>{{ $mark->subject_name }}</td>
                        <td>{{ $mark->predicted_marks }}</td>
                        <td>{{ $mark->final_grade }}</td>
                        <td>{{ $mark->present_count }}</td>
                        <td>{{ $mark->absent_count }}</td>
                        <td>{{ $mark->classTest_1 }}</td>
                        <td>{{ $mark->lab_test_1 }}</td>
                        <td>{{ $mark->mid_mark }}</td>
                        <td>{{ $mark->classTest_2 }}</td>
                        <td>{{ $mark->lab_test_2 }}</td>
                        <td>{{ $mark->assignment }}</td>
                        <td>{{ $mark->external_activity }}</td>
                        <td>{{ $mark->recommendations }}</td>
                        <td>
                            <!-- Update Mark Button -->
                            <a href="{{ route('marks.edit', $mark->id) }}" class="btn btn-warning btn-sm">Update
                                Mark</a>
                            <!-- Placeholder for Predict Mark Button -->
                            <button class="btn btn-info btn-sm">Predict Mark</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection