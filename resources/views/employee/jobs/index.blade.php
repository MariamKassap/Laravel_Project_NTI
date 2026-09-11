<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Jobs
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($jobs->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($jobs as $job)

                <div class="bg-white p-6 rounded-lg shadow">

                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $job->title }}
                    </h3>

                    <p class="text-gray-600 mt-2">
                        {{ $job->employer->company ?? $job->employer->name }}
                    </p>

                    <p class="text-gray-500 mt-2">
                        {{ $job->job_type }}
                    </p>

                    <p class="text-gray-600 mt-4">
                        {{ Str::limit($job->description, 120) }}
                    </p>

                    <a
                        href="{{ route('employee.job.show', $job) }}"
                        class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                        View Job
                    </a>

                </div>

                @endforeach

            </div>

            @else

            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-600">
                    No jobs available right now.
                </p>
            </div>

            @endif

        </div>
    </div>

</x-app-layout>