@props(['disabled' => false])

<input {{ $attributes->class(['form-control']) }} {{ $disabled ? 'disabled' : '' }}>
