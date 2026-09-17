@extends('layouts.employer')

@section('page_title', $job->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8 space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-start border-b border-slate-100 pb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                {{ $job->title }}
            </h2>

            <div class="text-sm text-slate-400 mt-2">
                {{ auth()->user()->company ?? 'Company' }}
            </div>
        </div>

        <a href="{{ route('employer.jobs.index') }}"
            class="text-sm text-slate-500 hover:text-slate-800 font-medium">
            ← Back to Jobs
        </a>
    </div>


    {{-- Job Information --}}
    <div>
        <h3 class="text-lg font-bold text-slate-800 mb-4">
            Job Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Location --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Location
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->location ?? 'Not specified' }}
                </div>
            </div>

            {{-- Job Type --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Job Type
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->job_type
                        ? ucwords(str_replace('_', ' ', $job->job_type))
                        : 'Not specified' }}
                </div>
            </div>

            {{-- Salary --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Salary
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->salary !== null
                        ? '$' . number_format($job->salary, 2)
                        : 'Not specified' }}
                </div>
            </div>

            {{-- Deadline --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Application Deadline
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->deadline
                        ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y')
                        : 'No deadline' }}
                </div>
            </div>

            {{-- Posted Date --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Posted Date
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->created_at->format('M d, Y') }}
                </div>
            </div>

            {{-- Last Updated --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-xs text-slate-400 uppercase font-semibold mb-1">
                    Last Updated
                </div>

                <div class="text-sm font-semibold text-slate-700">
                    {{ $job->updated_at->format('M d, Y') }}
                </div>
            </div>

        </div>
    </div>


    {{-- Description --}}
    <div class="border-t border-slate-100 pt-6">
        <h3 class="text-lg font-bold text-slate-800 mb-3">
            Job Description
        </h3>

        <p class="text-slate-600 leading-relaxed whitespace-pre-line">
            {{ $job->description }}
        </p>
    </div>


    {{-- Actions --}}
    <div class="border-t border-slate-100 pt-6 flex justify-end gap-3">

        <a href="{{ route('employer.jobs.applications.index', $job->id) }}"
            class="px-5 py-2.5 bg-blue-50 text-blue-600 rounded-xl text-sm font-semibold hover:bg-blue-100">
            View Applicants
        </a>

        <a href="{{ route('employer.jobs.edit', $job->id) }}"
            class="px-5 py-2.5 bg-amber-50 text-amber-600 rounded-xl text-sm font-semibold hover:bg-amber-100">
            Edit Job
        </a>

        <!-- <a href="{{ route('employer.jobs.index') }}"
            class="px-5 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-50">
            Back to Jobs
        </a> -->

    </div>

</div>
@endsection