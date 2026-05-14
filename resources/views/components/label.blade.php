@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#A0A0A0]']) }}>
    {{ $value ?? $slot }}
</label>
