<div
    {{-- ondragenter="onLivewireCalendarEventDragEnter(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragleave="onLivewireCalendarEventDragLeave(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragover="onLivewireCalendarEventDragOver(event);"
    ondrop="onLivewireCalendarEventDrop(event, '{{ $componentId }}', '{{ $day }}', {{ $day->year }}, {{ $day->month }}, {{ $day->day }}, '{{ $dragAndDropClasses }}');" --}}
    class="border"
    style="flex: 1 1 0%; height-min: 20rem; min-width: 1rem;">
    @inject('carbon', \Carbon\Carbon::class)
    {{-- Wrapper for Drag and Drop --}}
    <div
        class="" class="width: 100%; height: 100%;"
        id="{{ $componentId }}-{{ $day }}">

        <div
            class="p-2 {{ $dayInMonth ? $isToday ? 'bg-info' : ' bg-white ' : 'bg-light' }}" class="flex: 1 1 0%; flex-direction: column; width: 100%; height: 100%;">

            {{-- Number of Day --}}
            <div class="" style="display: flex; flex: 1 1 0%; flex-direction: row; justify-content:space-around;">
                <div>
                    <b>{{ $day->format('j-m-Y') }}</b>
                </div>
                    <button
                    wire:click.stop="onDayCopyClick('{{ $day }}')"
                    wire:confirm="Are you sure you want to copy all Assigments to Next day?"
                    class="btn btn-outline-secondary" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem;">
                        copy to next day

                    </button>
            </div>

            {{-- Absences --}}
            <?php $carbon = $day->dayOfWeek; ?>
            @if($carbon > 5 or $carbon < 1)
            @else
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
            @endif
            {{-- Areas --}}

            @if($carbon > 5 or $carbon < 1)
            @else
            <div class="p-1 my-1 row overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2" style="grid-template-columns: repeat(1, minmax(0, 1fr)); grid-auto-flow: row; gap: 0.5rem; " >
                    @foreach($areas as $area)
                        <div
                        {{-- draggable="true" ondragstart="onLivewireCalendarAreaDragStart(area, '{{ $area['id'] }}')" --}}
                        >
                            @include($areaView, [
                                'area' => $area,
                                'events' => $events,
                                'absences' => $absences,
                                'day' => $day,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Events --}}
            {{-- @if($carbon > 5 or $carbon < 1)
            @else --}}
            <div class="p-1 my-1 row overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2" style="grid-template-columns: repeat(1, minmax(0, 1fr)); grid-auto-flow: row; gap: 0.5rem; ">
                    @foreach($events as $event)
                        <div
                            {{-- @if($dragAndDropEnabled)
                                draggable="true"
                            @endif --}}
                            {{-- ondragstart="onLivewireCalendarEventDragStart(event, '{{ $event['id'] }}')" --}}
                            >
                            @include($eventView, [
                                'event' => $event,
                                'day' => $day,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- @endif --}}

        </div>
    </div>
</div>
