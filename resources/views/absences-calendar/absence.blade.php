<button class="btn btn-danger" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; width:100%;"
type="button" wire:click="onAbsenceClick({{ $absence['id'] }})"
     wire:confirm="Are you sure you want to delete absence ?" >

    <p class="p-0 m-0" style="color:rgb(255, 255, 255); font-size: 12px;">
        Absence: {{ $absence['person'] ?? 'No description' }}
    </p>
</button>
