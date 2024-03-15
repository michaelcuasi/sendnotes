<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

    public function delete($noteId) {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }

    public function with(): array {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">
                    No Notes yet
                </p>
                <p class="text-sm">
                    Let's create your first note to send.
                </p>
                 <x-button primary icon-right="plus" class="mt-2" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
            </div>
        @else
            <x-button primary icon-right="plus" class="mt-2" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
            <div class="grid grid-cols-3 gap-4 border-solid border-2">
                @foreach ($notes as $note)
                    <x-card wire:key='{{$note->id}}' class="mt-6">
                        <div class="flex justify-between">
                            <div class="border-solid border-2">
                                <a href="{{route('notes.edit-note', $note)}}" class="text-l font-bold hover:underline hover:text-blue-500" wire:navigate>
                                {{$note->title}}
                                </a>
                                <p class="text-xs mt-2">
                                    {{Str::limit($note->body, 100)}}
                                </p>
                            </div>
                            <div class="text-xs text-black border-solid border-2">
                                {{\Carbon\Carbon::parse($note->send_date)->format('M-d-Y')}}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">
                                Recipient: 
                                <span class="font-semibold">
                                    {{$note->recipient}}
                                </span>
                            </p>
                        <div>
                            <x-button.circle icon="eye"></x-button>
                            <x-button.circle wire:click="delete('{{$note->id}}')" icon="trash"></x-button>
                        </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
