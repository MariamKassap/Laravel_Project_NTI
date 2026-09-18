@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg shadow-[2px_2px_0px_0px_#000000] text-sm leading-5 focus:outline-none transition-all'
            : 'inline-flex items-center px-3 py-2 bg-white text-black font-bold border-2 border-black rounded-lg shadow-[2px_2px_0px_0px_#000000] text-sm leading-5 hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
