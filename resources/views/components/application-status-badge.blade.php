@props(['status'])

@php
$statusStyles = [
    'accepted' => 'bg-emerald-300 text-black',
    'hired' => 'bg-emerald-300 text-black',
    'active' => 'bg-emerald-300 text-black',
    'pending' => 'bg-amber-300 text-black',
    'waiting_list' => 'bg-amber-300 text-black',
    'rejected' => 'bg-rose-300 text-black',
    'full_time' => 'bg-blue-200 text-black',
    'full-time' => 'bg-blue-200 text-black',
];

$statusText = [
    'accepted' => 'Accepted',
    'hired' => 'Hired',
    'active' => 'Active',
    'rejected' => 'Rejected',
    'waiting_list' => 'Waiting List',
    'pending' => 'Pending',
    'full_time' => 'Full-time',
    'full-time' => 'Full-time',
];

$style = $statusStyles[$status] ?? 'bg-white text-black';
$text = $statusText[$status] ?? ucfirst(str_replace('_', ' ', $status));
@endphp

<span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black shadow-[1px_1px_0px_0px_#000000] {{ $style }}">
    {{ $text }}
</span>
