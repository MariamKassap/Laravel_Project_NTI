@props(['job'])

<div class="bg-white border-2 border-black rounded-xl p-5 shadow-[4px_4px_0px_0px_#000000]">

    <h3 class="font-black text-black text-sm">
        {{ $job->title }}
    </h3>

    <p class="text-sm font-semibold text-black mt-1">
        {{ $job->employer->company ?? $job->employer->name ?? 'Company' }}
    </p>

    @if($job->job_type)

    <span class="inline-flex items-center mt-3 text-xs font-bold text-black bg-blue-200 border border-black px-2.5 py-1 rounded-md shadow-[1px_1px_0px_0px_#000000]">
        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
    </span>

    @endif

    <div class="flex items-center justify-between mt-4 gap-3">

        <p class="text-xs font-medium text-black line-clamp-2">
            {{ Str::limit($job->description, 45) }}
        </p>

        <a href="{{ route('employee.jobs.show', $job) }}"
            class="inline-flex items-center justify-center whitespace-nowrap ml-3 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-3 py-1.5 text-xs shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
            View Job
        </a>

    </div>

</div>
