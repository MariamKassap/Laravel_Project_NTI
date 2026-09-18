<x-app-layout>

    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            Job Details
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F0EA] py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8">

                {{-- Job Title --}}
                <h1 class="text-3xl font-black text-black">
                    {{ $job->title }}
                </h1>

                {{-- Company --}}
                <p class="text-lg font-bold text-black mt-2">
                    {{ $job->employer->company ?? $job->employer->name }}
                </p>

                {{-- Job Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">

                    {{-- Job Type --}}
                    <div class="bg-white border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">
                        <p class="text-sm font-bold text-black">
                            Job Type
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ ucwords(str_replace('_', ' ', $job->job_type)) }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="bg-white border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">
                        <p class="text-sm font-bold text-black">
                            Salary
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $job->salary ? number_format($job->salary) . ' EGP' : 'Not specified' }}
                        </p>
                    </div>

                    {{-- Location --}}
                    <div class="bg-white border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">
                        <p class="text-sm font-bold text-black">
                            Location
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $job->location ?? 'Not specified' }}
                        </p>
                    </div>

                    {{-- Deadline --}}
                    <div class="bg-white border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">
                        <p class="text-sm font-bold text-black">
                            Application Deadline
                        </p>

                        <p class="font-black text-black mt-1">
                            @if($job->deadline)
                            {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                            @else
                            No deadline specified
                            @endif
                        </p>
                    </div>

                </div>

                {{-- Description --}}
                <div class="mt-8">

                    <h3 class="text-xl font-black text-black">
                        Job Description
                    </h3>

                    <p class="font-medium text-black mt-3 leading-relaxed whitespace-pre-line">
                        {{ $job->description }}
                    </p>

                </div>

                {{-- Application Status / Apply --}}
                {{-- Application Status --}}
                <div class="mt-8">

                    @if($application)

                    <div class="bg-emerald-300 border-2 border-black rounded-xl p-5 shadow-[4px_4px_0px_0px_#000000]">

                        <p class="text-black font-black text-lg">
                            ✓ You have already applied for this job.
                        </p>

                        <p class="font-bold text-black mt-1">
                            You can view your application and check its status.
                        </p>

                        <a
                            href="{{ route('employee.applications.show', $application) }}"
                            class="inline-flex items-center justify-center mt-4 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-6 py-3 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            View Your Application
                        </a>

                    </div>

                    @elseif($job->deadline && now()->startOfDay()->gt($job->deadline))

                    <div class="px-6 py-3 bg-rose-300 text-black font-bold border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                        Applications for this job are closed.
                    </div>

                    @else

                    <form
                        action="{{ route('employee.jobs.apply', $job) }}"
                        method="POST">
                        @csrf
                        <a
                            href="{{ route('employee.jobs.apply', $job) }}"
                            class="inline-flex items-center justify-center mt-8 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-6 py-3 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            Apply for this Job
                        </a>

                    </form>

                    @endif

                </div>

                {{-- Back --}}
                <div class="mt-8">

                    <a
                        href="{{ route('employee.jobs.index') }}"
                        class="inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-5 py-2 shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        Back to Jobs
                    </a>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
