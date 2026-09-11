<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Application Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-8">

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $application->job->title }}
                </h1>

                <p class="text-gray-600 mt-2">
                    {{ $application->job->employer->company
                        ?? $application->job->employer->name }}
                </p>

                <div class="mt-6">

                    <p class="text-gray-700">
                        <strong>Status:</strong>

                        @if($application->status === 'accepted')
                        <span class="text-green-600">Accepted</span>

                        @elseif($application->status === 'rejected')
                        <span class="text-red-600">Rejected</span>

                        @elseif($application->status === 'waiting_list')
                        <span class="text-yellow-600">Waiting List</span>

                        @else
                        <span class="text-blue-600">Pending</span>
                        @endif
                    </p>

                    <p class="text-gray-700 mt-3">
                        <strong>Applied on:</strong>
                        {{ $application->created_at->format('d M Y') }}
                    </p>

                </div>

                <div class="mt-8">
                    <a
                        href="{{ route('employee.jobs.index') }}"
                        class="px-5 py-2 bg-gray-600 text-white rounded">
                        Browse Jobs
                    </a>

                    <a
                        href="{{ route('employee.applications.index') }}"
                        class="ml-2 px-5 py-2 bg-blue-600 text-white rounded">
                        My Applications
                    </a>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>