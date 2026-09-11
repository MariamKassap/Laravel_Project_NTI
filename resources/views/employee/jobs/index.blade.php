<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Jobs
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <! search bar>
                <form method="GET" action="{{ route('employee.jobs.index') }}" class="mb-8">

                    <div class="flex gap-3">

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search jobs by title..."
                            class="flex-1 rounded-lg border-gray-300 shadow-sm">

                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">
                            Search
                        </button>

                    </div>

                </form>

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

                        <p class="text-green-700 font-semibold mt-2">
                            {{ number_format($job->salary) }}$
                        </p>

                        <p class="text-gray-600 mt-4">
                            {{ Str::limit($job->description, 120) }}
                        </p>

                        <a
                            href="{{ route('employee.job.show', $job) }}"
                            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                            View Job
                        </a>
                        @if(in_array($job->id, $appliedJobIds))

                        <span class="inline-block mt-4 ml-2 px-4 py-2 bg-green-100 text-green-700 rounded">
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

                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <p class="text-gray-600">
                            No jobs available right now.
                        </p>
                    </div>

                    @endif

        </div>
    </div>

</x-app-layout>