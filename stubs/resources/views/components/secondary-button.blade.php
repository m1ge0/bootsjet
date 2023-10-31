<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-danger text-uppercase']) }}>
    {{ $slot }}
</button>
