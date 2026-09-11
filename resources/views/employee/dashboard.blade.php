<x-app-layout>

    ```
    <div class="min-h-screen bg-[#f8fafc]">

        <main class="max-w-[1400px] mx-auto px-6 lg:px-8 py-8">

            {{-- ==================== WELCOME BANNER ==================== --}}
            <div class="bg-[#1e2d4f] rounded-2xl px-8 py-8 mb-8">

                <h1 class="text-3xl font-bold text-white">
                    Welcome back, {{ $employee->name }}!
                </h1>

                <p class="mt-2 text-[#9eacc5] text-base">
                    Here's what's happening with your job applications.
                </p>

            </div>


            {{-- ==================== STATISTICS ==================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">

                {{-- Total --}}
                <div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm text-[#64748b]">
                                Applications Sent
                            </p>

                            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                                {{ $totalApplications }}
                            </p>

                            <p class="mt-2 text-sm text-[#3b82f6]">
                                Total applications
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-[#eff6ff] flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#3b82f6]"
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
                <div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm text-[#64748b]">
                                Accepted
                            </p>

                            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                                {{ $acceptedApplications }}
                            </p>

                            <p class="mt-2 text-sm text-emerald-500">
                                Applications accepted
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-500"
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
                <div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm text-[#64748b]">
                                Pending
                            </p>

                            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                                {{ $pendingApplications }}
                            </p>

                            <p class="mt-2 text-sm text-amber-500">
                                Under review
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-500"
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
                <div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm text-[#64748b]">
                                Waiting List
                            </p>

                            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                                {{ $waitingApplications }}
                            </p>

                            <p class="mt-2 text-sm text-[#3b82f6]">
                                On waiting list
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-[#eff6ff] flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#3b82f6]"
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
                <div class="bg-white border border-[#e2e8f0] rounded-xl p-6">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm text-[#64748b]">
                                Rejected
                            </p>

                            <p class="mt-3 text-3xl font-bold text-[#1e2d4f]">
                                {{ $rejectedApplications }}
                            </p>

                            <p class="mt-2 text-sm text-red-500">
                                Applications rejected
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-500"
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


            {{-- ==================== LOWER SECTION ==================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- ==================== RECENT APPLICATIONS ==================== --}}
                <div class="lg:col-span-2 bg-white border border-[#e2e8f0] rounded-xl">

                    <div class="flex items-center justify-between px-6 py-5 border-b border-[#e2e8f0]">

                        <h2 class="text-lg font-semibold text-[#1e2d4f]">
                            Recent Applications
                        </h2>

                        <a href="{{ route('employee.applications.index') }}"
                            class="text-sm font-medium text-[#3b82f6] hover:text-blue-700">
                            View All
                        </a>

                    </div>


                    @if($recentApplications->count() > 0)

                    <div class="divide-y divide-[#eef2f7]">

                        @foreach($recentApplications as $application)

                        <div class="px-6 py-5 flex items-center justify-between gap-4">

                            {{-- Job information --}}
                            <div class="min-w-0">

                                <h3 class="font-semibold text-[#1e2d4f] truncate">
                                    {{ $application->job->title }}
                                </h3>

                                <p class="text-sm text-[#64748b] mt-1">
                                    {{ $application->job->employer->company ?? $application->job->employer->name ?? 'Company' }}
                                </p>

                            </div>


                            {{-- Date --}}
                            <div class="hidden sm:block text-sm text-[#94a3b8] whitespace-nowrap">
                                {{ $application->created_at->format('M d, Y') }}
                            </div>


                            {{-- Status --}}
                            <div class="whitespace-nowrap">

                                @if($application->status === 'accepted')

                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-600">
                                    Accepted
                                </span>

                                @elseif($application->status === 'rejected')

                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-red-100 text-red-600">
                                    Rejected
                                </span>

                                @elseif($application->status === 'waiting_list')

                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-600">
                                    Waiting List
                                </span>

                                @else

                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-600">
                                    Pending
                                </span>

                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                    @else

                    <div class="px-6 py-12 text-center">

                        <div class="w-12 h-12 mx-auto rounded-full bg-[#eff6ff] flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#3b82f6]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <p class="mt-4 text-sm text-[#64748b]">
                            You haven't applied for any jobs yet.
                        </p>

                        <a href="{{ route('employee.jobs.index') }}"
                            class="inline-block mt-4 text-sm font-medium text-[#3b82f6]">
                            Browse Jobs
                        </a>

                    </div>

                    @endif

                </div>


                {{-- ==================== AVAILABLE JOBS ==================== --}}
                <div class="bg-white border border-[#e2e8f0] rounded-xl">

                    <div class="flex items-center justify-between px-6 py-5 border-b border-[#e2e8f0]">

                        <h2 class="text-lg font-semibold text-[#1e2d4f]">
                            Recommended Jobs
                        </h2>

                        <a href="{{ route('employee.jobs.index') }}"
                            class="text-sm font-medium text-[#3b82f6]">
                            View All
                        </a>

                    </div>


                    <div class="p-4 space-y-3">

                        @forelse($availableJobs->take(3) as $job)

                        <div class="border border-[#e2e8f0] bg-[#f8fafc] rounded-lg p-4">

                            <h3 class="font-semibold text-[#1e2d4f] text-sm">
                                {{ $job->title }}
                            </h3>

                            <p class="text-sm text-[#64748b] mt-1">
                                {{ $job->employer->company ?? $job->employer->name ?? 'Company' }}
                            </p>

                            <div class="flex items-center justify-between mt-4">

                                @if($job->job_type)

                                <span class="text-xs font-medium text-[#3b82f6] bg-[#eff6ff] px-2 py-1 rounded">
                                    {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                </span>

                                @endif

                                <a href="{{ route('employee.job.show', $job->id) }}"
                                    class="text-xs font-medium text-[#3b82f6] hover:text-blue-700">
                                    View Job
                                </a>

                            </div>

                        </div>

                        @empty

                        <p class="text-sm text-[#64748b] text-center py-8">
                            No jobs available right now.
                        </p>

                        @endforelse

                    </div>

                </div>

            </div>

        </main>

    </div>
    ```

</x-app-layout>