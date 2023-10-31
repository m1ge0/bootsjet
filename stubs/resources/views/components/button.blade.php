<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-dark inline-flex algin-items-center px-4 py-2 border rounded-3 font-semibold fw-bold text-uppercase']) }}>
    {{ $slot }}
</button>
