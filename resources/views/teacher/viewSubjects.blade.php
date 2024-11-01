@extends('layouts.teacherlayout');


@section('content')

<div class="content">

    <div class="container">
        <h1 class="mb-4">My Subjects</h1>

        @if ($subjects->isEmpty())
        <div class="alert alert-warning" role="alert">
            You have not been assigned any subjects yet.
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>
                                <a href="{{ route('teacher.viewStudentDetails', $subject->id) }}"
                                    class="btn btn-info btn-sm">
                                    View Students
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>


@endsection