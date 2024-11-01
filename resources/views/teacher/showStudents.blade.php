@extends('layouts.teacherlayout');



@section('content')
<div class="content">



    <!-- Check for error messages -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <h1>Students Enrolled in {{ $subject->name }}</h1>
    <ul>
        @foreach($students as $student)
        <li>
            (Student ID: {{ $student->student_id }}) {{ $student->user->name }}
            <a href="{{ route('teacher.viewStudentMarks', $student->id) }}">View Marks</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection