@props([
'title',
'value',
'description',
'type' => 'blue',
])

@php
$styles = [
'blue' => [
'bg' => 'bg-blue-200',
'text' => 'text-black',
],
'green' => [
'bg' => 'bg-emerald-300',
'text' => 'text-black',
],
'yellow' => [
'bg' => 'bg-amber-300',
'text' => 'text-black',
],
'red' => [
'bg' => 'bg-rose-300',
'text' => 'text-black',
],
];

$style = $styles[$type] ?? $styles['blue'];
@endphp

<div class="bg-white border-2 border-black rounded-xl p-5 shadow-[4px_4px_0px_0px_#000000]">
    <div class="flex items-start justify-between">

        <div>
            <p class="text-sm font-bold text-black">
                {{ $title }}
            </p>

            <p class="mt-3 text-3xl font-black text-black">
                {{ $value }}
            </p>

            <p class="mt-2 text-sm font-bold {{ $style['text'] }}">
                {{ $description }}
            </p>
        </div>

        <div class="w-10 h-10 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] {{ $style['bg'] }} flex items-center justify-center">

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
