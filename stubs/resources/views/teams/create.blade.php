<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold">
            {{ __('Create Team') }}
        </h2>
    </x-slot>

    <div>
        @livewire('teams.create-team-form')
    </div>
</x-app-layout>
