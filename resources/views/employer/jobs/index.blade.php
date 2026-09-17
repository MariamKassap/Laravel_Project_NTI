@extends('layouts.employer')

@section('page_title', 'Manage Opportunities')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-lg font-bold text-slate-800">Job Listings ({{ $jobs->total() }})</h2>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50">
                <th class="py-4 px-6">Job Title</th>
                <th class="py-4 px-6">Applicants</th>
                <th class="py-4 px-6">Posted Date</th>
                <th class="py-4 px-6">Deadline</th>
                <th class="py-4 px-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @forelse($jobs as $job)
            @php
            $isExpired = $job->deadline && \Carbon\Carbon::parse($job->deadline)->isBefore(today());
            @endphp
            <tr class="hover:bg-slate-50/50">
                <td class="py-4 px-6">
                    <div class="font-bold text-slate-800">{{ $job->title }}</div>
                    <div class="text-xs text-slate-400">{{ auth()->user()->company ?? 'Company' }} • {{ $job->location ?? 'N/A' }}</div>
                </td>
                <td class="py-4 px-6 font-medium text-slate-700">
                    <a href="{{ route('employer.jobs.applications.index', $job->id) }}" class="text-blue-600 hover:underline">
                        {{ $job->applications_count }} applicants
                    </a>
                </td>
                <td class="py-4 px-6 text-slate-500">
                    {{ $job->created_at->format('M d, Y') }}
                </td>
                <td class="py-4 px-6 text-slate-500">
                    {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y') : '--' }}
                </td>
                {{-- Expired or Active --}}
                <td class="py-4 px-6">
                    <div class="text-slate-500">
                        {{ $job->deadline
            ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y')
            : 'No deadline' }}
                    </div>

                    @if($isExpired)
                    <span class="text-xs font-semibold text-red-600">
                        Expired
                    </span>
                    @else
                    <span class="text-xs font-semibold text-green-600">
                        Active
                    </span>
                    @endif
                </td>
                <td class="py-4 px-6 text-right space-x-2">

                    {{-- View --}}
                    <a href="{{ route('employer.jobs.show', $job->id) }}"
                        class="px-3 py-1.5 bg-blue-50 text-blue-600 font-semibold rounded-lg text-xs hover:bg-blue-100">
                        View
                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('employer.jobs.edit', $job->id) }}"
                        class="px-3 py-1.5 bg-amber-50 text-amber-600 font-semibold rounded-lg text-xs hover:bg-amber-100">
                        Edit
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('employer.jobs.destroy', $job->id) }}"
                        method="POST"
                        class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this job?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="px-3 py-1.5 bg-red-50 text-red-600 font-semibold rounded-lg text-xs hover:bg-red-100">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-slate-400">No job listings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection