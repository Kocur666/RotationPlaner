@extends('layouts.app')

@section('content')
<div class="">
    <livewire:absences-calendar
    calendar-view="absences-calendar.calendar"
    event-view="absences-calendar.event"
    day-of-week-view="absences-calendar.day-of-week"
    day-view="absences-calendar.day"
    area-view="absences-calendar.area"
    absence-view="absences-calendar.absence"
    />
</div>
@endsection
