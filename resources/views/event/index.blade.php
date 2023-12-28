@extends('layouts.app')
@section('content')
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('event.index') }}>CRUD Calendar events</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('event.create') }}>Add event</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-5">
    <div class="row">
      @foreach ($events as $event)
        <div class="col-sm">
          <div class="card  p-0">
            <div class="card-header">
              <p class="card-title">{{ $event->person }}</p>
            </div>
            <div class="card-body">
            <p class="card-text">{{ $event->date }}: <b>{{ $event->title }}</b></p>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm p-1">
                  <a href="{{ route('event.edit', $event->id) }}"
                    class="btn btn-primary btn-sm">Edit</a>
                </div>
                <div class="col-sm p-1">
                    <form action="{{ route('event.destroy', $event->id) }}" method="post">
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
