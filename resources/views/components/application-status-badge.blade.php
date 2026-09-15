@props(['status'])

@php
$statusStyles = [
'accepted' => 'bg-emerald-100 text-emerald-600',
'rejected' => 'bg-red-100 text-red-600',
'waiting_list' => 'bg-blue-100 text-blue-600',
'pending' => 'bg-amber-100 text-amber-600',
];

$statusText = [
'accepted' => 'Accepted',
'rejected' => 'Rejected',
'waiting_list' => 'Waiting List',
'pending' => 'Pending',
];

$style = $statusStyles[$status] ?? 'bg-gray-100 text-gray-600';
$text = $statusText[$status] ?? ucfirst(str_replace('_', ' ', $status));
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium {{ $style }}">
    {{ $text }}
</span>