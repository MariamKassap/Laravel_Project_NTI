<x-app-layout>

    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            My Applications
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F0EA] py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 bg-emerald-300 text-black font-bold border-2 border-black px-4 py-3 rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-rose-300 text-black font-bold border-2 border-black px-4 py-3 rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                {{ session('error') }}
            </div>
            @endif

            @if($applications->count())

            <div class="space-y-4">

                @foreach($applications as $application)

                <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-6">

                    <div class="flex justify-between items-start">

                        <div>
                            <h3 class="text-xl font-black text-black">
                                {{ $application->job->title }}
                            </h3>

                            <p class="font-bold text-black mt-1">
                                {{ $application->job->employer->company
                                            ?? $application->job->employer->name }}
                            </p>

                            <p class="text-sm font-bold text-black mt-2">
                                Applied on
                                {{ $application->created_at->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            @if($application->status === 'accepted')

                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-emerald-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                Accepted
                            </span>

                            @elseif($application->status === 'rejected')

                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-rose-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                Rejected
                            </span>

                            @elseif($application->status === 'waiting_list')

                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">
                                Waiting List
                            </span>

                            @else

                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border border-black bg-amber-300 text-black shadow-[1px_1px_0px_0px_#000000]">
                                Pending
                            </span>

                            @endif
                        </div>

                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('employee.applications.show', $application) }}"
                            class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            View Application
                        </a>
                    </div>

                </div>

                @endforeach

            </div>
            {{-- Pagination --}}
            <div class="mt-8">
                {{ $applications->links() }}
            </div>

            @else

            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8 text-center">
                <p class="font-bold text-black">
                    You haven't applied for any jobs yet.
                </p>

                <a
                    href="{{ route('employee.jobs.index') }}"
                    class="inline-flex items-center justify-center mt-4 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-5 py-2 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                    Browse Jobs
                </a>
            </div>

            @endif

        </div>
    </div>

</x-app-layout>
