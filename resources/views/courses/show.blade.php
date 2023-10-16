@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Courses Page</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title mt-2">Name : {{ $courses->name }}</h5>
            <p class="card-text mt-2">Syllabus : {{ $courses->syllabus }}</p>
            {{-- call duration() from Course Model --}}
            <p class="card-text mt-2">Duration : {{ $courses->duration() }}</p>
            <p class="card-text mt-2">Teacher : {{ $courses->teacher->name }}</p>
        </div>
    </div>
</div>
@endsection