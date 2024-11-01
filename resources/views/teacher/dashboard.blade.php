@extends('layouts.teacherlayout')

@section('content')
<div class="content">
    <!-- Session Message Display -->
    @if (session('message'))
    <div id="successMessage" class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <h1>Welcome to the Teacher Dashboard</h1>
</div>
@endsection