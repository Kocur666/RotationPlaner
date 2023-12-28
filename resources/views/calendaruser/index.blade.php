@extends('layouts.app')
@section('content')
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('calendaruser.index') }}>CRUD Calendar User</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('calendaruser.create') }}>Add Calendar User</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-5">
    <div class="row">
      @foreach ($calendarusers as $calendaruser)
        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">{{ $calendaruser->person }}</h5>
            </div>
            {{-- <div class="card-body">
              <p class="card-text">{{ $calendaruser->body }}</p>
            </div> --}}
            <div class="card-footer">
              <div class="row">
                <div class="col-sm p-1">
                  <a href="{{ route('calendaruser.edit', $calendaruser->id) }}"
            class="btn btn-primary btn-sm">Edit</a>
                </div>
                <div class="col-sm p-1">
                    <form action="{{ route('calendaruser.destroy', $calendaruser->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @endsection
