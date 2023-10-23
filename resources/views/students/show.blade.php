@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Students Page</div>
    <div class="card-body">
        @if($students)
            <div class="card-body">
                <h5 class="card-title mt-2">Name : {{ $students->name }}</h5>
                <p class="card-text mt-2">Address : {{ $students->address }}</p>
                <p class="card-text mt-2">Mobile : {{ $students->mobile }}</p>
                <p class="card-text mt-2">Email : {{ $students->email }}</p>
            </div>
        @else
            <p>No student found</p>
        @endif
    </div>
</div>
@endsection