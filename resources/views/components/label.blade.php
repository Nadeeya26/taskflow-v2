@props(['value'])

<label {{ $attributes->merge(['class' => 'tf-label block']) }}>
    {{ $value ?? $slot }}
</label>
