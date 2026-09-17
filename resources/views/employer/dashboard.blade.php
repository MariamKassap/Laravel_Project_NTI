@extends('layouts.employer')

@section('page_title', 'Employer Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-[#1E293B] to-[#0F172A] rounded-2xl p-8 text-white flex justify-between items-center shadow-md">
        <div>
            <h2 class="text-2xl font-bold mb-2">
                Welcome back, {{ auth()->user()->company ?? auth()->user()->name }}!
            </h2>

            <p class="text-slate-300 text-sm">
                Manage your job postings and review candidate applications.
            </p>
        </div>

        <a
            href="{{ route('employer.jobs.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-xl flex items-center gap-2 transition">

            <i class="fa-solid fa-circle-plus"></i>
            Post New Job

        </a>
    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Active Jobs --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start justify-between">

            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Active Jobs
                </div>

                <div class="text-3xl font-bold text-slate-800">
                    {{ $activeJobsCount }}
                </div>

                <div class="text-xs text-blue-600 mt-2 font-medium">
                    Currently accepting applications
                </div>
            </div>

            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-briefcase"></i>
            </div>

        </div>


        {{-- Total Applicants --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start justify-between">

            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Total Applicants
                </div>

                <div class="text-3xl font-bold text-slate-800">
                    {{ $totalApplicationsCount }}
                </div>

                <div class="text-xs text-blue-600 mt-2 font-medium">
                    Across all jobs
                </div>
            </div>

            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-users"></i>
            </div>

        </div>


        {{-- Expired Jobs --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start justify-between">

            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Expired Jobs
                </div>

                <div class="text-3xl font-bold text-slate-800">
                    {{ $expiredJobsCount }}
                </div>

                <div class="text-xs text-slate-400 mt-2">
                    No longer accepting applications
                </div>
            </div>

            <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-clock"></i>
            </div>

        </div>


        {{-- Accepted Applications --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start justify-between">

            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Accepted Applications
                </div>

                <div class="text-3xl font-bold text-slate-800">
                    {{ $acceptedApplicationsCount }}
                </div>

                <div class="text-xs text-emerald-600 mt-2 font-medium">
                    Across all jobs
                </div>
            </div>

            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-user-check"></i>
            </div>

        </div>

    </div>


    {{-- Recent Job Postings --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

        <div class="flex items-center justify-between mb-6">

            <h3 class="font-bold text-slate-800 text-lg">
                Recent Job Postings
            </h3>

            <a
                href="{{ route('employer.jobs.index') }}"
                class="text-sm font-semibold text-blue-600 hover:text-blue-700">

                Manage All

            </a>

        </div>


        <div class="divide-y divide-slate-100">

            @forelse($recentJobs as $job)

            <div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">

                {{-- Job Information --}}
                <div>

                    <div class="font-bold text-slate-800">
                        {{ $job->title }}
                    </div>

                    <div class="text-xs text-slate-400 mt-1">
                        Posted {{ $job->created_at->diffForHumans() }}
                    </div>

                    @if($job->deadline)

                    <div class="text-xs text-slate-400 mt-1">
                        Deadline:
                        {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                    </div>

                    @else

                    <div class="text-xs text-slate-400 mt-1">
                        No deadline
                    </div>

                    @endif

                </div>


                {{-- Job Status --}}
                <div class="flex items-center gap-6">

                    <span class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                        {{ $job->applications_count }}
                        {{ $job->applications_count == 1 ? 'Applicant' : 'Applicants' }}
                    </span>


                    @if($job->deadline && \Carbon\Carbon::parse($job->deadline)->isBefore(today()))

                    <span class="text-xs font-semibold bg-red-100 text-red-700 px-2.5 py-1 rounded-full">
                        Expired
                    </span>

                    @else

                    <span class="text-xs font-semibold bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full">
                        Active
                    </span>

                    @endif

                </div>

            </div>

            @empty

            <div class="py-8 text-center text-slate-400 text-sm">
                No jobs posted yet.
            </div>

            @endforelse

        </div>

    </div>

</div>
@endsection