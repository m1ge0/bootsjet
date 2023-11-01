<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-dark d-inline-flex algin-items-center justify-comtent-center px-4 py-2 bg-red-600 border border-0 rounded-3 font-semibold fw-bold fs-6 text-white text-uppercase']) }}>
    {{ $slot }}
</button>
