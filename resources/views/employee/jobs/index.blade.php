<x-app-layout>

    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            Available Jobs
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F0EA] py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!---- search bar------>
            <form id="job-search-form" method="GET" action="{{ route('employee.jobs.index') }}" class="mb-8">

                <div class="flex gap-3">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by job title, location, or company..."
                        class="flex-1 bg-white border-2 border-black rounded-lg px-3 py-2 text-black shadow-[2px_2px_0px_0px_#000000] focus:ring-0 focus:outline-none placeholder:text-gray-500">

                    <select
                        name="application_status"
                        class="bg-white border-2 border-black rounded-lg px-3 py-2 text-black shadow-[2px_2px_0px_0px_#000000] focus:ring-0 focus:outline-none font-bold">
                        <option value="not_applied"
                            {{ request('application_status', 'not_applied') === 'not_applied' ? 'selected' : '' }}>
                            Not Applied
                        </option>

                        <option value="applied"
                            {{ request('application_status') === 'applied' ? 'selected' : '' }}>
                            Applied
                        </option>

                        <option value="all"
                            {{ request('application_status') === 'all' ? 'selected' : '' }}>
                            All Jobs
                        </option>
                    </select>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-6 py-2 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        Search
                    </button>
                </div>

            </form>

            @if($jobs->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($jobs as $job)

                <div class="bg-white p-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000]">

                    <h3 class="text-xl font-black text-black">
                        {{ $job->title }}
                    </h3>

                    <p class="font-bold text-black mt-2">
                        {{ $job->employer->company ?? $job->employer->name }}
                    </p>

                    <p class="mt-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">
                            {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                        </span>
                    </p>

                    <p class="text-black font-black mt-2">
                        {{ number_format($job->salary) }}$
                    </p>

                    @if($job->deadline)
                    <p class="font-bold text-black mt-2">
                        Deadline:
                        {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                    </p>
                    @endif

                    <p class="font-medium text-black mt-4">
                        {{ Str::limit($job->description, 120) }}
                    </p>

                    <a
                        href="{{ route('employee.job.show', $job) }}"
                        class="inline-flex items-center justify-center mt-4 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        View Job
                    </a>
                    @if(in_array($job->id, $appliedJobIds))

                    <span class="inline-flex items-center mt-4 ml-2 px-4 py-2 bg-emerald-300 text-black font-bold border border-black rounded-md shadow-[1px_1px_0px_0px_#000000]">
                        ✓ Already Applied
                    </span>

                    @endif



                </div>

                @endforeach

            </div>
            <!pagination>
                <div class="mt-8">
                    {{ $jobs->links() }}
                </div>

                @else

                <div class="bg-white p-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] text-center">
                    <p class="font-bold text-black">
                        No jobs available right now.
                    </p>
                </div>

                @endif

        </div>
    </div>

</x-app-layout>
