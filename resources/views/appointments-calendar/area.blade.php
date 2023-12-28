<div

  class="m-0 border" >

  <div class="p-0 m-0" style="font-size: 12px;">
    <?php
    $persons=$events->whereIn('title', $area['title']) ?? "";
    ?>
    @foreach($persons as $singlePerson)
      @if ($absences->firstWhere('person', $singlePerson->person) != "")
        <div wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }},{{ $singlePerson->id }})"
        style="background-color: red">{{ $day->format('d-m') }}-{{ $area['title']}}: ABSENCE {{$singlePerson->person}}
        </div>
      @else
        <div wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }},{{ $singlePerson->id }})"
        style="background-color: green">{{ $day->format('d-m') }}-{{ $area['title']}}: {{$singlePerson->person}}
        </div>
      @endif
    @endforeach

    @if($persons->count() == 0)
      <div wire:click="onAreaClick({{ $area }},{{ $day->year }},{{ $day->month }},{{ $day->day }}, '')"
      class="p-0 m-0" style="background-color: grey">{{ $day->format('d-m') }}-{{ $area['title'] ?? 'No description' }}</div>
    @endif
  </div>
</div>

