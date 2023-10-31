@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus-ring form-control bg-white rounded-2 shadow-sm']) !!}>
