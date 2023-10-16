@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit Enrollment</div>
  <div class="card-body">
      
      <form action="{{ url('enrollments/' .$enrollments->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$enrollments->id}}" id="id" />
        <label class="mt-2">Enrollment Number</label>
        <input type="text" name="enroll_no" id="enroll_no" class="form-control mt-2" value="{{ $enrollments->enroll_no }}" disabled>
        <label class="mt-2">Batch</label>
        {{-- <input type="text" name="batch_id" id="batch_id" class="form-control mt-2" value="{{ $enrollments->batch_id }}"> --}}
        <select name="batch_id" id="batch_id" class="form-control mt-2" >
          <option value="select_batch" disabled selected>Select Batch</option>
          @if($batches)
            @foreach($batches as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          @endif
        </select>
        <label class="mt-2">Student Name</label>
        {{-- <input type="text" name="student_id" id="student_id" class="form-control mt-2" value="{{ $enrollments->student_id }}"> --}}
        <select name="student_id" id="student_id" class="form-control mt-2" >
          <option value="select_student" disabled selected>Select Student</option>
          @if($students)
            @foreach($students as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          @endif
        </select>
        <label class="mt-2">Join Date</label>
        <input type="date" name="join_date" id="join_date" class="form-control mt-2" value="{{ $enrollments->join_date }}">
        <label class="mt-2">Fee</label>
        <input type="text" name="fee" id="fee" class="form-control mt-2" value="{{ $enrollments->fee }}">
        <input type="submit" value="Save" class="btn btn-success mt-2">
    </form>
   
  </div>
</div>
 
@stop