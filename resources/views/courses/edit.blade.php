@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit Course</div>
  <div class="card-body">
      
      <form action="{{ url('courses/' .$courses->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$courses->id}}" id="id" />
        <label class="mt-2">Name</label>
        <input type="text" name="name" id="name" value="{{$courses->name}}" class="form-control">
        @error('name')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        <label class="mt-2">Syllabus</label>
        <input type="text" name="syllabus" id="syllabus" value="{{$courses->syllabus}}" class="form-control">
        @error('syllabus')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        <label class="mt-2">Duration</label>
        <input type="text" name="duration" id="duration" value="{{$courses->duration}}" class="form-control">
        @error('duration')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Teacher</label>
          <select name="teacher_id" id="teacher_id" class="form-control mt-2">
            <option value="select_teacher" disabled selected>Select Teacher</option>
            @foreach($teachers as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select>
          @error('teacher_id')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        <input type="submit" value="Update" class="btn btn-success mt-2">
    </form>
   
  </div>
</div>
 
@stop