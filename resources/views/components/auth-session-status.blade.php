@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-sm text-black bg-emerald-300 border-2 border-black rounded-lg px-3 py-2 shadow-[2px_2px_0px_0px_#000000]']) }}>
        {{ $status }}
    </div>
@endif
