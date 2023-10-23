@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">New Batch</div>
    <div class="card-body">
        
        <form action="{{ url('batches') }}" method="post">
          {!! csrf_field() !!}
          <label class="mt-2">Batch Name</label>
          <input type="text" name="name" id="name" class="form-control mt-2">
          <label class="mt-2">Course</label>
          {{-- <input type="text" name="course_id" id="course_id" class="form-control mt-2"> --}}
          <select name="course_id" id="course_id" class="form-control mt-2" >
            <option value="select_course" disabled selected>Select Course</option>
            @foreach($courses as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select>
          <label class="mt-2">Start Date</label>
          <input type="date" name="start_date" id="start_date" class="form-control mt-2" min="{{ date('Y-m-d') }}">
          <input type="submit" value="Save" class="btn btn-success mt-2">
          @error('duplicate')
            <div style="color: red;">{{ $message }}</div>
          @enderror
      </form>
    </div>
</div>

@stop