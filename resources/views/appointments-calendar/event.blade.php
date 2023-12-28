<div class="btn btn-outline-dark" style="margin-top: 2px; --bs-btn-padding-y: .15rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .75rem; width:100%;"
        wire:click="onEventClick('{{ $event['id']  }}')"
        wire:confirm="Are you sure you want to delete Assigment for {{$event['person']}}?"
    class="pm-0 border shadow-md " >

    <p class="p-0 m-0" style="font-size: 12px;">

        {{ $event['title'] }} / {{ $event['person'] ?? 'No description' }}
    </p>
</div>
