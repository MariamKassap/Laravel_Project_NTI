@extends('layouts.employer')

@section('page_title', 'Job Applicants')

@section('content')
<div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] overflow-hidden p-6 space-y-6">
    <div class="border-b-2 border-black pb-4">
        <h2 class="text-xl font-black text-black">
            <h2 class="text-xl font-black text-black">
                Applicants for {{ $job->title }}
            </h2>
        </h2>
        <p class="text-xs font-bold text-black mt-1">Manage candidate application statuses directly below</p>
    </div>

    <div class="space-y-4">
        @forelse($applications as $app)
        <div class="bg-white border-2 border-black rounded-xl p-5 flex items-center justify-between shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white border-2 border-black rounded-full flex items-center justify-center font-black text-black text-lg shadow-[2px_2px_0px_0px_#000000]">
                    {{ substr($app->employee->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-black">{{ $app->employee->name }}</span>
                        <!-- Inline Status Update Form matching schema enums -->
                        <form method="POST" action="{{ route('employer.applications.updateStatus', $app->id) }}" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="bg-white border-2 border-black rounded-lg px-3 py-2 text-xs font-bold text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="waiting_list" {{ $app->status == 'waiting_list' ? 'selected' : '' }}>Waiting List</option>
                                <option value="accepted" {{ $app->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </div>
                    <div class="text-xs font-bold text-slate-600 mt-1">
                        Applied for <span class="font-black text-black">{{ $app->job->title }}</span> • {{ $app->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('employer.applications.show', $app->id) }}" class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-xs shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                    View Details
                </a>
            </div>
        </div>
        @empty
        <div class="py-12 text-center text-slate-500 text-sm font-bold">No applications received yet.</div>
        @endforelse
    </div>

    <div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
