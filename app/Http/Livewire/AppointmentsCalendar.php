<?php

namespace App\Http\Livewire;

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

class AppointmentsCalendar extends Component
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
                          $areaView = null,
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

        // $initialYear = $initialYear ?? Carbon::today()->year;
        // $initialMonth = $initialMonth ?? Carbon::today()->month;
        // $initialDay = $initialDay ?? Carbon::today()->day;


        // $this->startsAt = Carbon::createFromDate($initialYear, $initialMonth, $initialDay)->startOfDay();
        // $this->startsAt = Carbon::today();
        // $this->endsAt = $this->startsAt->clone()->endOfWeek()->startOfDay();
        // $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->startsAt = Carbon::today()->startOfWeek()->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfWeek()->startOfDay();
        $this->calculateGridStartsEnds();

        $this->setupViews($calendarView, $dayView, $eventView, $areaView, $absenceView, $dayOfWeekView, $beforeCalendarView, $afterCalendarView);

        $this->setupPoll($pollMillis, $pollAction);

        $this->dragAndDropEnabled = $dragAndDropEnabled;
        $this->dragAndDropClasses = $dragAndDropClasses ?? 'border border-blue-400 border-4';

        $this->dayClickEnabled = $dayClickEnabled;
        $this->eventClickEnabled = $eventClickEnabled;

        $this->afterMount($extras);
    }

    public function afterMount($extras = [])
    {
        //
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
        $this->calendarView = $calendarView ?? 'livewire-calendar::calendar';
        $this->dayView = $dayView ?? 'livewire-calendar::day';
        $this->eventView = $eventView ?? 'livewire-calendar::event';
        $this->areaView = $areaView ?? 'livewire-calendar::area';
        $this->absenceView = $absenceView ?? 'livewire-calendar::absence';
        $this->dayOfWeekView = $dayOfWeekView ?? 'livewire-calendar::day-of-week';

        $this->beforeCalendarView = $beforeCalendarView ?? null;
        $this->afterCalendarView = $afterCalendarView ?? null;
    }

    public function setupPoll($pollMillis, $pollAction)
    {
        $this->pollMillis = $pollMillis;
        $this->pollAction = $pollAction;
    }

    public function goToPreviousMonth()
    {
        $this->startsAt->subMonthNoOverflow();
        $this->endsAt->subMonthNoOverflow();

        $this->calculateGridStartsEnds();
    }

    public function goToNextMonth()
    {
        $this->startsAt->addMonthNoOverflow();
        $this->endsAt->addMonthNoOverflow();

        $this->calculateGridStartsEnds();
    }

    public function goToCurrentMonth()
    {
        $this->startsAt = Carbon::today()->startOfMonth()->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();
    }

    public function goToPreviousWeek()
    {
        $this->startsAt->subWeek();
        $this->endsAt->subWeek();

        $this->calculateGridStartsEnds();
    }

    public function goToNextWeek()
    {
        $this->startsAt->addWeek();
        $this->endsAt->addWeek();

        $this->calculateGridStartsEnds();
    }

    public function goToCurrentWeek()
    {
        $this->startsAt = Carbon::today()->startOfWeek()->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfWeek()->startOfDay();

        $this->calculateGridStartsEnds();
    }

    public function calculateGridStartsEnds()
    {
        $this->gridStartsAt = $this->startsAt->clone()->startOfWeek($this->weekStartsAt);
        $this->gridEndsAt = $this->endsAt->clone()->endOfWeek($this->weekEndsAt);
    }

    /**
     * @throws Exception
     */
    public function monthGrid()
    {
        $firstDayOfGrid = $this->gridStartsAt;
        $lastDayOfGrid = $this->gridEndsAt;

        $numbersOfWeeks = $lastDayOfGrid->diffInWeeks($firstDayOfGrid) + 1;
        $days = $lastDayOfGrid->diffInDays($firstDayOfGrid) + 1;

        if ($days % 7 != 0) {
            throw new Exception("Livewire Calendar not correctly configured. Check initial inputs.");
        }

        $monthGrid = collect();
        $currentDay = $firstDayOfGrid->clone();

        while(!$currentDay->greaterThan($lastDayOfGrid)) {
            $monthGrid->push($currentDay->clone());
            $currentDay->addDay();
        }

        $monthGrid = $monthGrid->chunk(7);
        if ($numbersOfWeeks != $monthGrid->count()) {
            throw new Exception("Livewire Calendar calculated wrong number of weeks. Sorry :(");
        }

        return $monthGrid;
    }

    public function events() : Collection
    {
        $events = Events::all();
        return collect($events);
    }

    public function areas() : Collection
    {
        $areas = Areas::all();
        return collect($areas);
    }

    public function absences() : Collection
    {
        $absences = Absences::all();
        return collect($absences);
    }

    public function getEventsForDay($day, Collection $events) : Collection
    {
        return $events
            ->filter(function ($event) use ($day) {
                return Carbon::parse($event['date'])->isSameDay($day);
            });
    }

    public function getAbsencesForDay($day, Collection $absences) : Collection
    {
        return $absences
            ->filter(function ($absence) use ($day) {
                return Carbon::parse($absence['date'])->isSameDay($day);
            });
    }

    public function onDayClick($year, $month, $day)
    {
        //
    }

    public function onEventClick($eventId)
    {
        $currentEvent = Events::where('id', $eventId)->delete();
    }
    public function onDayCopyClick($day)
    {
        // dd(Carbon::parse($day)->format('Y-m-j'));
        $EventsToCopy = Events::where('date', Carbon::parse($day)->format('Y-m-j'))->get();
        foreach($EventsToCopy as $event){
            $date = Carbon::parse($event->date)->addDay();
            $dateDay = $date->dayOfWeek;
            if($dateDay > 5 or $dateDay < 1){
                $date->addDay();
                $dateDay = $date->dayOfWeek;
                if($dateDay > 5 or $dateDay < 1){
                    $date->addDay();
                }
            }
            // dd($event);
            $newEvent = Events::create(['title'=> $event->title, 'person' => $event->person, 'date' => $date ]);
            // dd($date);
        }
        $this->dispatch('swal',[
            'title'=>'Success!',
            'text'=>'Data saved for next WORKING day',
            'icon'=>'success',
        ]);
        // dd($EventsToCopy);
        // $currentEvent = Events::where('id', $eventId)->delete();
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        //
    }

    public function onAreaClick($area, $year, $month, $day, $eventId)
    {
        $nextperson ="";
        $found=0;
        $calendarusers = CalendarUsers::all()->toArray();
        $date = $year."-".$month."-".$day." 00:00:00";
        $date = Carbon::parse($date);
        $events = Events::where('id', $eventId)->get();
        $person = $events['0']->person ?? null ;

        foreach($calendarusers as $key => $user){
            if($found == 1){
                $nextperson = $user['person'];
                break;
            }
            $nextperson = $user['person'];
            if($user['person'] == $person){
                $found = 1;
            }
            if ($key === array_key_last($calendarusers)) {
                $nextperson = $calendarusers[array_key_first($calendarusers)]['person'];
            }
        }

        $event = Events::updateOrCreate(
            ['date' => $date, 'title' => $area['title']],
            ['person' => $nextperson ]
        );
    }

    public function onAreaDropped($eventId, $year, $month, $day)
    {
        //
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function render()
    {
        $events = $this->events();
        $areas  = $this->areas();
        $absences  = $this->absences();

        return view($this->calendarView)
            ->with([
                'componentId' => $this->__id,
                'monthGrid' => $this->monthGrid(),
                'events' => $events,
                'areas' => $areas,
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
