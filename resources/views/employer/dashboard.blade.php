@php $title = 'Employer Home'; @endphp
@extends('layouts.employer')

@section('page_title', 'Home')

@section('content')
{{-- Unified Neo-Brutalist container shell --}}
<div class="bg-white border-2 border-black shadow-[6px_6px_0px_0px_#000000] rounded-2xl p-6 space-y-8">

    <h1 class="text-2xl font-black text-black">Home</h1>
    <p class="text-sm font-bold text-black -mt-6">Welcome to Anti-عواطلي, {{ auth()->user()->name }}</p>

    {{-- Welcome / Post New Job Action Banner — muted warm vintage --}}
    <div class="bg-[#FEF9C3] border-2 border-black rounded-xl p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-[4px_4px_0px_0px_#000000]">
        <div>
            <h2 class="text-xl font-black text-black">
                Ready to hire?
            </h2>
            <p class="text-sm font-bold text-black mt-1">
                Post a new opportunity and reach {{ number_format($totalApplicationsCount) }}+ candidates.
            </p>
        </div>

        <a
            href="{{ route('employer.jobs.create') }}"
            class="bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold border-2 border-black rounded-lg px-4 py-2 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none flex items-center gap-2 transition">
            <i class="fa-solid fa-circle-plus"></i>
            Post New Job
        </a>
    </div>


    {{-- Statistics — Active Jobs / Total Applicants / Open Roles --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Active Jobs --}}
        <div class="bg-white p-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] flex items-start justify-between">

            <div>
                <div class="text-xs font-bold text-black uppercase tracking-wider mb-2">
                    Active Jobs
                </div>

                <div class="text-3xl font-black text-black">
                    {{ $activeJobsCount }}
                </div>

                <div class="text-xs text-black mt-2 font-bold">
                    Currently accepting applications
                </div>
            </div>

            <div class="w-10 h-10 bg-blue-200 text-black rounded-lg flex items-center justify-center border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <i class="fa-solid fa-briefcase"></i>
            </div>

        </div>


        {{-- Total Applicants --}}
        <div class="bg-white p-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] flex items-start justify-between">

            <div>
                <div class="text-xs font-bold text-black uppercase tracking-wider mb-2">
                    Total Applicants
                </div>

                <div class="text-3xl font-black text-black">
                    {{ $totalApplicationsCount }}
                </div>

                <div class="text-xs text-black mt-2 font-bold">
                    Across all jobs
                </div>
            </div>

            <div class="w-10 h-10 bg-amber-300 text-black rounded-lg flex items-center justify-center border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <i class="fa-solid fa-users"></i>
            </div>

        </div>


        {{-- Open Roles / Expired + Accepted merged as Open Roles --}}
        <div class="bg-white p-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] flex items-start justify-between">

            <div>
                <div class="text-xs font-bold text-black uppercase tracking-wider mb-2">
                    Open Roles
                </div>

                <div class="text-3xl font-black text-black">
                    {{ $activeJobsCount }}
                </div>

                <div class="text-xs text-black mt-2 font-bold">
                    {{ $acceptedApplicationsCount }} accepted • {{ $expiredJobsCount }} expired
                </div>
            </div>

            <div class="w-10 h-10 bg-emerald-300 text-black rounded-lg flex items-center justify-center border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <i class="fa-solid fa-user-check"></i>
            </div>

        </div>

    </div>


    {{-- Recent Job Postings --}}
    <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6">

        <div class="flex items-center justify-between mb-6">
            <h3 class="font-black text-black text-lg">
                Recent Job Postings
            </h3>

            <a
                href="{{ route('employer.jobs.index') }}"
                class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                Manage All
            </a>
        </div>

        <div class="divide-y-2 divide-black">
            @forelse($recentJobs as $job)
            <div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
                {{-- Job Information --}}
                <div>
                    <div class="font-bold text-black">
                        {{ $job->title }}
                    </div>
                    <div class="text-xs font-bold text-black mt-1">
                        Posted {{ $job->created_at->diffForHumans() }}
                    </div>
                    @if($job->deadline)
                    <div class="text-xs font-bold text-black mt-1">
                        Deadline:
                        {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                    </div>
                    @else
                    <div class="text-xs font-bold text-black mt-1">
                        No deadline
                    </div>
                    @endif
                </div>

                {{-- Job Status --}}
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-black bg-blue-200 px-3 py-1 rounded-full border-2 border-black shadow-[1px_1px_0px_0px_#000000]">
                        {{ $job->applications_count }}
                        {{ $job->applications_count == 1 ? 'Applicant' : 'Applicants' }}
                    </span>

                    @if($job->deadline && \Carbon\Carbon::parse($job->deadline)->isBefore(today()))
                    <span class="text-xs font-bold bg-rose-300 text-black px-2.5 py-1 rounded-full border-2 border-black shadow-[1px_1px_0px_0px_#000000]">
                        Expired
                    </span>
                    @else
                    <span class="text-xs font-bold bg-emerald-300 text-black px-2.5 py-1 rounded-full border-2 border-black shadow-[1px_1px_0px_0px_#000000]">
                        Active
                    </span>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-8 text-center text-black text-sm font-bold">
                No jobs posted yet.
            </div>
            @endforelse
        </div>

    </div>

</div>
@endsection
