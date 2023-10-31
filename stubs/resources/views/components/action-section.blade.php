{{-- <div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 mt-md-0 col-md-2">
        <div class="px-4 py-5 p-sm-5 bg-white shadow rounded-lg">
            {{ $content }}
        </div>
    </div>
</div> --}}


<div class="row">
    <div class="col-md-4">
        <x-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-section-title>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
