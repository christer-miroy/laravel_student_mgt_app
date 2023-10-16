@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Teachers Page</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title mt-2">Name : {{ $teachers->name }}</h5>
            <p class="card-text mt-2">Address : {{ $teachers->address }}</p>
            <p class="card-text mt-2">Mobile : {{ $teachers->mobile }}</p>
            <p class="card-text mt-2">Email : {{ $teachers->email }}</p>
        </div>
    </div>
</div>
@endsection