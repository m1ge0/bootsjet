{{-- @props(['submit'])

<div class="col-md-3 g-md-5">
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 mt-md-0 col-md-2">
        <form wire:submit="{{ $submit }}">
            <div class="py-5 bg-white shadow-md {{ isset($actions) ? 'rounded-top-3' : 'rounded-3' }}">
                <div class="col-6 g-5">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="d-flex algin-items-center justify-content-end px-4 py-3 bg-gray-50 text-end px-sm-5 shadow-sm rounded-bottom-3">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
 --}}

 @props(['submit'])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-4">
        <x-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">
                <span class="small">
                    {{ $description }}
                </span>
            </x-slot>
        </x-section-title>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <form wire:submit.prevent="{{ $submit }}">
                <div class="card-body">
                {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="card-footer d-flex justify-content-end">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
