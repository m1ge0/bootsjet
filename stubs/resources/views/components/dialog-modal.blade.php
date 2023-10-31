{{-- @props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-5 py-4">
        <div class="fs-3 fw-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-4 fs-3 text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="d-flex flex-row justify-content-end px-5 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal> --}}

@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $content }}
        </div>
        <div class="modal-footer">
            {{ $footer }}
        </div>
    </div>
</x-modal>