@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">Teachers Page</div>
    <div class="card-body">
        
        <form action="{{ url('teachers') }}" method="post">
          {!! csrf_field() !!}
          <label class="mt-2">Name</label>
          <input type="text" name="name" id="name" class="form-control mt-2">
          @error('name')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Address</label>
          <input type="text" name="address" id="address" class="form-control mt-2">
          @error('address')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Mobile (xxxx-xxx-xxxx)</label>
          <input type="tel" name="mobile" id="mobile" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" class="form-control mt-2">
          @error('mobile')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <label class="mt-2">Email</label>
          <input type="email" name="email" id="email" class="form-control mt-2">
          @error('email')
            <div style="color: red;">{{ $message }}</div>
          @enderror
          <input type="submit" value="Save" class="btn btn-success mt-2">
      </form>
    </div>
</div>

@stop