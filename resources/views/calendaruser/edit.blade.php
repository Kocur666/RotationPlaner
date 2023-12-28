@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Update Calendar User</h3>
        <form action="{{ route('calendaruser.update', $calendaruser->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Person</label>
            <input type="text" class="form-control" id="person" name="person"
              value="{{ $calendaruser->person }}" required>
          </div>
          {{-- <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="body" rows="3" required>{{ $calendaruser->body }}</textarea>
          </div> --}}
          <button type="submit" class="btn mt-3 btn-primary">Update Calendar User</button>
        </form>
      </div>
    </div>
  </div>
  @endsection
