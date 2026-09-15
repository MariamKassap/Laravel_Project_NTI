@props(['job'])

<div class="border border-[#e2e8f0] bg-[#f8fafc] rounded-lg p-4">

    <h3 class="font-semibold text-[#1e2d4f] text-sm">
        {{ $job->title }}
    </h3>

    <p class="text-sm text-[#64748b] mt-1">
        {{ $job->employer->company ?? $job->employer->name ?? 'Company' }}
    </p>

    @if($job->job_type)

    <span class="inline-block mt-3 text-xs font-medium text-[#3b82f6] bg-[#eff6ff] px-2 py-1 rounded">
        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
    </span>

    @endif

    <div class="flex items-center justify-between mt-4">

        <p class="text-xs text-[#94a3b8]">
            {{ Str::limit($job->description, 45) }}
        </p>

        <a href="{{ route('employee.jobs.show', $job) }}"
            class="text-xs font-medium text-[#3b82f6] hover:text-blue-700 whitespace-nowrap ml-3">
            View Job
        </a>

    </div>

</div>