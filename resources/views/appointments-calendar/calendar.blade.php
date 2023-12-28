<div
    @if($pollMillis !== null && $pollAction !== null)
        wire:poll.{{ $pollMillis }}ms="{{ $pollAction }}"
    @elseif($pollMillis !== null)
        wire:poll.{{ $pollMillis }}ms
    @endif
>
    <div>
    <div>
        <button class="btn btn-sm btn btn-outline-secondary mx-2 col-1" wire:click="goToPreviousWeek">Previous</button>
        <button class="btn btn-sm btn btn-outline-secondary mx-2 col-1" wire:click="goToCurrentWeek">Current</button>
        <button class="btn btn-sm btn btn-outline-secondary mx-2 col-1" wire:click="goToNextWeek">Next</button>
        <div class="p-2 m-2" wire:poll="updateMonth"><b>{{$this->startsAt->format('M-Y')}} Week: {{$this->startsAt->week()}}</b></div>
        {{-- @dd($this) --}}
    </div>
        @includeIf($beforeCalendarView)
    </div>

    <div class="flex" style="flex: 1 1 0%; display: inline-block; min-width: 100%;">
        <div class="" style="overflow-y: auto; width: 100%;">
            <div class="" style="display: inline-block; 	min-width: 100%; overflow: hidden;">

                <div class="w-full flex" style="display: flex;  width: 100%; flex-direction: row;">
                    @foreach($monthGrid->first() as $day)
                        @include($dayOfWeekView, ['day' => $day])
                    @endforeach
                </div>

                @foreach($monthGrid as $week)
                    <div class="w-full flex" style="display: flex; width: 100%; flex-direction: row;">
                        @foreach($week as $day)
                            @include($dayView, [
                                    'componentId' => $componentId,
                                    'day' => $day,
                                    'dayInMonth' => $day->isSameMonth($startsAt),
                                    'isToday' => $day->isToday(),
                                    'events' => $getEventsForDay($day, $events),
                                    'absences' => $getAbsencesForDay($day, $absences),
                                ])
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        @includeIf($afterCalendarView)
    </div>
</div>
