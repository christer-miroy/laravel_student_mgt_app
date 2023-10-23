@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit Batch</div>
  <div class="card-body">
      
      <form action="{{ url('batches/' .$batches->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$batches->id}}" id="id" />
        <label class="mt-2">Name</label>
        <input type="text" name="name" id="name" value="{{$batches->name}}" class="form-control">
        <label class="mt-2">Course</label>
        {{-- <input type="text" name="course_id" id="course_id" value="{{$batches->course_id}}" class="form-control"> --}}
        <select name="course_id" id="course_id" class="form-control" >
          <option value="select_course" disabled selected>Select Course</option>
          @if($courses)
            @foreach($courses as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          @endif
        </select>
        <label class="mt-2">Start Date</label>
        <input type="date" name="start_date" id="start_date" value="{{$batches->start_date}}" class="form-control" min="{{ date('Y-m-d') }}">
        <input type="submit" value="Update" class="btn btn-success mt-2">
        @error('duplicate')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </form>
   
  </div>
</div>
 
@stop