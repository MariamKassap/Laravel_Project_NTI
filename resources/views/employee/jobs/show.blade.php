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

                {{-- Employer --}}
                <p class="text-lg text-gray-600 mt-2">
                    {{ $job->employer->company ?? $job->employer->name }}
                </p>

                {{-- Job Type --}}
                <div class="mt-6">
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded">
                        {{ $job->job_type }}
                    </span>
                </div>

                {{-- Description --}}
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Job Description
                    </h3>

                    <p class="text-gray-600 mt-3 leading-relaxed">
                        {{ $job->description }}
                    </p>
                </div>
                {{-- applay btn --}}
                <!-- <form
                    action="{{ route('employee.jobs.apply', $job) }}" method="POST" class="mt-6">
                    @csrf

                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                        Apply for this Job
                    </button>
                </form> -->
                <a
                    href="{{ route('employee.jobs.apply', $job) }}"
                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg">
                    Apply for this Job
                </a>

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