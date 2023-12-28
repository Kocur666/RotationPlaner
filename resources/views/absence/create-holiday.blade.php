@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Add a holiday(absence) for everyone</h3>
      <form action="{{ route('absence.store-holiday') }}" method="post">
        @csrf
        <div class="form-group">
          </select>
        </div>
            <div class="mb-3 my-5 row">
                <label for="join"
                    class="col-md-4 col-form-label text-md-end">{{ __('Date of absence') }}</label>

                <div class="col-md-6">
                    <input type="datetime-local" class="form-control" name="date">
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary my-5">Create Holiday</button>
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
