@extends('layouts.employer')

@section('page_title', $job->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8 space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-start border-b-2 border-black pb-6">
        <div>
            <h2 class="text-2xl font-black text-black">
                {{ $job->title }}
            </h2>

            <div class="text-sm font-bold text-slate-600 mt-2">
                {{ auth()->user()->company ?? 'Company' }}
            </div>
        </div>

        <a href="{{ route('employer.jobs.index') }}"
            class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            ← Back to Jobs
        </a>
    </div>


    {{-- Job Information --}}
    <div>
        <h3 class="text-lg font-black text-black mb-4">
            Job Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Location --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Location
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->location ?? 'Not specified' }}
                </div>
            </div>

            {{-- Job Type --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Job Type
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->job_type
                        ? ucwords(str_replace('_', ' ', $job->job_type))
                        : 'Not specified' }}
                </div>
            </div>

            {{-- Salary --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Salary
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->salary !== null
                        ? '$' . number_format($job->salary, 2)
                        : 'Not specified' }}
                </div>
            </div>

            {{-- Deadline --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Application Deadline
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->deadline
                        ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y')
                        : 'No deadline' }}
                </div>
            </div>

            {{-- Posted Date --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Posted Date
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->created_at->format('M d, Y') }}
                </div>
            </div>

            {{-- Last Updated --}}
            <div class="bg-white rounded-xl p-4 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                <div class="text-xs text-black uppercase font-bold mb-1">
                    Last Updated
                </div>

                <div class="text-sm font-bold text-black">
                    {{ $job->updated_at->format('M d, Y') }}
                </div>
            </div>

        </div>
    </div>


    {{-- Description --}}
    <div class="border-t-2 border-black pt-6">
        <h3 class="text-lg font-black text-black mb-3">
            Job Description
        </h3>

        <p class="text-black font-medium leading-relaxed whitespace-pre-line">
            {{ $job->description }}
        </p>
    </div>


    {{-- Actions --}}
    <div class="border-t-2 border-black pt-6 flex justify-end gap-3">


        <a href="{{ route('employer.jobs.applications.index', ['job' => $job->id]) }}"
            class="bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            View Applicants
        </a>

        <a href="{{ route('employer.jobs.edit', $job->id) }}"
            class="bg-amber-300 text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            Edit Job
        </a>

        <!-- <a href="{{ route('employer.jobs.index') }}"
            class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            Back to Jobs
        </a> -->

    </div>

</div>
@endsection