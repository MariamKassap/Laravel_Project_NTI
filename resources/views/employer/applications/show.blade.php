@extends('layouts.employer')

@section('page_title', 'Applicant Detail')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8 space-y-6">

    {{-- Applicant Header --}}
    <div class="flex justify-between items-center border-b-2 border-black pb-6">

        <div>
            <h2 class="text-2xl font-black text-black">
                {{ $application->employee->name }}
            </h2>

            <p class="text-sm font-bold text-slate-600">
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
                class="bg-white border-2 border-black rounded-lg px-3 py-2 text-xs font-bold text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">

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
            <label class="text-xs font-bold text-black uppercase">
                Applicant
            </label>

            <div class="text-black font-bold mt-1">
                {{ $application->employee->name }}
            </div>

            <div class="text-sm font-bold text-slate-600 mt-1">
                {{ $application->employee->email }}
            </div>
        </div>


        {{-- Applied For --}}
        <div>
            <label class="text-xs font-bold text-black uppercase">
                Applied For
            </label>

            <div class="text-black font-black mt-1">
                {{ $application->job->title }}
            </div>
        </div>


        {{-- Application Status --}}
        <div>
            <label class="text-xs font-bold text-black uppercase">
                Current Status
            </label>

            <div class="mt-2">

                @if($application->status === 'pending')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-amber-300 text-black border border-black">
                    Pending
                </span>

                @elseif($application->status === 'waiting_list')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-blue-200 text-black border border-black">
                    Waiting List
                </span>

                @elseif($application->status === 'accepted')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-emerald-300 text-black border border-black">
                    Accepted
                </span>

                @elseif($application->status === 'rejected')

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-rose-300 text-black border border-black">
                    Rejected
                </span>

                @endif

            </div>
        </div>


        {{-- Submitted CV --}}
        <div>
            <label class="text-xs font-bold text-black uppercase">
                Submitted CV
            </label>

            <div class="mt-2">

                @if($application->cv && $application->cv->file_path)

                <a
                    href="{{ asset('storage/' . $application->cv->file_path) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">

                    <i class="fa-solid fa-file-pdf"></i>

                    View Submitted Resume
                    ({{ $application->cv->title ?? 'CV' }})

                </a>

                @else

                <span class="text-sm font-bold text-slate-500">
                    No CV attached.
                </span>

                @endif

            </div>
        </div>


        {{-- Application Date --}}
        <div>
            <label class="text-xs font-bold text-black uppercase">
                Applied On
            </label>

            <div class="text-black font-bold mt-1">
                {{ $application->created_at->format('M d, Y h:i A') }}
            </div>
        </div>

    </div>


    {{-- Actions --}}
    <div class="border-t-2 border-black pt-6 flex items-center justify-between">

        <a
            href="{{ route('employer.jobs.applications.index', $application->job->id) }}"
            class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">

            ← Back to Applicants

        </a>

        <a
            href="{{ route('employer.jobs.show', $application->job->id) }}"
            class="bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">

            View Job

        </a>

    </div>

</div>

@endsection
