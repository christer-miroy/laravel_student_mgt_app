@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Edit Student Data</div>
  <div class="card-body">
      
      <form action="{{ url('students/' .$students->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$students->id}}" />
        <label class="mt-2">Name</label>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="text" name="name" id="name" value="{{$students->name}}" class="form-control">

        <label class="mt-2">Address</label>
        @error('address')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="text" name="address" id="address" value="{{$students->address}}" class="form-control">
        <label class="mt-2">Mobile (xxxx-xxx-xxxx)</label>
        <input type="tel" name="mobile" id="mobile" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" value="{{$students->mobile}}" class="form-control">
        @error('mobile')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        <label class="mt-2">Email</label>
        <input type="email" name="email" id="email" value="{{$students->email}}" class="form-control">
        @error('email')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        <input type="submit" value="Update" class="btn btn-success mt-2">
    </form>
   
  </div>
</div>
 
@stop