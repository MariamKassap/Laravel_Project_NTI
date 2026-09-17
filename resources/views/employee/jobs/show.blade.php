<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-8">

                {{-- Job Title --}}
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $job->title }}
                </h1>

                {{-- Company --}}
                <p class="text-lg text-gray-600 mt-2">
                    {{ $job->employer->company ?? $job->employer->name }}
                </p>

                {{-- Job Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">

                    {{-- Job Type --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Job Type
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ ucwords(str_replace('_', ' ', $job->job_type)) }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Salary
                        </p>

                        <p class="font-semibold text-green-700 mt-1">
                            {{ $job->salary ? number_format($job->salary) . ' EGP' : 'Not specified' }}
                        </p>
                    </div>

                    {{-- Location --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Location
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $job->location ?? 'Not specified' }}
                        </p>
                    </div>

                    {{-- Deadline --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Application Deadline
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
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

                    <h3 class="text-xl font-semibold text-gray-800">
                        Job Description
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed whitespace-pre-line">
                        {{ $job->description }}
                    </p>

                </div>

                {{-- Application Status / Apply --}}
                {{-- Application Status --}}
                <div class="mt-8">

                    @if($application)

                    <div class="bg-green-50 border border-green-200 rounded-lg p-5">

                        <p class="text-green-700 font-semibold text-lg">
                            ✓ You have already applied for this job.
                        </p>

                        <p class="text-gray-600 mt-1">
                            You can view your application and check its status.
                        </p>

                        <a
                            href="{{ route('employee.applications.show', $application) }}"
                            class="inline-block mt-4 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            View Your Application
                        </a>

                    </div>

                    @elseif($job->deadline && now()->startOfDay()->gt($job->deadline))

                    <div class="px-6 py-3 bg-red-100 text-red-700 rounded-lg">
                        Applications for this job are closed.
                    </div>

                    @else

                    <form
                        action="{{ route('employee.jobs.apply', $job) }}"
                        method="POST">
                        @csrf
                        <a
                            href="{{ route('employee.jobs.apply', $job) }}"
                            class="inline-block mt-8 px-6 py-3 bg-blue-600 text-white rounded-lg">
                            Apply for this Job
                        </a>

                    </form>

                    @endif

                </div>

                {{-- Back --}}
                <div class="mt-8">

                    <a
                        href="{{ route('employee.jobs.index') }}"
                        class="px-5 py-2 bg-gray-600 text-white rounded">
                        Back to Jobs
                    </a>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>