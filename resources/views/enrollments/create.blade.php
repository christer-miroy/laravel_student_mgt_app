@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">Add Enrollment</div>
    <div class="card-body">
        
        <form action="{{ url('enrollments') }}" method="post">
          {!! csrf_field() !!}
          <label class="mt-2">Enrollment Number</label>
          <input type="text" name="enroll_no" id="enroll_no" class="form-control mt-2">
          <label class="mt-2">Batch</label>
          {{-- <input type="text" name="batch_id" id="batch_id" class="form-control mt-2"> --}}
          <select name="batch_id" id="batch_id" class="form-control mt-2" >
            <option value="select_Batch" disabled selected>Select Batch</option>
            @foreach($batches as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select>
          <label class="mt-2">Student Name</label>
          {{-- <input type="text" name="student_id" id="student_id" class="form-control mt-2"> --}}
          <select name="student_id" id="student_id" class="form-control mt-2" >
            <option value="select_student" disabled selected>Select Student</option>
            @foreach($students as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select>
          <label class="mt-2">Join Date</label>
          <input type="date" name="join_date" id="join_date" class="form-control mt-2" min="{{ date('Y-m-d') }}">
          <label class="mt-2">Fee</label>
          <input type="text" name="fee" id="fee" class="form-control mt-2">
          <input type="submit" value="Save" class="btn btn-success mt-2">
          @error('duplicate')
            <div style="color: red;">{{ $message }}</div>
          @enderror
      </form>
    </div>
</div>

@stop