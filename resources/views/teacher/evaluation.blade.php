@extends('layouts.teacherlayout')

@section('content')


<div class="content">
    <h1>Select the Subject to Evaluate</h1>
    <ul>
        @foreach($subjects as $subject)
        <li>
            <a href="{{ route('teacher.showStudents', $subject->id) }}">{{ $subject->name }}</a>
        </li>
        @endforeach
    </ul>
</div>

@endsection