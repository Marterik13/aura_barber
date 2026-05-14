@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[#0D0D0D] border-gray-800 text-[#F5F5F5] focus:border-[#D4AF37] focus:ring-[#D4AF37] rounded-lg shadow-sm placeholder-gray-600']) !!}>
