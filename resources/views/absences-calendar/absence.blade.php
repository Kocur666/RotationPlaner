<div wire:click="onAbsenceClick({{ $absence }},{{ $day->year }},{{ $day->month }},{{ $day->day }})"
class="pm-0 border shadow-md " >

    <p class="p-0 m-0" style="color:red; font-size: 12px;">
        Absence: {{ $absence['person'] ?? 'No description' }}
    </p>
</div>
