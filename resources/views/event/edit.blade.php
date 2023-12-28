@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Update Calendar User</h3>
        <form action="{{ route('event.update', $event->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Person</label>
            <input type="text" class="form-control" id="person" name="person"
              value="{{ $event->person }}" required>
          </div>
          <div class="form-group">
            <label for="body">Date</label>
            <textarea class="form-control" id="date" name="date" rows="1" required>{{ $event->date }}</textarea>
          </div>
          <button type="submit" class="btn mt-3 btn-primary">Update Calendar User</button>
        </form>
      </div>
    </div>
  </div>
  @endsection
