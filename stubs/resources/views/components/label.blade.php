@props(['value'])

<label {{ $attributes->merge(['class' => 'd-block']) }}>
    {{ $value ?? $slot }}
</label>
