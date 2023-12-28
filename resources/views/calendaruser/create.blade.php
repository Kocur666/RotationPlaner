@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Add a calendarUser</h3>
      <form action="{{ route('calendaruser.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="title">Person</label>
          <input type="text" class="form-control" id="person" name="person" required>
        </div>
        {{-- <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
        </div> --}}
        <br>
        <button type="submit" class="btn btn-primary">Create Calendar User</button>
      </form>
    </div>
  </div>
</div>
@endsection
