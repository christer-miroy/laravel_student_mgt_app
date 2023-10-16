@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">New Payment</div>
    <div class="card-body">
        
        <form action="{{ url('payments') }}" method="post">
          {!! csrf_field() !!}
          <label class="mt-2">Payment Date</label>
          <input type="date" name="payment_date" id="payment_date" class="form-control mt-2" min="{{ date('Y-m-d') }}">
          <label class="mt-2">Amount</label>
          <input type="number" name="amount" id="amount" class="form-control mt-2" min="0" step="0.01">
          <label class="mt-2">Enrollment ID</label>
          <select name="enrollment_id" id="enrollment_id" class="form-control mt-2" >
            <option value="select_enrollmentId" disabled selected>Select Enrollment ID</option>
            @foreach($enrollments as $id => $enroll_no)
              <option value="{{ $id }}">{{ $enroll_no }}</option>
            @endforeach
          </select>
          
          <input type="submit" value="Save" class="btn btn-success mt-2">
      </form>
    </div>
</div>

@stop