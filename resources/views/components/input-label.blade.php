@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-black text-sm mb-1']) }}>
    {{ $value ?? $slot }}
</label>
