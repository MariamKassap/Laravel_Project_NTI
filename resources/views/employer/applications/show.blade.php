@extends('layouts.employer')

@section('page_title', 'Applicant Detail')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8 space-y-6">

    {{-- Applicant Header --}}
    <div class="flex justify-between items-center border-b border-slate-100 pb-6">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                {{ $application->employee->name }}
            </h2>

            <p class="text-sm text-slate-400">
                {{ $application->employee->email }}
            </p>
        </div>


        {{-- Application Status --}}
        <form
            method="POST"
            action="{{ route('employer.applications.updateStatus', $application->id) }}">

            @csrf
            @method('PATCH')

            <select
                name="status"
                onchange="this.form.submit()"
                class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none">

                <option
                    value="pending"
                    {{ $application->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option
                    value="waiting_list"
                    {{ $application->status == 'waiting_list' ? 'selected' : '' }}>
                    Waiting List
                </option>

                <option
                    value="accepted"
                    {{ $application->status == 'accepted' ? 'selected' : '' }}>
                    Accepted
                </option>

                <option
                    value="rejected"
                    {{ $application->status == 'rejected' ? 'selected' : '' }}>
                    Rejected
                </option>

            </select>

        </form>

    </div>


    {{-- Application Information --}}
    <div class="space-y-6">

        {{-- Applicant --}}
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">
                Applicant
            </label>

            <div class="text-slate-800 font-semibold mt-1">
                {{ $application->employee->name }}
            </div>

            <div class="text-sm text-slate-500 mt-1">
                {{ $application->employee->email }}
            </div>
        </div>


        {{-- Applied For --}}
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">
                Applied For
            </label>

            <div class="text-slate-800 font-bold mt-1">
                {{ $application->job->title }}
            </div>
        </div>


        {{-- Application Status --}}
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">
                Current Status
            </label>

            <div class="mt-2">

                @if($application->status === 'pending')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                    Pending
                </span>

                @elseif($application->status === 'waiting_list')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                    Waiting List
                </span>

                @elseif($application->status === 'accepted')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                    Accepted
                </span>

                @elseif($application->status === 'rejected')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                    Rejected
                </span>

                @endif

            </div>
        </div>


        {{-- Submitted CV --}}
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">
                Submitted CV
            </label>

            <div class="mt-2">

                @if($application->cv && $application->cv->file_path)

                <a
                    href="{{ asset('storage/' . $application->cv->file_path) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-sm font-semibold hover:bg-blue-100">

                    <i class="fa-solid fa-file-pdf"></i>

                    View Submitted Resume
                    ({{ $application->cv->title ?? 'CV' }})

                </a>

                @else

                <span class="text-sm text-slate-400">
                    No CV attached.
                </span>

                @endif

            </div>
        </div>


        {{-- Application Date --}}
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">
                Applied On
            </label>

            <div class="text-slate-700 mt-1">
                {{ $application->created_at->format('M d, Y h:i A') }}
            </div>
        </div>

    </div>


    {{-- Actions --}}
    <div class="border-t border-slate-100 pt-6 flex items-center justify-between">

        <a
            href="{{ route('employer.jobs.applications.index', $application->job->id) }}"
            class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl text-sm font-semibold hover:bg-slate-200">

            ← Back to Applicants

        </a>

        <a
            href="{{ route('employer.jobs.show', $application->job->id) }}"
            class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700">

            View Job

        </a>

    </div>

</div>

@endsection