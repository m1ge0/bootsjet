<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Team Settings') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-5 px-sm-5 px-lg-5">
        @livewire('teams.update-team-name-form', ['team' => $team])

        @livewire('teams.team-member-manager', ['team' => $team])

        @if (Gate::check('delete', $team) && ! $team->personal_team)
            <x-section-border />

            <div>
                @livewire('teams.delete-team-form', ['team' => $team])
            </div>
        @endif
    </div>
</x-app-layout>
