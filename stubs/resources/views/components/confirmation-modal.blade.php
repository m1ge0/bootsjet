{{-- @props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white px-4 pt-5 pb-4">
        <div class="d-sm-flex align-items-sm-start">
            <div class="mx-auto flex-shrink-0 d-flex algin-items-center justifycontent-center rounded-pill bg-red-100">
                <svg class="h-6 w-6 text-red-600" height="1.5rem" width="1.5rem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>

            <div class="mt-3 text-center mt-sm-0 ml-sm-4 text-sm-start">
                <h3 class="fs-3 fw-medium text-gray-900">
                    {{ $title }}
                </h3>

                <div class="mt-4 fs-5 text-gray-600">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-end px-5 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
 --}}


@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex justify-content-start">
                <div class="me-3">
                    <div class="bg-warning p-2 rounded-circle">
                        <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" width="24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h5 class="font-weight-bold">{{ $title }}</h5>
                    {{ $content }}
                </div>
            </div>
        </div>
        <div class="modal-footer bg-light">
            {{ $footer }}
        </div>
    </div>
</x-modal>
