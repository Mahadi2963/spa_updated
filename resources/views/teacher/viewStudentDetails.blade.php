@extends('layouts.teacherlayout');


@section('content')

<div class="content">

    <div class="container">
        <h1>Students for Subject: {{ $subject->name }}</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection