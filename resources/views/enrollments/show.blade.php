@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Enrollment Page</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title mt-2">Enrollment Number : {{ $enrollments->enroll_no }}</h5>
            <p class="card-text mt-2">Batch ID : {{ $enrollments->batch_id }}</p>
            <p class="card-text mt-2">Student ID : {{ $enrollments->student_id }}</p>
            <p class="card-text mt-2">Join Date : {{ $enrollments->join_date }}</p>
            <p class="card-text mt-2">Fee : {{ $enrollments->fee }}</p>
        </div>
    </div>
</div>
@endsection