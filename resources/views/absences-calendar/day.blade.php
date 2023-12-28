
<div
    {{-- ondragenter="onLivewireCalendarEventDragEnter(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragleave="onLivewireCalendarEventDragLeave(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragover="onLivewireCalendarEventDragOver(event);"
    ondrop="onLivewireCalendarEventDrop(event, '{{ $componentId }}', '{{ $day }}', {{ $day->year }}, {{ $day->month }}, {{ $day->day }}, '{{ $dragAndDropClasses }}');" --}}
    class="col-2 flex-1 h-40 lg:h-48 border border-gray-200 -mt-px -ml-px"
    style="flex: 1 1 0%; 	height-min: 20rem; min-width: 10rem;">

    {{-- Wrapper for Drag and Drop --}}
    <div
        class="w-full h-full" class="width: 100%; height: 100%;"
        id="{{ $componentId }}-{{ $day }}">

        <div
            @if($dayClickEnabled)
                wire:click="onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})"
            @endif
            class="w-full h-full p-2 {{ $dayInMonth ? $isToday ? 'bg-info' : ' bg-white ' : 'bg-light' }} flex flex-col" class="flex: 1 1 0%; flex-direction: column; width: 100%; height: 100%;">

            {{-- Number of Day --}}
            <div class="flex items-center" style="flex: 1 1 0%;">
                <p class="text-sm {{ $dayInMonth ? ' font-medium ' : '' }}">
                    {{ $day->format('j') }}
                </p>
                <p class="text-xs text-gray-600 ml-4">
                    {{-- @if($events->isNotEmpty())
                        {{ $events->count() }} {{ Str::plural('event', $events->count()) }}
                    @endif --}}
                </p>
            </div>
            {{-- Absences --}}


            <div class="p-1 my-1 row overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2" style="grid-template-columns: repeat(1, minmax(0, 1fr)); grid-auto-flow: row; gap: 0.5rem; ">
                    @foreach($absences as $absence)
                        <div>
                            @include($absenceView, [
                                'absence' => $absence,
                                'day' => $day,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Events --}}
            {{-- <div class="p-1 my-1 row overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2" style="grid-template-columns: repeat(1, minmax(0, 1fr)); grid-auto-flow: row; gap: 0.5rem; ">
                    @foreach($events as $event)
                        <div
                            @if($dragAndDropEnabled)
                                draggable="true"
                            @endif
                            ondragstart="onLivewireCalendarEventDragStart(event, '{{ $event['id'] }}')">
                            @include($eventView, [
                                'event' => $event,
                                'day' => $day,
                            ])
                        </div>
                    @endforeach
                </div>
            </div> --}}

        </div>
    </div>
</div>
