{{-- File: resources/views/components/nav-link.blade.php --}}
@props(['active'])

@php
$baseClasses = 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-gray-200 hover:text-white hover:bg-white/10 focus:outline-none focus:text-white focus:bg-white/20 rounded-md transition duration-150 ease-in-out';
$activeClasses = 'bg-[#4CAF50] text-white';
$classes = ($active ?? false) ? $baseClasses . ' ' . $activeClasses : $baseClasses;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>