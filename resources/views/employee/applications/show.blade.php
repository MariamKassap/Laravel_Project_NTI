<x-app-layout>

    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            Application Details
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F0EA] py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Application Status --}}
            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6 mb-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-bold text-black">
                            Application Status
                        </p>

                        <h1 class="text-2xl font-black text-black mt-1">
                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                        </h1>
                    </div>

                    @php
                    $statusClasses = [
                    'pending' => 'bg-amber-300 text-black',
                    'waiting_list' => 'bg-blue-200 text-black',
                    'accepted' => 'bg-emerald-300 text-black',
                    'rejected' => 'bg-rose-300 text-black',
                    ];
                    @endphp

                    <span class="inline-flex items-center px-4 py-2 rounded-md text-sm font-bold border border-black shadow-[1px_1px_0px_0px_#000000]
                        {{ $statusClasses[$application->status] ?? 'bg-white text-black' }}">
                        {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                    </span>

                </div>

            </div>


            {{-- Job Information --}}
            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6 mb-6">

                <h2 class="text-xl font-black text-black mb-6">
                    Job Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm font-bold text-black">
                            Job Title
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->job->title }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Company
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->job->employer->company
                                ?? $application->job->employer->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Location
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->job->location ?? 'Not specified' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Job Type
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ ucfirst(str_replace('_', ' ', $application->job->job_type)) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Salary
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->job->salary ?? 'Not specified' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Application Date
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-black">
                            Job Deadline
                        </p>

                        <p class="font-black text-black mt-1">
                            {{ $application->job->deadline
                                ? \Carbon\Carbon::parse($application->job->deadline)->format('M d, Y')
                                : 'No deadline' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Job Description --}}
            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6 mb-6">

                <h2 class="text-xl font-black text-black mb-4">
                    Job Description
                </h2>

                <p class="font-medium text-black leading-7 whitespace-pre-line">
                    {{ $application->job->description }}
                </p>

            </div>


            {{-- CV Used --}}
            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6 mb-6">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-xl font-black text-black">
                            CV Used
                        </h2>

                        <p class="font-bold text-black mt-1">
                            The CV you submitted with this application.
                        </p>

                        <p class="font-black text-black mt-4">
                            {{ $application->cv->title ?? 'My CV' }}
                        </p>

                    </div>

                    @if($application->cv)

                    <a
                        href="{{ asset('storage/' . $application->cv->file_path) }}"
                        target="_blank"
                        class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        View CV
                    </a>

                    @endif

                </div>

            </div>


            {{-- Back --}}
            <div>

                <a
                    href="{{ route('employee.applications.index') }}"
                    class="inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-5 py-2.5 shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                    ← Back to Applications
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
