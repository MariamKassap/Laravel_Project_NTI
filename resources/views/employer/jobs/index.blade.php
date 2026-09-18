@extends('layouts.employer')

@section('page_title', 'Manage Opportunities')

@section('content')
<div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] overflow-hidden">
    <div class="p-6 border-b-2 border-black">
        <h2 class="text-lg font-black text-black">Job Listings ({{ $jobs->total() }})</h2>
    </div>

    <div class="overflow-x-auto border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] m-6">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-2 border-black text-xs font-bold text-black uppercase tracking-wider bg-slate-100">
                    <th class="py-4 px-6">Job Title</th>
                    <th class="py-4 px-6">Applicants</th>
                    <th class="py-4 px-6">Posted Date</th>
                    <th class="py-4 px-6">Deadline</th>
                    <th class="py-4 px-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/10 text-sm">
                @forelse($jobs as $job)
                @php
                $isExpired = $job->deadline && \Carbon\Carbon::parse($job->deadline)->isBefore(today());
                @endphp
                <tr class="border-b border-black hover:bg-slate-50">
                    <td class="py-4 px-6">
                        <div class="font-bold text-black">{{ $job->title }}</div>
                        <div class="text-xs font-bold text-slate-600">{{ auth()->user()->company ?? 'Company' }} • {{ $job->location ?? 'N/A' }}</div>
                    </td>
                    <td class="py-4 px-6 font-bold text-black">
                        <a href="{{ route('employer.jobs.applications.index', $job->id) }}" class="text-[#2563EB] hover:underline font-bold">
                            {{ $job->applications_count }} applicants
                        </a>
                    </td>
                    <td class="py-4 px-6 text-black font-bold">
                        {{ $job->created_at->format('M d, Y') }}
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-black font-bold">
                            {{ $job->deadline
                ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y')
                : 'No deadline' }}
                        </div>

                        @if($isExpired)
                        <span class="inline-flex mt-1 text-xs font-bold bg-rose-300 text-black px-2.5 py-1 rounded-full border border-black">
                            Expired
                        </span>
                        @else
                        <span class="inline-flex mt-1 text-xs font-bold bg-emerald-300 text-black px-2.5 py-1 rounded-full border border-black">
                            Active
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2 flex-wrap">
                            {{-- View --}}
                            <a href="{{ route('employer.jobs.show', $job->id) }}"
                                class="px-3 py-1.5 bg-blue-200 text-black font-bold border-2 border-black rounded-lg text-xs shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                                View
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('employer.jobs.edit', $job->id) }}"
                                class="px-3 py-1.5 bg-amber-300 text-black font-bold border-2 border-black rounded-lg text-xs shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
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
                                    class="px-3 py-1.5 bg-red-500 text-white font-bold border-2 border-black rounded-lg text-xs shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-500 font-bold">No job listings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
