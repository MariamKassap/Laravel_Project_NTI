<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Application Details
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Application Status --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Application Status
                        </p>

                        <h1 class="text-2xl font-bold text-gray-800 mt-1">
                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                        </h1>
                    </div>

                    @php
                    $statusClasses = [
                    'pending' => 'bg-yellow-100 text-yellow-700',
                    'waiting_list' => 'bg-blue-100 text-blue-700',
                    'accepted' => 'bg-green-100 text-green-700',
                    'rejected' => 'bg-red-100 text-red-700',
                    ];
                    @endphp

                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                    </span>

                </div>

            </div>


            {{-- Job Information --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Job Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">
                            Job Title
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->job->title }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Company
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->job->employer->company
                                ?? $application->job->employer->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Location
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->job->location ?? 'Not specified' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Job Type
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ ucfirst(str_replace('_', ' ', $application->job->job_type)) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Salary
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->job->salary ?? 'Not specified' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Application Date
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Job Deadline
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $application->job->deadline
                                ? \Carbon\Carbon::parse($application->job->deadline)->format('M d, Y')
                                : 'No deadline' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Job Description --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">

                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    Job Description
                </h2>

                <p class="text-gray-600 leading-7 whitespace-pre-line">
                    {{ $application->job->description }}
                </p>

            </div>


            {{-- CV Used --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-xl font-bold text-gray-800">
                            CV Used
                        </h2>

                        <p class="text-gray-500 mt-1">
                            The CV you submitted with this application.
                        </p>

                        <p class="font-semibold text-gray-800 mt-4">
                            {{ $application->cv->title ?? 'My CV' }}
                        </p>

                    </div>

                    @if($application->cv)

                    <a
                        href="{{ asset('storage/' . $application->cv->file_path) }}"
                        target="_blank"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        View CV
                    </a>

                    @endif

                </div>

            </div>


            {{-- Back --}}
            <div>

                <a
                    href="{{ route('employee.applications.index') }}"
                    class="inline-block px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                    ← Back to Applications
                </a>

            </div>

        </div>

    </div>

</x-app-layout>