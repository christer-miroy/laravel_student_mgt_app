@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">View Payment</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title mt-2">Enrollment ID : {{ $payments->enrollment->enroll_no }}</h5>
            <p class="card-text mt-2">Payment Date : {{ $payments->payment_date }}</p>
            <p class="card-text mt-2">Amount : PHP {{ $payments->amount }}</p>
        </div>
    </div>
</div>
@endsection