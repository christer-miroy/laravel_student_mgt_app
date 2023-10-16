@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">Courses Page</div>
    <div class="card-body">
        
        <form action="{{ url('courses') }}" method="post">
          {!! csrf_field() !!}
          <label class="mt-2">Name</label>
          <input type="text" name="name" id="name" class="form-control mt-2">
          @error('name')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Syllabus</label>
          <input type="text" name="syllabus" id="syllabus" class="form-control mt-2">
          @error('syllabus')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Duration</label>
          <input type="text" name="duration" id="duration" class="form-control mt-2">
          @error('duration')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Teacher</label>
          {{-- <input type="text" name="duration" id="duration" class="form-control mt-2"> --}}
          <select name="teacher_id" id="teacher_id" class="form-control mt-2" >
            <option value="select_teacher" disabled selected>Select Teacher</option>
            @foreach($teachers as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select>
          @error('teacher_id')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <input type="submit" value="Save" class="btn btn-success mt-2">
      </form>
    </div>
</div>

@stop