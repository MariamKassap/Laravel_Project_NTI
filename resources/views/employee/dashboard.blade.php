<x-app-layout>
    @php $title = 'Home'; @endphp

    <div class="min-h-screen bg-[#F4F0EA]">

        <main class="max-w-[1400px] mx-auto px-6 lg:px-8 py-8">

            {{-- Page Title --}}
            <h1 class="text-2xl font-black text-black mb-6">Home</h1>

            {{-- Welcome Banner --}}
            <div class="bg-white border-2 border-black rounded-xl px-8 py-6 mb-8 shadow-[4px_4px_0px_0px_#000000] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-black">
                        Welcome to Anti-عواطلي, {{ $employee->name }}!
                    </h2>
                    <p class="mt-1 text-sm font-bold text-black">
                        Here's what's happening with your job applications.
                    </p>
                </div>
                <a href="{{ route('employee.jobs.index') }}" class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all shrink-0">
                    Browse Jobs
                </a>
            </div>


            {{-- ==================== STATISTICS ==================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">

                {{-- Total --}}
                <div class="bg-white border-2 border-black rounded-xl p-6 shadow-[4px_4px_0px_0px_#000000]">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-bold text-black">
                                Applications Sent
                            </p>

                            <p class="mt-3 text-3xl font-black text-black">
                                {{ $totalApplications }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-black">
                                Total applications
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-blue-200 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>

                    </div>
                </div>


                {{-- Accepted --}}
                <div class="bg-white border-2 border-black rounded-xl p-6 shadow-[4px_4px_0px_0px_#000000]">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-bold text-black">
                                Accepted
                            </p>

                            <p class="mt-3 text-3xl font-black text-black">
                                {{ $acceptedApplications }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-black">
                                Applications accepted
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-emerald-300 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>

                    </div>
                </div>


                {{-- Pending --}}
                <div class="bg-white border-2 border-black rounded-xl p-6 shadow-[4px_4px_0px_0px_#000000]">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-bold text-black">
                                Pending
                            </p>

                            <p class="mt-3 text-3xl font-black text-black">
                                {{ $pendingApplications }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-black">
                                Under review
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-amber-300 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                    </div>
                </div>


                {{-- Waiting List --}}
                <div class="bg-white border-2 border-black rounded-xl p-6 shadow-[4px_4px_0px_0px_#000000]">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-bold text-black">
                                Waiting List
                            </p>

                            <p class="mt-3 text-3xl font-black text-black">
                                {{ $waitingApplications }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-black">
                                On waiting list
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-blue-200 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                    </div>
                </div>


                {{-- Rejected --}}
                <div class="bg-white border-2 border-black rounded-xl p-6 shadow-[4px_4px_0px_0px_#000000]">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-bold text-black">
                                Rejected
                            </p>

                            <p class="mt-3 text-3xl font-black text-black">
                                {{ $rejectedApplications }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-black">
                                Applications rejected
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-rose-300 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>

                    </div>
                </div>

            </div>


            {{-- ==================== LOWER SECTION: 2-COLUMN (Recommended Jobs wide + Recent Applications compact) ==================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ==================== RECOMMENDED JOBS (Left Column wide 2-span) ==================== --}}
                <div class="lg:col-span-2 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] overflow-hidden">

                    <div class="flex items-center justify-between px-6 py-5 border-b-2 border-black">

                        <h2 class="text-lg font-black text-black">
                            Recommended Jobs
                        </h2>

                        <a href="{{ route('employee.jobs.index') }}"
                            class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-3 py-1.5 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            View All
                        </a>

                    </div>


                    <div class="p-4 space-y-3">

                        @forelse($availableJobs->take(3) as $job)

                        <div class="border-2 border-black bg-white rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">

                            <h3 class="font-bold text-black text-sm">
                                {{ $job->title }}
                            </h3>

                            <p class="text-sm font-medium text-black mt-1">
                                {{ $job->employer->company ?? $job->employer->name ?? 'Company' }}
                            </p>

                            <p class="text-black font-black mt-2">
                                {{ number_format($job->salary) }}$
                            </p>

                            <div class="flex items-center justify-between mt-4">

                                @if($job->job_type)

                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">
                                    {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                </span>

                                @endif

                                <a href="{{ route('employee.job.show', $job->id) }}"
                                    class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-3 py-1.5 text-xs shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                                    View Job
                                </a>

                            </div>

                        </div>

                        @empty

                        <p class="text-sm font-bold text-black text-center py-8">
                            No jobs available right now.
                        </p>

                        @endforelse

                    </div>

                </div>

                {{-- ==================== RECENT APPLICATIONS (Right Column compact 1-span) ==================== --}}
                <div class="bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] overflow-hidden">

                    <div class="flex items-center justify-between px-6 py-5 border-b-2 border-black">

                        <h2 class="text-lg font-black text-black">
                            Recent Applications
                        </h2>

                        <a href="{{ route('employee.applications.index') }}"
                            class="inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-3 py-1.5 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 transition-all">
                            View All
                        </a>

                    </div>


                    @if($recentApplications->count() > 0)

                    <div class="divide-y-2 divide-black">

                        @foreach($recentApplications as $application)

                        <div class="px-6 py-4 flex items-center justify-between gap-4">

                            {{-- Job information --}}
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-black text-sm truncate">
                                    {{ $application->job->title }}
                                </h3>
                                <p class="text-xs font-bold text-black mt-1">
                                    {{ $application->job->employer->company ?? $application->job->employer->name ?? 'Company' }}
                                </p>
                                <p class="text-xs font-medium text-black mt-1">
                                    {{ $application->created_at->format('M d, Y') }}
                                </p>
                            </div>

                            {{-- Status --}}
                            <div class="whitespace-nowrap shrink-0">

                                @if($application->status === 'accepted')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-emerald-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                    Accepted
                                </span>
                                @elseif($application->status === 'rejected')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-rose-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                    Rejected
                                </span>
                                @elseif($application->status === 'waiting_list')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">
                                    Waiting List
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-amber-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                    Pending
                                </span>
                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                    @else

                    <div class="px-6 py-12 text-center">

                        <div class="w-12 h-12 mx-auto rounded-full bg-blue-200 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <p class="mt-4 text-sm font-bold text-black">
                            You haven't applied for any jobs yet.
                        </p>

                        <a href="{{ route('employee.jobs.index') }}"
                            class="inline-flex items-center justify-center mt-4 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            Browse Jobs
                        </a>

                    </div>

                    @endif

                </div>

            </div>

        </main>

    </div>

</x-app-layout>
