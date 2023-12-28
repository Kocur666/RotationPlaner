@extends('layouts.app')

@section('content')
<div class="">
    <livewire:appointments-calendar
    calendar-view="appointments-calendar.calendar"
    event-view="appointments-calendar.event"
    day-of-week-view="appointments-calendar.day-of-week"
    day-view="appointments-calendar.day"
    area-view="appointments-calendar.area"
    absence-view="appointments-calendar.absence"
    />
</div>
@endsection
