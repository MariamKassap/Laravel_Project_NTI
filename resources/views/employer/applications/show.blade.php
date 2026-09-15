@extends('layouts.employer')

@section('page_title', 'Applicant Detail')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8 space-y-6">
    <div class="flex justify-between items-center border-b border-slate-100 pb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">{{ $application->user->name }}</h2>
            <p class="text-sm text-slate-400">{{ $application->user->email }}</p>
        </div>
        <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
            @csrf
            @method('PATCH')
            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none">
                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="waiting_list" {{ $application->status == 'waiting_list' ? 'selected' : '' }}>Waiting List</option>
                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </form>
    </div>

    <div class="space-y-4">
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">Applied For</label>
            <div class="text-slate-800 font-bold mt-1">{{ $application->job->title }}</div>
        </div>

        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase">Submitted CV</label>
            <div class="mt-2">
                @if($application->cv && $application->cv->file_path)
                    <a href="{{ asset('storage/' . $application->cv->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-sm font-semibold hover:bg-blue-100">
                        <i class="fa-solid fa-file-pdf"></i> View Submitted Resume ({{ $application->cv->title ?? 'CV' }})
                    </a>
                @else
                    <span class="text-sm text-slate-400">No CV attached.</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection