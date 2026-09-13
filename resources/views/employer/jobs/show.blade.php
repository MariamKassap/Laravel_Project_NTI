@extends('layouts.employer')

@section('page_title', $job->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8 space-y-6">
    <div class="flex justify-between items-start border-b border-slate-100 pb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">{{ $job->title }}</h2>
            <div class="text-sm text-slate-400 mt-1">
                {{ $job->location ?? 'Location not specified' }} • {{ ucfirst($job->job_type ?? 'Full Time') }}
            </div>
        </div>
        <a href="{{ route('employer.jobs.index') }}" class="text-sm text-slate-500 hover:text-slate-800 font-medium">← Back to Jobs</a>
    </div>

    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl text-sm">
        <div><span class="text-slate-400">Salary:</span> <span class="font-bold text-slate-700">{{ $job->salary ? '$' . number_format($job->salary, 2) : 'N/A' }}</span></div>
        <div><span class="text-slate-400">Deadline:</span> <span class="font-bold text-slate-700">{{ $job->deadline ?? 'No deadline' }}</span></div>
    </div>

    <div>
        <h3 class="font-bold text-slate-800 mb-2">Description</h3>
        <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
    </div>
</div>
@endsection