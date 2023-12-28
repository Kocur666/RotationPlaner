@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Add a event</h3>
      <form action="{{ route('event.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="person">Person:</label>
          <select id="person" name="person" class="form-control input-lg dynamic" data-dependent="state">
          {{-- <input type="text" class="form-control" id="person" name="person" required> --}}
          @foreach($calendarusers as $key => $calendaruser)
          <option value="{{$calendaruser}}">{{$calendaruser}} </option>
          @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="title">Area: </label>
            <select id="title" name="title" class="form-control input-lg dynamic" data-dependent="state">
            {{-- <input type="text" class="form-control" id="person" name="person" required> --}}
            @foreach($areas as $key => $area)
            <option value="{{$area}}">{{$area}} </option>
            @endforeach
            </select>
        </div>
            <div class="mb-3 my-5 row">
                <label for="join"
                    class="col-md-4 col-form-label text-md-end">{{ __('Date of event:') }}</label>

                <div class="col-md-8">
                    <input type="datetime-local" class="form-control" name="date">
                </div>
                <div>
                  <input type="checkbox" id="week" name="week" />
                  <label for="week">Set for week</label>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary my-5">Create event</button>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush
@endsection
