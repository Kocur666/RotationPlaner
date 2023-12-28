<div

  class="m-0" >

  <div class="p-0 m-0" style="font-size: 12px;">
    <?php
    $persons=$events->whereIn('title', $area['title']) ?? "";
    ?>
    @foreach($persons as $singlePerson)
      @if ($absences->firstWhere('person', $singlePerson->person) != "")
        <div class="btn btn-danger" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; width:100%;"
        wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }},{{ $singlePerson->id }})"
        style="background-color: rgb(255, 255, 255)">{{ $day->format('d-m') }}-{{ $area['title']}}: ABSENCE {{$singlePerson->person}}
        </div>
      @else
        <div class="btn btn-success" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; width:100%;"
        wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }},{{ $singlePerson->id }})"
        style="background-color: rgb(255, 255, 255)">{{ $day->format('d-m') }}-{{ $area['title']}}: {{$singlePerson->person}}
        </div>
      @endif
    @endforeach

    @if($persons->count() == 0)
      <div class="btn btn-secondary" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; width:100%;"
      wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }}, '')"
      class="p-0 m-0" style="background-color: grey">{{ $day->format('d-m') }}-{{ $area['title'] ?? 'No description' }}</div>
    @endif
  </div>
</div>

