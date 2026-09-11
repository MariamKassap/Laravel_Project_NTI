@props([
'title',
'value',
'description',
'type' => 'blue',
])

@php
$styles = [
'blue' => [
'bg' => 'bg-[#eff6ff]',
'text' => 'text-[#3b82f6]',
],
'green' => [
'bg' => 'bg-emerald-50',
'text' => 'text-emerald-500',
],
'yellow' => [
'bg' => 'bg-amber-50',
'text' => 'text-amber-500',
],
'red' => [
'bg' => 'bg-red-50',
'text' => 'text-red-500',
],
];

$style = $styles[$type] ?? $styles['blue'];
@endphp

<div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
    <div class="flex items-start justify-between">

        <div>
            <p class="text-sm text-[#64748b]">
                {{ $title }}
            </p>

            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                {{ $value }}
            </p>

            <p class="mt-2 text-sm {{ $style['text'] }}">
                {{ $description }}
            </p>
        </div>

        <div class="w-10 h-10 rounded-lg {{ $style['bg'] }} flex items-center justify-center">

            <svg class="w-5 h-5 {{ $style['text'] }}"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

            </svg>

        </div>

    </div>
</div>