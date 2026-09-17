@extends('layouts.employer')

@section('page_title', 'Job Applicants')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6 space-y-6">
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-xl font-bold text-slate-800">
            <h2 class="text-xl font-bold text-slate-800">
                Applicants for {{ $job->title }}
            </h2>
        </h2>
        <p class="text-xs text-slate-400">Manage candidate application statuses directly below</p>
    </div>

    <div class="space-y-4">
        @forelse($applications as $app)
        <div class="border border-slate-100 rounded-xl p-5 flex items-center justify-between hover:border-slate-200 transition">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-600 text-lg">
                    {{ substr($app->employee->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-slate-800">{{ $app->employee->name }}</span>
                        <!-- Inline Status Update Form matching schema enums -->
                        <form method="POST" action="{{ route('employer.applications.updateStatus', $app->id) }}" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold px-2.5 py-1 rounded-full border border-slate-200 bg-slate-50 focus:outline-none">
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="waiting_list" {{ $app->status == 'waiting_list' ? 'selected' : '' }}>Waiting List</option>
                                <option value="accepted" {{ $app->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </div>
                    <div class="text-xs text-slate-400 mt-1">
                        Applied for <span class="font-semibold text-slate-600">{{ $app->job->title }}</span> • {{ $app->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('employer.applications.show', $app->id) }}" class="px-4 py-2 border border-slate-200 text-slate-600 font-semibold rounded-lg text-xs hover:bg-slate-50">
                    View Details
                </a>
            </div>
        </div>
        @empty
        <div class="py-12 text-center text-slate-400 text-sm">No applications received yet.</div>
        @endforelse
    </div>

    <div>
        {{ $applications->links() }}
    </div>
</div>
@endsection