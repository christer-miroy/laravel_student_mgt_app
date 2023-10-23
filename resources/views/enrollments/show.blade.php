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
            <p class="card-text mt-2">Status : <b class="{{ $enrollments->status == 'unpaid' ? 'text-danger' : 'text-success' }} text-uppercase">{{ $enrollments->status }}</b></p>
        </div>
    </div>
</div>
@endsection