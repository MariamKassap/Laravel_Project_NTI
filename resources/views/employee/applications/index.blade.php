<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Applications
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
            @endif

            @if($applications->count())

            <div class="space-y-4">

                @foreach($applications as $application)

                <div class="bg-white rounded-lg shadow p-6">

                    <div class="flex justify-between items-start">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $application->job->title }}
                            </h3>

                            <p class="text-gray-600 mt-1">
                                {{ $application->job->employer->company
                                            ?? $application->job->employer->name }}
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                Applied on
                                {{ $application->created_at->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            @if($application->status === 'accepted')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                Accepted
                            </span>

                            @elseif($application->status === 'rejected')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                                Rejected
                            </span>

                            @elseif($application->status === 'waiting_list')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                Waiting List
                            </span>

                            @else

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                Pending
                            </span>

                            @endif
                        </div>

                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('employee.applications.show', $application) }}"
                            class="text-blue-600 hover:underline">
                            View Application
                        </a>
                    </div>

                </div>

                @endforeach

            </div>

            @else

            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-600">
                    You haven't applied for any jobs yet.
                </p>

                <a
                    href="{{ route('employee.jobs.index') }}"
                    class="inline-block mt-4 px-5 py-2 bg-blue-600 text-white rounded">
                    Browse Jobs
                </a>
            </div>

            @endif

        </div>
    </div>

</x-app-layout>