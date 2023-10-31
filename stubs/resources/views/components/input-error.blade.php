@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'fs-5 text-red-600']) }}>{{ $message }}</p>
@enderror
