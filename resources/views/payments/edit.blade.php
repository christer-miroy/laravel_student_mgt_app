@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit Payment</div>
  <div class="card-body">
      
      <form action="{{ url('payments/' .$payments->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$payments->id}}" id="id" />
        <label class="mt-2">Payment Date</label>
        <input type="date" name="payment_date" id="payment_date" value="{{$payments->payment_date}}" class="form-control" min="{{ date('Y-m-d') }}">
        <label class="mt-2">Amount</label>
        <input type="number" name="amount" id="amount" value="{{number_format($payments->amount, 2, '.',',')}}" class="form-control" min="0" step="0.01">
        <label class="mt-2">Enrollment ID</label>
        <select name="enrollment_id" id="enrollment_id" class="form-control" disabled>
          <option value="select_enrollmentId" disabled selected>{{ $payments->enrollment->enroll_no }}</option>
          @if($enrollments)
            @foreach($enrollments as $id => $enroll_no)
              <option value="{{ $id }}">{{ $enroll_no }}</option>
            @endforeach
          @endif
        </select>
        <input type="submit" value="Update" class="btn btn-success mt-2">
    </form>
   
  </div>
</div>
 
@stop