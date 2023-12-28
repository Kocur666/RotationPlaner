<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    class="pm-0 border shadow-md " >

    <p class="p-0 m-0" style="font-size: 12px;">

        {{ $event['title'] }} / {{ $event['person'] ?? 'No description' }}
    </p>
</div>
