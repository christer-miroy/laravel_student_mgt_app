@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Batches Page</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title mt-2">Name : {{ $batches->name }}</h5>
            <p class="card-text mt-2">Course : {{ $batches->course->name }}</p>
            <p class="card-text mt-2">Start Date : {{ $batches->start_date }}</p>
        </div>
    </div>
</div>
@endsection