<?php

namespace App\Http\Livewire;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Areas;
use App\Models\Absences;
use App\Models\CalendarUsers;
use App\Models\Events;

class AbsencesCalendar extends LivewireCalendar
{
    public $startsAt;
    public $endsAt;

    public $gridStartsAt;
    public $gridEndsAt;

    public $weekStartsAt;
    public $weekEndsAt;

    public $calendarView;
    public $dayView;
    public $eventView;
    public $areaView;
    public $absenceView;
    public $dayOfWeekView;

    public $dragAndDropClasses;

    public $beforeCalendarView;
    public $afterCalendarView;

    public $pollMillis;
    public $pollAction;

    public $dragAndDropEnabled;
    public $dayClickEnabled;
    public $eventClickEnabled;

    protected $casts = [
        'startsAt' => 'date',
        'endsAt' => 'date',
        'gridStartsAt' => 'date',
        'gridEndsAt' => 'date',
    ];
    public function mount($initialYear = null,
                          $initialMonth = null,
                          $weekStartsAt = null,
                          $calendarView = null,
                          $dayView = null,
                          $eventView = null,
                          $absenceView = null,
                          $dayOfWeekView = null,
                          $dragAndDropClasses = null,
                          $beforeCalendarView = null,
                          $afterCalendarView = null,
                          $pollMillis = null,
                          $pollAction = null,
                          $dragAndDropEnabled = true,
                          $dayClickEnabled = true,
                          $eventClickEnabled = true,
                          $extras = [])
    {
        $this->weekStartsAt = $weekStartsAt ?? Carbon::MONDAY;
        $this->weekEndsAt = $this->weekStartsAt == Carbon::MONDAY
            ? Carbon::SUNDAY
            : collect([0,1,2,3,4,5,6])->get($this->weekStartsAt + 6 - 7)
        ;

        $initialYear = $initialYear ?? Carbon::today()->year;
        $initialMonth = $initialMonth ?? Carbon::today()->month;

        $this->startsAt = Carbon::createFromDate($initialYear, $initialMonth, 1)->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();

        $this->setupViews($calendarView, $dayView, $eventView, $absenceView, $dayOfWeekView, $beforeCalendarView, $afterCalendarView);

        $this->setupPoll($pollMillis, $pollAction);

        $this->dragAndDropEnabled = $dragAndDropEnabled;
        $this->dragAndDropClasses = $dragAndDropClasses ?? 'border border-blue-400 border-4';

        $this->dayClickEnabled = $dayClickEnabled;
        $this->eventClickEnabled = $eventClickEnabled;

        $this->afterMount($extras);
    }

    public function updateMonth()
    {

    }
    public function setupViews($calendarView = null,
                                $dayView = null,
                                $eventView = null,
                                $areaView = null,
                                $absenceView = null,
                                $dayOfWeekView = null,
                                $beforeCalendarView = null,
                                $afterCalendarView = null)
    {
        $this->calendarView = 'absences-calendar.calendar';
        $this->dayView = 'absences-calendar.day';
        $this->absenceView = 'absences-calendar.absence';
        $this->dayOfWeekView = 'absences-calendar.day-of-week';

        $this->beforeCalendarView = $beforeCalendarView ?? null;
        $this->afterCalendarView = $afterCalendarView ?? null;
    }

    public function absences() : Collection
    {
        $absences = Absences::all();
        return collect($absences);
    }
    public function getAbsencesForDay($day, Collection $absences) : Collection
    {

        return $absences
            ->filter(function ($absence) use ($day) {
                return Carbon::parse($absence['date'])->isSameDay($day);
            });
    }

    public function  onAbsenceClick($absenceId){
        $currentAbsence = Absences::where('id', $absenceId)->delete();
        // dd($currentAbsence);
    }

    public function render()
    {
        $events = $this->events();
        $absences  = $this->absences();

        return view($this->calendarView)
            ->with([
                'componentId' => $this->__id,
                'monthGrid' => $this->monthGrid(),
                'events' => $events,
                'absences' => $absences,
                'getEventsForDay' => function ($day) use ($events) {
                    return $this->getEventsForDay($day, $events);
                },
                'getAbsencesForDay' => function ($day) use ($absences) {
                    return $this->getAbsencesForDay($day, $absences);
                },
            ]);
    }
}
