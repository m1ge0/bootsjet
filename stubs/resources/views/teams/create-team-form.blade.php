<div class="container mx-auto py-5 px-sm-5 px-lg-5">
    <x-form-section submit="createTeam">
        <x-slot name="title">
            {{ __('Team Details') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Create a new team to collaborate with others on projects.') }}
        </x-slot>

        <x-slot name="form">
            <div class="mb-3">
                <x-label value="{{ __('Team Owner') }}" />

                <div class="d-flex mt-2">
                    <img class="rounded-circle" width="48" src="{{ $this->user->profile_photo_url }}">

                    <div class="ms-2">
                        <div>{{ $this->user->name }}</div>
                        <div class="text-muted">{{ $this->user->email }}</div>
                    </div>
                </div>
            </div>

            <div class="w-md-75">
                <div class="mb-3">
                    <x-label for="name" value="{{ __('Team Name') }}" />
                    <x-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                 wire:model.defer="state.name" autofocus />
                    <x-input-error for="name" />
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button>
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>    
</div>

