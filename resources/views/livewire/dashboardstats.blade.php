<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {
        return [
            'notesSentCount' => Auth::user()->notes()->where('send_date', '<', now())->where('is_Published', true)->count(),

            'notesLovedCount' => Auth::user()->notes()->sum('heart_count'),
        ];
    }
}; ?>

<div>
    <h2>{{$notesSentCount}}</h2>
    <h2>{{$notesLovedCount}}</h2>
</div>
